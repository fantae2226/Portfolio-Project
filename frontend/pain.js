



async function Create(paramName, paramContents) {

    var uri = `http://localhost/Portfolio-Project/backend/${paramName}`;

    await fetch(uri, {
        method : 'POST',
        headers : {'Content-Type' : 'application/json'},
        body : JSON.stringify(paramContents)
    })
    .then(response =>{
        if (!response.ok){
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    })

}



async function Read(paramName, paramSpecifier = null) {
    var uri = paramSpecifier 
    ? `http://localhost/Portfolio-Project/backend/${paramName}/${paramSpecifier}`
    : `http://localhost/Portfolio-Project/backend/${paramName}`;

    console.log(uri);

    await fetch(uri, {
        method : 'GET'
        
    })
    .then(response =>{
        if (!response.ok){
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    })
}



async function Update(paramName, paramContents, paramSpecifier = null) {

    var uri = paramSpecifier 
    ? `http://localhost/Portfolio-Project/backend/${paramName}/${paramSpecifier}`
    : `http://localhost/Portfolio-Project/backend/${paramName}`;

    await fetch(uri, {
        method : 'PUT',
        headers : {'Content-Type' : 'application/json'},
        body : JSON.stringify(paramContents)
    })
    .then(response =>{
        if (!response.ok){
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    })

}



async function Delete(paramName, paramSpecifier = null) {

    var uri = paramSpecifier 
    ? `http://localhost/Portfolio-Project/backend/${paramName}/${paramSpecifier}`
    : `http://localhost/Portfolio-Project/backend/${paramName}`;

    await fetch(uri, {
        method : 'DELETE'
    })
    .then(response =>{
        if (!response.ok){
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    })

}


var paramName = "users";
var paramContents = {
    "username" : "Ebby",
    "password" : "tired_Of_PHP",
    "email": "notpooper@hotshits.com"
};
// var paramContents = {
//     "role": "certified_javascript_hater"
// };

var paramSpecifier = paramContents["email"];


// Create(paramName, paramContents);

// Read(paramName, paramSpecifier);

// Update(paramName, paramContents, paramSpecifier);


Delete(paramName, paramSpecifier);
