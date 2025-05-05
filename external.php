<?php

// echo "Hi ".$_POST['uname']; // ASSOCIATIVE ARRAY K-V  - SUPERGLOBAL ARRAY
// echo "<br>".$_POST['email'];
// echo "<br>".$_GET['uname'];

//var_dump($_GET);
if (isset($_POST['submit'])) {

if ($_POST['uname'] != "") {
echo $_POST['uname'];
}
else
    print_r("NO DATA");

}
else
    print_r("NO DATA");

?>