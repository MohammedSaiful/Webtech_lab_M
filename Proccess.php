<?php

// echo "Hi ".$_POST['uname']; // ASSOCIATIVE ARRAY K-V  - SUPERGLOBAL ARRAY
// echo "<br>".$_POST['email'];
// echo "<br>".$_GET['uname'];

//var_dump($_GET);

if (isset($_POST['Submit'])) {

if ($_POST['fname'] != "") {
echo $_POST['fname'];
}
else
    print_r("NO DATA");

}
else
    print_r("NO DATA");

?>