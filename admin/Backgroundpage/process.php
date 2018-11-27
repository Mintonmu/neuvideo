<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/17
 * Time: 11:37
 */
include '../../system/dbConn.php';
$p = new DBconnect();
date_default_timezone_set("Asia/Shanghai");
session_start();

//添加视频类型
if (isset($_POST["video_type"])) {
    $video_type = $_POST["video_type"];
    $p->insert("videotype", array('typename'), array($video_type));
    echo "success";
    return;
}


if (isset($_POST["typename"])) {
    $typename = $_POST['typename'];
    if (isset($_POST['tid'])) {
        $tid = $_POST['tid'];
        $sql = "update videotype set typename = '$typename' where tid = '$tid'";
        $p->executeSql($sql);
        echo "success";
    } else {
        $p->insert("videotype", array('typename'), array($typename));
        echo "success";
        return;
    }

}

////修改管理员
if (isset($_POST['adminname']) && isset($_POST['password'])) {
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];
    $sql = "select * from admins where adminid ='$adminid'";
    $res = $p->executeSql($sql);
    if (isset($_POST['adminid'])) {
        $adminid = $_POST['adminid'];
        if (isset($adminname) && isset($password)) {
            $sql = "update admins set adminname = '$adminname', password = '$password' where adminid ='$adminid'";
            $p->executeSql($sql);
            echo "success";
        } else if (isset($adminname) && !isset($password)) {
            $sql = "update admins set adminname = '$adminname' where adminid ='$adminid'";
            $p->executeSql($sql);
            echo "success";

        } else if (!isset($adminname) && !isset($password)) {
            $sql = "update admins set password = '$password' where adminid ='$adminid'";
            $p->executeSql($sql);
            echo "success";
        }
    } else {
        $p->insert("admins", array("adminname", "password"), array($adminid, $password));
        echo "success";
        return;
    }


}