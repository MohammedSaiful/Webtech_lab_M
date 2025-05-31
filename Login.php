<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get input from form
    $email = trim($_POST["logemail"]);
    $password = trim($_POST["logpwd"]);

    // Check if fields are filled
    if (empty($email) || empty($password)) {
        
        echo "<p style='color:red;'>Please enter both email and password.</p>";
        exit;
    }

    // Connect to database
    $conn = new mysqli("localhost", "root", "", "registration");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT Name, Password FROM registration_info1 WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_name"] = $name;
            $_SESSION["user_email"] = $email;

            // Redirect to selection page or dashboard
            header("Location: selection_page.php");
            exit;
        } else {
            echo "<p style='color:red;'>Invalid password.</p>";
        }
    } else {
        echo "<p style='color:red;'>No account found with that email.</p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p style='color:red;'>Invalid request method.</p>";
}
?>
