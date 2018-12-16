<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/11/17
 * Time: 11:37
 */
include '../system/dbConn.php';
$p = new DBconnect();
date_default_timezone_set("Asia/Shanghai");
session_start();

//删除视频类型;
if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];
    //todo 视频类型下的视频单独判断
    $sql = "delete from videotype where tid = '$tid'";
    $p->executeSql($sql);
    echo "success";
    header("location:./Backgroundpage/videotype.php");
    return;
}
//更新视频数据
if (isset($_POST["videoname_pro"])) {

    $videoname_pro = $_POST["videoname_pro"];
    $videotype_pro = $_POST["videotype_pro"];

    if (isset($_FILES["fileObj"])) {
        $fileObj = $_FILES["fileObj"];
        $t = time() . $fileObj['name'];
        $filename = "../posters/" . $t;
        move_uploaded_file($fileObj["tmp_name"], $filename);
    }
    $intro = $_POST["intro"];
    $address_pro = $_POST["address_pro"];
    $uploadadmin = $_SESSION["adminid"];
    if (isset($_POST['vid'])) {
        $vid = $_POST['vid'];
        $time = date("y-m-d H:i:s", time());
        if ($t == '') {
            $p->update("videos", array("videoname", "intro", "uploaddate", "uploadadmin", "tid", "address"), array($videoname_pro, $intro, $time, $uploadadmin, $videotype_pro, $address_pro), "vid", $vid);
        } else {
            $p->update("videos", array("videoname", "intro", "uploaddate", "uploadadmin", "tid", "address", "pic"), array($videoname_pro, $intro, $time, $uploadadmin, $videotype_pro, $address_pro, $filename), "vid", $vid);
        }
        echo 'success';
        return;
    }
    $p->insert('videos', array('videoname', 'tid', 'pic', 'intro', 'uploaddate', 'uploadadmin', 'address'),
        array($videoname_pro, $videotype_pro, $filename, $intro, $time, $uploadadmin, $address_pro)
    );
    echo 'success';
    return;
}


////删除视频
if (isset($_GET['vid'])) {
    $vid = $_GET['vid'];
    $sql = "delete from videos where vid = '$vid'";
    $p->executeSql($sql);
    header("location:./Backgroundpage/video.php");
    return;
}

////删除评论
if (isset($_GET["cid"])) {
    $cid = $_GET['cid'];
    $sql = "delete from comments where cid = '$cid'";
    $p->executeSql($sql);
    header("location:./Backgroundpage/comment.php");
    return;

}
////添加管理员
if (isset($_POST["adminname"]) && isset($_POST["adminpassword"])) {
    $adminname_pro = $_POST["adminname"];
    $password_pro = $_POST["adminpassword"];
    $p->insert("admins", array('adminname', 'password'), array($adminname_pro, $password_pro));
    echo "10";
    header("location:./Backgroundpage/roles.php");
    return;
}
////添加视频
if (isset($_POST["videoname"])) {
    $uploadadmin = $_SESSION["adminid"];
    echo $uploadadmin;
    $videoname = $_POST["videoname"];
    $videotype = $_POST["videotype"];
    $description = $_POST["description"];
    $address = $_POST["address"];
    if (isset($_FILES["pic"])) {
        $image = $_FILES["pic"];
        $t = time() . $image['name'];
        $filename = "../posters/" . $t;
        move_uploaded_file($image["tmp_name"], $filename);
    }
    $sql = "insert into videos values (null,'$videoname','$videotype','$filename','$description',now(),'$uploadadmin',0,0,'$address')";
    $p->executeSql($sql);
    header("location:./Backgroundpage/video.php");
    return;
}
//删除管理员
if (isset($_POST["adminid"])) {
    $aid = $_POST["adminid"];
    $sql1 = "delete from admins where adminid=$aid ";
    echo $sql1;
    $p->executeSql($sql1);
    echo "7";
    return;

}
////删除用户
if (isset($_POST["userid"])) {
    $uid = $_POST["userid"];
    $sql1 = "delete from users where uid=$uid ";
    $p->executeSql($sql1);
    echo "6";
    return;

}

//更新用户数据
if (isset($_POST['user_pro'])) {
    echo $_POST['username'];
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
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',pic='$filename',email='$email', password='$password' where uid = $uid";
            $p->executeSql($sql1);
            echo "2";
        } else if (isset($_POST['password']) && !isset($_FILES['img'])) {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',email='$email', password='$password' where uid = $uid";
            $p->executeSql($sql1);
            echo "3";
        } else if (!isset($_POST['password']) && isset($_FILES['img'])) {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',pic='$filename',email='$email' where uid = $uid";
            echo "4";
            $p->executeSql($sql1);
        } else {
            $sql1 = "update users set uname = '$uname', gender='$gender',birthdate='$birthday',email='$email' where uid = $uid";
            //echo $sql1;
            $p->executeSql($sql1);
            echo "5";
        }
        session_start();
        $_SESSION['username'] = $uname;
        return;
    } else {
        //insert
        $p->insert("users", array("uname", "password", "gender", "birthdate", "pic", "email"), array($uname, $password, $gender, $birthday, '../image/' . $t, $email));
        echo "1";
        return;
    }
}

