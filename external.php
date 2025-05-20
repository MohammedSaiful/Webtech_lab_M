<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP SUCCESS</title>
</head>
<body>
<?php

echo "Hi ".$_POST['fname']; // ASSOCIATIVE ARRAY K-V  - SUPERGLOBAL ARRAY
// echo "<br>".$_POST['email'];
// echo "<br>".$_GET['uname'];

//var_dump($_GET);
 
if (isset($_POST['submit'])) {
    $uname = htmlspecialchars($_POST['fname']);
    $email = htmlspecialchars($_POST['email']);
    $dob = htmlspecialchars($_POST['DOB']);
    $Country = htmlspecialchars($_POST['country']);
    $pass = htmlspecialchars($_POST['pwd']);
    $confipass = htmlspecialchars($_POST['confirm_pwd']);
   
    // For checkbox, use isset() since it may not be set at all if not checked
    //$terms = isset($_POST['terms']) ? $_POST['terms_conditions'] : '';
 
    if ($uname && $email && $dob && $pass && $confipass && $Country ) {
   
        echo "<p> User name: $uname</p> ";
        echo "<p> Email : $email</p>";
        echo "<p> Date of Birth : $dob </p>";
        echo "<p> Country : $city </p>";
        echo "<p> Password : $pass </p>";
       // echo "<p> Confirm Password : $confipass </p>";
      //  echo "<p> Terms : $terms </p>";
    } else {
        echo "Some fields are missing or invalid 1";
    }
}
 
?>
<button>Cancle</button>
<button>Confirm</button>
<?php

?>
</body>
</html>