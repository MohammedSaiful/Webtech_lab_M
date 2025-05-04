function validation() {
    let uname = document.getElementById('fname');
    let mail = document.getElementById('email');
    let pass = document.getElementById('pwd');
    let gender = document.getElementById('pwd');
    let conpass = document.getElementById('confirm_pwd');
    let date = document.getElementById('DOB');
    let desh = document.getElementById('country');
    let term = document.getElementById('terms_conditions');

    let regexname = /^[a-zA-Z.-]+$/; /* allow charecters only and . and -*/
    let mailpattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (uname.value.trim() === "" || mail.value.trim() === "" || pass.value.trim() === "" ||
        conpass.value.trim() === "" || date.value.trim() === "" || desh.value.trim() === "" ||
        (!male.checked && !female.checked) || !term.checked) {

        alert("Please fill in all fields.");
        return false;
    }
    if (!regexname.test(uname.value)) {
        alert("Invalid Name");
        return false;
    }
    if (!mailpattern.test(mail.value)) {
        alert("Invalid email! Please enter a valid email address.");
        return false;
    }
    if (pass.value.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    if (conpass.value !== pass.value) {
        alert("Passwords do not match.");
        return false;
    }

    return true; // If everything is valid, form submission proceeds

}