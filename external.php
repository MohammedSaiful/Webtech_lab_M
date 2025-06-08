<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm User Information</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main-container">
<div class="container">
    <div class="center-text">
        <h2>User information</h2>
    </div>

    <?php
    session_start();

    $registration_done = false;  // to remove the confirm button

    if (isset($_POST['submit'])) {
        $uname = htmlspecialchars($_POST['fname']);
        $email = htmlspecialchars($_POST['email']);
        $dob = htmlspecialchars($_POST['DOB']);
        $Country = htmlspecialchars($_POST['country']);
        $pass = htmlspecialchars($_POST['pwd']);
        $confipass = htmlspecialchars($_POST['confirm_pwd']);
        $gender = isset($_POST['Gender']) ? htmlspecialchars($_POST['Gender']) : null;
        $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : "";


    if ($uname && $email && $dob && $pass && $confipass && $Country && $gender) {
        
        echo "<p class=\"center-text\">User name: {$uname}</p>";
        echo "<p class=\"center-text\">Email: {$email}</p>";
        echo "<p class=\"center-text\">Date of Birth: {$dob}</p>";
        echo "<p class=\"center-text\">Country: {$Country}</p>";
        echo "<p class=\"center-text\">Password: {$pass}</p>";
        echo "<p class=\"center-text\">Confirm Password: {$confipass}</p>";

        $_SESSION['temp_uname'] = $uname;
        $_SESSION['temp_email'] = $email;
        $_SESSION['temp_dob'] = $dob;
        $_SESSION['temp_country'] = $Country;
        $_SESSION['temp_pass'] = $pass;
        $_SESSION['temp_gender'] = $gender;
        $_SESSION['temp_description'] = $description;
    } else {
        echo "<p class=\"center-text\">Some fields are missing or invalid.</p>";
    }
     }
       

    // Save to DB if Confirm button was pressed
    if (isset($_POST['confirm'])) {
    //  DB connection
        $conn = new mysqli("localhost", "root", "", "registration");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $uname1 = $_SESSION['temp_uname'];
        $email1 = $_SESSION['temp_email'];
        $dob1 = $_SESSION['temp_dob'];
        $country1 = $_SESSION['temp_country'];
        $pass1 = $_SESSION['temp_pass'];    
        //$pass1 = password_hash($_SESSION['temp_pass'], PASSWORD_DEFAULT);
        //$confipass1 = $_SESSION['temp_pass'];
        $gender1 = isset($_SESSION['temp_gender']) ? $_SESSION['temp_gender'] : null;
        $description1 = isset($_SESSION['temp_description']) ? $_SESSION['temp_description'] : "";
        // Placeholder version (safe from SQL injection)


        
        $checkStmt = $conn->prepare("SELECT Email FROM registration_info1 WHERE Email = ?");
        $checkStmt->bind_param("s", $email1);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo "<p class=\"center-text\" style='color:red;'>This email is already registered. Please try with different email.</p>";
            $checkStmt->close();
            $conn->close();
            $registration_done = true; 
        } else {
            $checkStmt->close();

            // Step 2: Insert new user
            $stmt = $conn->prepare("INSERT INTO registration_info1 
                (Name, Email, Password, Date_of_birth, Country_Name, Gender, description)
                VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $uname1, $email1, $pass1, $dob1, $country1, $gender1, $description1);

            if ($stmt->execute()) {
                echo "<p class=\"center-text\" style='color:green;'>User registered successfully!</p>";
                session_unset(); // Clear session data
                $registration_done = true; 
            } else {
                echo "<p class=\"center-text\" style='color:red;'>Error saving to database: " . $stmt->error . "</p>";
                $registration_done = true; 
            }

            $stmt->close();
            $conn->close();
        }
    }

    //login
    

    ?>
    <!-- Buttons -->
     
    <form method="post">
        <div class="center-form">
            <button type="button" onclick="window.location.href='index.html';" class="buttons">Back</button>
            <?php if (!$registration_done): ?>
                <button type="submit" name="confirm" class="buttons">Confirm</button>
            <?php endif; ?>
        </div>
    </form>
</div>
</div>
</body>
</html>
