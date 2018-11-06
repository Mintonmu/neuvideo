<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/31
 * Time: 10:32
 */
require("./system/dbConn.php");
require("./system/redirectFunc.php");
$link = connect();
$uname = $_POST["uname"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$birthdate = $_POST["birthdate"];
$file = $_FILES["pic"];
$email = $_POST['email'];
$t = time() . $file['name'];
$filename = "./image/" . $t;

$sql = "select * from users where uname = '$uname'";
$result = mysqli_query($link, $sql);
$num = mysqli_num_rows($result);
if ($num) {
    echo "用户名已经存在";
} else {
    $sql = "insert into users values(null,'$uname','$password','$gender','$birthdate','$filename','$email')";
    $rs = mysqli_query($link, $sql);
    if ($rs) {
        move_uploaded_file($file["tmp_name"], $filename);
        echo "success";
    } else {
        echo "error";
    }
}






