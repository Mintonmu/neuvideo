<?php
require("../system/dbConn.php");
require("../system/redirectFunc.php");

$link = connect();

$adminname = $_POST["adminname"];
$password = $_POST['password'];


$sql = "select * from admins where adminname = '$adminname' and password ='$password'";
$rs = mysqli_query($link,$sql);
$num = mysqli_num_rows($rs);


if ($num > 0) {

    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION["adminname"] = $adminname;
    echo "success";


} else {
    echo "error";
}

?>