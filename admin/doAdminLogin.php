<?php
require("../system/dbConn.php");
require("../system/myFunc.php");
connect();

$adminname = $_POST["adminname"];
$password = $_POST['password'];

$sql = "select * from admins where adminname = '$adminname" and password = md5('$password');
$rs = mysql_query($sql);
$num = mysql_num_rows($rs);
 

if($num > 0){
          session_start();
          $_SESSION["adminname"] = $adminname;
          redirect("welcome.php",'登录成功！3秒后将跳转到管理员欢迎界面');

} 
else {
          redirect('index.php','登录失败！3秒后将返回登录页面重新登录');
}

?>