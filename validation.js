function validation() {
    let uname = document.getElementById('fname');
    let mail = document.getElementById('email');
    let pass = document.getElementById('pwd');
    let male = document.getElementById('male');
    let female = document.getElementById('female');
    let conpass = document.getElementById('confirm_pwd');
    let date = document.getElementById('DOB');
    let desh = document.getElementById('country');
    let term = document.getElementById('terms_conditions');
    let message = document.getElementById('message');


    let regexname = /^[a-zA-Z .-]+$/; /* allow charecters only and . and -*/
    let mailpattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (uname.value.trim() === "" || mail.value.trim() === "" || pass.value.trim() === "" ||
        conpass.value.trim() === "" || date.value.trim() === "" || desh.value.trim() === "" ||
        (!male.checked && !female.checked) || !term.checked) {
        message.style.color = "red";
        message.innerHTML = "Please fill out all fields before submitting.";
        return false;
    }
    if (!regexname.test(uname.value)) {
        message.style.color = "red";
        message.innerHTML = "Name can not contain numbers";
        return false;
    }
    if (!mailpattern.test(mail.value)) {
        message.style.color = "red";
        alert("Invalid email! Please enter a valid email address.");
        return false;
    }
    if (pass.value.length < 8) {
        message.style.color = "red";
        message.innerHTML = "Password must be at least 8 characters long.";
        return false;
    }

    if (conpass.value !== pass.value) {
        message.style.color = "red";
        message.innerHTML = "Passwords do not match.";
        return false;
    }

    let birthDate = new Date(date.value);
    let today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    let monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    if (age < 18) {
        message.style.color = "red";
        message.innerHTML = "Not eligible for registration cause you are under 18.";
        return false;
    }


    return true; // If everything is valid, form submission proceeds

} log_message

// Registration Form Validation
function validation() {
    const uname = document.getElementById('fname');
    const mail = document.getElementById('email');
    const pass = document.getElementById('pwd');
    const conpass = document.getElementById('confirm_pwd');
    const male = document.getElementById('male');
    const female = document.getElementById('female');
    const date = document.getElementById('DOB');
    const desh = document.getElementById('country');
    const term = document.getElementById('terms_conditions');
    const message = document.getElementById('message');

    const regexname = /^[a-zA-Z .-]+$/; // Allow letters, space, dot, and hyphen
    const mailpattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Check if any required field is empty or unselected
    if (
        uname.value.trim() === "" || mail.value.trim() === "" || pass.value.trim() === "" ||
        conpass.value.trim() === "" || date.value.trim() === "" || desh.value.trim() === "" ||
        (!male.checked && !female.checked) || !term.checked
    ) {
        message.style.color = "red";
        message.innerHTML = "Please fill out all fields before submitting.";
        return false;
    }

    // Validate name
    if (!regexname.test(uname.value.trim())) {
        message.style.color = "red";
        message.innerHTML = "Name can only contain letters, spaces, dots, and hyphens.";
        return false;
    }

    // Validate email
    if (!mailpattern.test(mail.value.trim())) {
        message.style.color = "red";
        message.innerHTML = "Please enter a valid email address.";
        return false;
    }

    // Validate password length
    if (pass.value.length < 8) {
        message.style.color = "red";
        message.innerHTML = "Password must be at least 8 characters long.";
        return false;
    }

    // Validate confirm password
    if (conpass.value !== pass.value) {
        message.style.color = "red";
        message.innerHTML = "Passwords do not match.";
        return false;
    }

    // Validate age (must be at least 18)
    const birthDate = new Date(date.value);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }

    if (age < 18) {
        message.style.color = "red";
        message.innerHTML = "You must be at least 18 years old to register.";
        return false;
    }

    // All validations passed
    return true;
}

// Login Form Validation
function validateLogin() {
    const email2 = document.getElementById("logemail").value.trim();
    const password2 = document.getElementById("logpwd").value.trim();
    const log_message = document.getElementById("log_message");

    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (email2 === "" || password2 === "") {
        log_message.style.color = "red";
        log_message.textContent = "Please enter both email and password.";
        return false;
    }

    if (!emailPattern.test(email2)) {
        log_message.style.color = "red";
        log_message.textContent = "Invalid email format.";
        return false;
    }

    if (password2.length < 8) {
        log_message.style.color = "red";
        log_message.textContent = "Password must be at least 8 characters long.";
        return false;
    }

    return true; // Login input is valid
}
