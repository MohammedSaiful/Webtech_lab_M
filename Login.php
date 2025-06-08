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
    $registration_done = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logemail']) && isset($_POST['logpwd'])) {
        $email = trim($_POST['logemail']);
        $password = trim($_POST['logpwd']);

        $conn = new mysqli("localhost", "root", "", "registration");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // WARNING: Only valid if passwords are stored in plain text (NOT RECOMMENDED)
        $stmt = $conn->prepare("SELECT Name FROM registration_info1 WHERE Email = ? AND Password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($name);
            $stmt->fetch();

            $_SESSION["user_name"] = $name;
            $_SESSION["user_email"] = $email;

            header("Location: show_aqi.php");
            exit;
        } else {
            echo "<p style='color:red;'>Invalid email or password.</p>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<p style='color:red;'>Invalid request. Please use the login form.</p>";
        $registration_done = true;
    }
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
