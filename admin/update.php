<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/17
 * Time: 11:37
 */

include '../system/dbConn.php';
$p = new DataBase();
date_default_timezone_set("Asia/Shanghai");


//更新用户数据
if (isset($_POST['user_pro'])) {
    $uname = $_POST['username'];
    $gender = $_POST['type'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $img = '';
    $filename = '';
    $t = '';
    if (isset($_FILES['img'])) {
        $img = $_FILES['img'];
        $t = time() . $img["name"];
        $filename = "../image/" . $t;
        move_uploaded_file($img["tmp_name"], $filename);
    }
    $password = '';
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (isset($_POST['uid'])) {
        //edit
        $uid = $_POST['uid'];
        if (isset($_POST['password']) && isset($_FILES['img'])) {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',pic='img/$t',email='$email', password='$password' where uid = $uid";
            $p->executeSql($sql1);
            echo "2";
            return;
        } else if (isset($_POST['password']) && !isset($_FILES['img'])) {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',email='$email', password='$password' where uid = $uid";
            $p->executeSql($sql1);
            echo "3";
            return;
        } else if (!isset($_POST['password']) && isset($_FILES['img'])) {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',pic='img/$t',email='$email' where uid = $uid";
            echo "4";
            $p->executeSql($sql1);
            return;
        } else {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',email='$email' where uid = $uid";
            //echo $sql1;
            $p->executeSql($sql1);
            echo "5";
            return;
        }
    } else {
        //insert
        $p->insert("users", array("uname", "password", "gender", "birthdate", "pic", "email"), array($uname, $password, $gender, $birthday, '../image/' . $t, $email));
        echo "1";
        return;
    }
}

//