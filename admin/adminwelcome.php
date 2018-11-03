<?php
/**
 * Created by PhpStorm.
 * User: muming
 * Date: 2018/10/27
 * Time: 8:57
 */
if ($_SERVER['HTTP_REFERER'] == "") {
    echo "<script>alert('本系统不允许从地址栏访问');</script>";
    echo "<script>window.close();</script>";
    exit();
}
?>
<h2>
    欢迎管理员[<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    echo $_SESSION["adminname"];
    ?>]访问本系统
</h2>

<h3>
    <a href="userList.php">注册用户管理</a>
    <br>
    <a href="Adminlogout.php">管理员注销</a>
    <br>
</h3>