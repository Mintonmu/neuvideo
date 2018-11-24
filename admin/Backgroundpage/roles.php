<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Neu后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="muming">

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
                    <li><a href="#">登出</a></li>
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
                    <li class="nav-header"><i class="icon-wrench"></i> 用户和管理员</li>
                    <li><a href="users.php">用户</a></li>
                    <li class="active"><a href="roles.php">管理员</a></li>
                    <li class="nav-header"><i class="icon-signal"></i>视频和评论</li>
                    <li><a href="video.php">视频管理</a></li>
                    <li><a href="comment.php">评论管理</a></li>
                    <li class="nav-header"><i class="icon-user"></i> 信息</li>
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>管理员
                        <small>管理员管理</small>
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
                    $ary = getRolesDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-roles">';
                        echo "<td >" . $num['adminid'] . "</td >";
                        echo "<input  type=\"hidden\" id='adminid' value=" . $num['adminid'] . " />";
                        echo "<td id='" . "adminname_" . $num['adminid'] . "'>" . $num['adminname'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" onclick="transdata(\'' . $num["adminname"] . '\',\'' . $num["password"] . '\',\'' . $num["adminid"] . '\')">设置<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#myModal" onclick="f(\'' . 'adminname_' . $num['adminid'] . '\')"><i class="icon-pencil" ></i>编辑</a></li>
                                                            <li><a href="#" onclick="del_roles()"><i class="icon-trash"></i> 删除</a></li>
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
                            echo "<li><a href=\"roles.php?num=1&size=" . $_GET['size'] . "\">Prev</a></li>";

                        } else {
                            echo "<li><a href=\"roles.php?num=" . (intval($_GET['num']) - 1) . "&size=" . $_GET['size'] . "\">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $ary[1]; $i++) {
                            echo "<li>" . "<a href=\"roles.php?num=$i&size=" . $_GET['size'] . "\">" . $i . "</a></li>";
                        }
                        if (intval($_GET['num']) == $ary[2]) {
                            echo "<li><a href=\"roles.php?num=$ary[2]&size=" . $_GET['size'] . "\">Next</a></li>";

                        } else {
                            echo "<li><a href=\"roles.php?num=" . (intval($_GET['num']) + 1) . "&size=" . $_GET['size'] . "\">Next</a></li>";
                        }
                        ?>
                    </ul>
                </div>


                <a href="new-role.php" class="btn btn-success">添加管理员</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body">
                    <!--                    <div class="alert alert-warning" id="tooltip">-->
                    <!--                        <a href="#" class="close" data-dismiss="alert">-->
                    <!--                            &times;-->
                    <!--                        </a>-->
                    <!--                        <strong>警告！</strong>您两次输入的密码不一致-->
                    <!--                    </div>-->
                    <input type="hidden" id="adminid">
                    <input type="hidden" id="adminname_id">
                    <label style="vertical-align: inherit;">用 户 名:</label>
                    <input type="text" name="adminname" id="adminname" placeholder="用户名">
                    <label style="vertical-align: inherit;">密 码:</label>
                    <input type="password" name="password" id="password" placeholder="密码">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="editsubmit()">提交更改</button>
                </div>
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

    function del_roles() {

        if (confirm("是否删除该管理员？")) {
            let aid = $("#adminid").val();
            let data = {
                "adminid": aid
            };
            //console.log(uid);
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
    });
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


<script>
    var transdata = function (adminame, password, adminid) {
        $("#adminname").val(adminame);
        $("#password").val(password);
        $("#adminid").val(adminid);

    };
    var editsubmit = function () {

        var adminname = $("#adminname").val();
        var password = $("#password").val();
        var adminid = $("#adminid").val();

        $.ajax({
            url: 'process.php',
            type: 'post',
            data: {"adminname": adminname, "password": password, "adminid": adminid},
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

    }

    function f(nameid) {
        console.log(nameid);
        $("#adminname_id").val(nameid);

    }

</script>
</html>
