<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Neu后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/site.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="welcome.php">Neu视频后台管理系统</a>
            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.php"><i class="icon-user"></i><?php if (!isset($_SESSION)) {
                        session_start();
                    }
                    echo $_SESSION["adminname"]; ?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li class="divider"></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="welcome.php">主页</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="users.php">用户管理</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-role.php">添加管理员</a></li>
                            <li class="divider"></li>
                            <li><a href="roles.php">管理员管理</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">视频<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-video.php">添加视频</a></li>
                            <li class="divider"></li>
                            <li><a href="video.php">视频管理</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">评论<b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="comment.php">评论管理</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span3">
            <div class="well sidebar-nav">
                <ul class="nav nav-list">
                    <li class="nav-header"><i class="icon-wrench"></i>用户和管理员</li>
                    <li class="active"><a href="users.php">用户</a></li>
                    <li><a href="roles.php">管理员</a></li>
                    <li class="nav-header"><i class="icon-signal"></i>视频和评论</li>
                    <li><a href="video.php">视频管理</a></li>
                    <li><a href="comment.php">评论管理</a></li>
                    <li class="nav-header"><i class="icon-user"></i>信息</li>
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>用户
                        <small>所有用户</small>
                    </h1>
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require("./getpages.php");
                    if (!isset($_GET["num"])) {
                        $_GET['num'] = 1;
                    }
                    if (!isset($_GET["size"])) {
                        $_GET['size'] = 5;
                    }
                    $ary = getUsersDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-users">';
                        echo "<td>" . $num['uid'] . "</td >";
                        echo "<input  type=\"hidden\" id='userid' value=" . $num['uid'] . " />";
                        echo "<td>" . $num['uname'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" onclick="trandata(\'' . $num["uname"] . '\',\'' . $num["password"] . '\',\'' . $num["uid"] . '\',\'' . $num["gender"] . '\',\'' . $num["birthdate"] . '\',\'' . $num["pic"] . '\',\'' . $num["email"] . '\');">设置<span
                                                                    class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i>编辑</a></li>
                                                            <li><a href="#" onclick="del_user()"><i class="icon-trash"></i> 删除</a></li>
                                                        </ul>
                                                    </div>
                                                </td>';
                        echo "</tr>";
                    }

                    ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <ul>
                        <?php
                        //echo 1;
                        if (!isset($_GET["num"])) {
                            $_GET['num'] = 1;
                        }
                        if (!isset($_GET["size"])) {
                            $_GET['size'] = 5;
                        }
                        $ary = getUsersDate($_GET['num'], $_GET['size']);
                        //echo $ary[1];

                        if (intval($_GET['num']) == 1) {
                            echo "<li><a href=\"users.php?num=1&size=" . $_GET['size'] . "\">Prev</a></li>";

                        } else {
                            echo "<li><a href=\"users.php?num=" . (intval($_GET['num']) - 1) . "&size=" . $_GET['size'] . "\">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $ary[1]; $i++) {
                            echo "<li>" . "<a href=\"users.php?num=$i&size=" . $_GET['size'] . "\">" . $i . "</a></li>";
                        }
                        if (intval($_GET['num']) == $ary[2]) {
                            echo "<li><a href=\"users.php?num=$ary[2]&size=" . $_GET['size'] . "\">Next</a></li>";

                        } else {
                            echo "<li><a href=\"users.php?num=" . (intval($_GET['num']) + 1) . "&size=" . $_GET['size'] . "\">Next</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">我的信息</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label style="vertical-align: inherit;">用 户 名:</label>
                            <input type="text" name="uname_pro" id="uname_pro" placeholder="用户名">
                            <input type="hidden" id="uid" name="uid""/>
                        </div>

                        <div class="form-group">
                            <label style="vertical-align: inherit;">密 码:</label>
                            <input type="password" name="password1_pro" id="password1_pro" placeholder="密码">
                        </div>

                        <div class="form-group">
                            <label style="vertical-align: inherit;">性 别:</label>
                            <br>
                            <input type="radio" name="gender_pro" value="0">男
                            &nbsp;&nbsp;
                            <input type="radio" name="gender_pro" value="1">女
                            <br>
                        </div>

                        <div class="form-group">
                            <label style="vertical-align: inherit;">生 日:</label>
                            <br>
                            <input type="date" name="birthdate_pro" id="birthdate_pro">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="pic">头像</label>
                            <input type="file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)"
                                   accept="image/*"/>
                            <img id="xmTanImg" style="height: 20%;width: 50%" src=""/>
                            <div id="xmTanDiv"></div>
                            <br>
                        </div>

                        <div class="form-group">
                            <label style="vertical-align: inherit;">电子邮箱:</label>
                            <input type="email" name="email_pro" id="email_pro" placeholder="电子邮箱">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="modify_submit()">提交更改</button>
                </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
    <hr>
    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>
</div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>


    let trandata = function (uname, password, uid, gender, birthdate, pic, email) {
        $("#uname_pro").val(uname);
        $("#password1_pro").val(password);
        $("#uid").val(uid);
        $("#birthdate_pro").val(birthdate);
        $("#email_pro").val(email);
        $("#xmTanImg").attr("src", "../" + "." + pic);
        if (gender == 0) {
            $("input[name = 'gender_pro']").eq(0).attr("checked", "checked");
            $("input[name = 'gender_pro']").eq(1).removeAttr("checked");
            $("input[name = 'gender_pro']").eq(0).click();
        } else {
            $("input[name = 'gender_pro']").eq(1).attr("checked", "checked");
            $("input[name = 'gender_pro']").eq(0).removeAttr("checked");
            $("input[name = 'gender_pro']").eq(1).click();
        }
    };
    let modify_submit = function () {

        let uname_pro = $("#uname_pro").val();
        let password_pro = $("#password1_pro").val();
        let uid = $("#uid").val();
        let gender = $("input[name = 'gender_pro']:checked").val();
        let birthdate = $("#birthdate_pro").val();
        let img_file = document.getElementById("xdaTanFileImg");
        let fileObj = img_file.files[0];
        console.log(uname_pro);

        console.log(fileObj);
        let data = {
            "uname_pro": uname_pro,
            "password_pro": password_pro,
            "uid": uid,
            "gender": gender,
            "birthdate": birthdate,
            "fileObj": fileObj,
        };
        $.ajax({
            url: '../update.php',
            type: 'post',
            data: data,
            dataType: 'text',
            success: function (result) {
                $("#myModal").modal('hide');
                console.log(result);
                if (result == "success") {
                    $("#adminname").val(adminname);
                    $("#password").val(password);
                    alert("您已经修改成功");
                    location.reload(true);
                }
            },
            error: function (msg) {
                alert(msg);
            }
        })

    };

    function del_user() {

        if (confirm("是否删除该用户？")) {

            let uid = $("#userid").val();
            let data = {
                "userid": uid
            };
            $.ajax({
                url: "../update.php",
                data: data,
                type: 'post',
                dataType: 'text',

                success: function (result) {
                    console.log(result);

                    window.location.reload();

                },
                error: function (data) {
                    console.log(data);
                    alert("失败");
                    window.location.reload();
                }
            });
        }

    }

    $(document).ready(function () {
        $('.dropdown-menu li a').hover(
            function () {
                $(this).children('i').addClass('icon-white');
            },
            function () {
                $(this).children('i').removeClass('icon-white');
            });

        if ($(window).width() > 760) {
            $('tr.list-users td div ul').addClass('pull-right');
        }
    });

    function modify_f() {

        let username = $('#uname_pro').val();
        if (username === '') {
            alert("必须输入用户名");
            return;
        }
        let form = new FormData();
        let password = $('#password1_pro').val();
        if (password != '') {
            form.append("password", password);
        }
        let type = $("input[name = 'gender_pro']:checked").val();
        console.log(type);
        let birthday = $('#birthdate_pro').val();
        let email = $('#email_pro').val();
        let img_file = document.getElementById("xdaTanFileImg");
        let fileObj = img_file.files[0];
        if (typeof(fileObj) == "undefined") {
            console.log("img undefind");
        } else {
            form.append("img", fileObj);
        }
        form.append("username", username);
        form.append("type", type);
        form.append("birthday", birthday);
        form.append("email", email);
        form.append("user_pro", 1);
        console.log("编辑");
        let uid = $('#uid').val();
        form.append('uid', uid);

        $.ajax({
            url: '../update.php',
            type: 'post',
            data: form,
            dataType: 'text',
            async: false,
            processData: false,
            contentType: false,
            success: function (result) {
                console.log(result);
                alert("修改信息成功");
                window.location.reload();

            },
            error: function (data) {
                console.log(data);
                alert("失败");
                window.location.reload();
            }
        })
    }

    //判断浏览器是否支持FileReader接口
    if (typeof FileReader == 'undefined') {
        document.getElementById("xmTanDiv").InnerHTML = "<h1>当前浏览器不支持FileReader接口</h1>";
        //使选择控件不可操作
        document.getElementById("xmTanImg").setAttribute("disabled", "disabled");
    }

    //选择图片，马上预览
    function xmTanUploadImg(obj) {
        let file = obj.files[0];
        console.log(obj);
        console.log(file);
        console.log("file.size = " + file.size);  //file.size 单位为byte
        let reader = new FileReader();
        //读取文件过程方法
        reader.onloadstart = function (e) {
            console.log("开始读取....");
        }
        reader.onprogress = function (e) {
            console.log("正在读取中....");
        }
        reader.onabort = function (e) {
            console.log("中断读取....");
        }
        reader.onerror = function (e) {
            console.log("读取异常....");
        }
        reader.onload = function (e) {
            console.log("成功读取....");
            let img = document.getElementById("xmTanImg");
            img.src = e.target.result;
        }
        reader.readAsDataURL(file)
    }


</script>
</body>
<style>
    html, body {
        height: 95%;
    }

    body {
        position: relative;
        min-height: 450px;
    }

    footer {
        position: absolute;
        min-width: 100%;
        bottom: 0;
        left: 0;
    }

</style>
</html>
