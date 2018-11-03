<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 8:55
 */

if (!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION["adminname"])){
    header("location:welcome.php?msg=您没有访问权限！请登录后访问！");
}