<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 9:09
 */
function checklog()
{


    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION["adminname"])) {
        header("location:index.php?msg=您没有访问权限！请登录后访问！");
    }
}

?>