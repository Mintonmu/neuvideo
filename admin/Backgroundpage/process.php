<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/6
 * Time: 19:26
 */
require("../../system/dbConn.php");
$link = connect();
$adminname = $_POST["adminname"];
$password = $_POST["password"];
$adminid = $_POST["adminid"];

$sql = "select * from admins where adminname = '$adminname' and password ='$password'";
$rs = mysqli_query($link, $sql);
$num = mysqli_num_rows($rs);

if ($num) {
    echo "该管理员已经存在,请再次修改";
} else {
    $sql = "update admins set  adminname = '$adminname' , password = '$password' where adminid = $adminid";

//    echo $sql;
    $rs = mysqli_query($link, $sql);
    if ($rs) {
        echo "success";
    } else {
        echo "error";
    }
}

