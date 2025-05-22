<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm User Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="center-text">
        <h3>User information</h3>
    </div>

    <?php
    session_start();

    if (isset($_POST['submit'])) {
        $uname = htmlspecialchars($_POST['fname']);
        $email = htmlspecialchars($_POST['email']);
        $dob = htmlspecialchars($_POST['DOB']);
        $Country = htmlspecialchars($_POST['country']);
        $pass = htmlspecialchars($_POST['pwd']);
        $confipass = htmlspecialchars($_POST['confirm_pwd']);

    if ($uname && $email && $dob && $pass && $confipass && $Country) {
        echo "<p>User name: {$uname}</p>";
        echo "<p>Email: {$email}</p>";
        echo "<p>Date of Birth: {$dob}</p>";
        echo "<p>Country: {$Country}</p>";
        echo "<p>Password: {$pass}</p>";
        echo "<p>Confirm Password: {$confipass}</p>";

        $_SESSION['temp_uname'] = $uname;
        $_SESSION['temp_email'] = $email;
        $_SESSION['temp_dob'] = $dob;
        $_SESSION['temp_country'] = $Country;
        $_SESSION['temp_pass'] = $pass;
    } else {
        echo "<p>Some fields are missing or invalid.</p>";
    }
     }
       

    // Save to DB if Confirm button was pressed
    if (isset($_POST['confirm'])) {
    // Example DB connection
        $conn = new mysqli("localhost", "root", "", "registration");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $uname1 = $_SESSION['temp_uname'];
        $email1 = $_SESSION['temp_email'];
        $dob1 = $_SESSION['temp_dob'];
        $country1 = $_SESSION['temp_country'];
        $pass1 = $_SESSION['temp_pass'];

        // Placeholder version (safe from SQL injection)
        $stmt = $conn->prepare("INSERT INTO registration_info1 
            (Name, Email, Password, Confirm_Password, Date_of_birth, Country_Name, Gender, description)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Provide default values for Gender and Description
        $gender = "-";
        $description = "-";

        // Bind parameters to placeholders
        $stmt->bind_param("ssssssss", $uname1, $email1, $pass1, $pass1, $dob1, $country1, $gender, $description);

        if ($stmt->execute()) {
            echo "<p>User registered successfully!</p>";
            session_unset(); // Clear session data
        } else {
            echo "<p>Error saving to database: " . $stmt->error . "</p>";
        }

        $stmt->close();
        $conn->close();
    }

    ?>

    <form method="post">
        <button type="button" onclick="history.back();">Cancel</button>
        <button type="submit" name="confirm">Confirm</button>
    </form>
</div>
</body>
</html>
