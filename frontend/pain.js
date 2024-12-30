



async function Create(paramName, paramContents) {

    var uri = `../backend/controller.php/${paramName}`;

    await fetch(uri, {
        method : 'POST',
        headers : {'Content-Type' : 'appliction/json'},
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
    ? `http://localhost/Portfolio%20Project/backend/${paramName}/${paramSpecifier}`
    : `http://localhost/Portfolio%20Project/backend/${paramName}`;

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

var paramName = "Joe";


Read(paramName, "Niggas in Paris");
