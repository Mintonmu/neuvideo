<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
if ($_SERVER['HTTP_REFERER'] == "") {
    echo "<script>alert('本系统不允许从地址栏访问');</script>";
    echo "<script>window.close();</script>";
    exit();
}
?>
<h1>欢迎您登录成功</h1>

</body>
</html>