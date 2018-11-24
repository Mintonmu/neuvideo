<?php
require("./system/dbConn.php");
require("./system/redirectFunc.php");
$link = connect();
$uname = $_POST["username"];
$password = $_POST['password'];

$sql = "select * from users where uname = '$uname' and password ='$password'";
$rs = mysqli_query($link, $sql);
$num = mysqli_num_rows($rs);
if ($num > 0) {

    session_start();
    $_SESSION["username"] = $uname;
    echo "success";
    header("location:welcome.php");
} else {
    echo "error";
}

