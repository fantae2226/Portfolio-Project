import * as database from './pain.js';

// after DOM elements load, run the run function which acts as a startup  
window.addEventListener("load", run);


// Run acts as the controller for the JS 
function run() {
    
    // register user

    // registerButton event occurs when the user clicks the register button in the register page 
    var registerUsersButton = document.getElementById('registrationbutton');
    registerUsersButton.addEventListener('click', registerUser); 
    
    // unregister/delete user 

    //login
    // var loginUserButton = document.getElementById('loginbutton');
    // loginUserButton.addEventListener('click', loginUser);

    //logout
    
    //follow user
    
    //like a post
    
    //comment on a post

    //search
    
    //edit comment
    
    //delete comment
}

// registerUser is called when a user clicks the register button on register page
// registerUser takes user's input data and creates a new entry for the user in the DB  

// registerUser returns true on a success and false on a failure

async function registerUser() {
    var registeredUsername = document.getElementById('registeredusername').value;
    var registeredPassword1 = document.getElementById('registeredpassword1').value;
    var registeredPassword2 = document.getElementById('registeredpassword2').value;
    var registeredEmail = document.getElementById('registeredemail').value;
    // var action = "register";

    // console.log("da registration button was clicked");

    var paramName = "users";
    var registeredParamContents = {
        "username" : registeredUsername,
        "password" : registeredPassword1,
        "email": registeredEmail,
        "action" : "register"
    };
    

    try{
        await database.Create(paramName, registeredParamContents);
    } catch(error){
        console.error("Error registering user: ", error);
    }
    
    // console.log("create happened idk if it worked");
    

    // add error handling and other things like password comparison etc.
    // for now... assume user is a good boy or girl. They are nice on santa's list. 
    //      - Mastiffhere O' Soccerguy
}

function loginUser() {
    
}










//unregister
// function unregisterUser(){

    
// }
// async function Create(paramName, paramContents) {

//     var uri = `http://localhost/Portfolio-Project/backend/${paramName}`;

//     await fetch(uri, {
//         method : 'POST',
//         headers : {'Content-Type' : 'application/json'},
//         body : JSON.stringify(paramContents)
//     })
//     .then(response =>{
//         if (!response.ok){
//             throw new Error(`HTTP error! status: ${response.status}`);
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log('Success:', data);
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     })
// 
// }
