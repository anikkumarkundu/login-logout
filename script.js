function validateRegistration() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username === "" || password === "") {
        alert("Username and Password cannot be empty!");
        return false;
    }
    return true;
}

function validateLogin() {
    let username = document.getElementById("login_username").value;
    let password = document.getElementById("login_password").value;

    if(username === "" || password === "") {
        alert("Please enter Username and Password!");
        return false;
    }
    return true;
}
