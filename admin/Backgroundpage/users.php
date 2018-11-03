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
            <a class="brand" href="#">Neu视频后台管理系统</a>
            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.html"><i class="icon-user"></i><?php if (!isset($_SESSION)) {
                        session_start();
                    }
                    echo $_SESSION["adminname"]; ?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="my-profile.html">我的信息</a></li>
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
                            <li><a href="new-user.php">添加用户</a></li>
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
                    <li><a href="stats.html">状态</a></li>
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
                    <li class="nav-header"><i class="icon-signal"></i> Statistics</li>
                    <li><a href="stats.html">General</a></li>
                    <li><a href="user-stats.html">Users</a></li>
                    <li><a href="visitor-stats.html">Visitors</a></li>
                    <li class="nav-header"><i class="icon-user"></i> Profile</li>
                    <li><a href="my-profile.html">我的信息</a></li>
                    <li><a href="#">个人设置</a></li>
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require("./getpages.php");
                    if (!isset($_GET["num"])) {
                        $_GET['num'] = 1;
                    }
                    if (!isset($_GET["size"])) {
                        $_GET['size'] = 10;
                    }
                    $ary = getUsersDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-users">';
                        echo "<td>" . $num['uid'] . "</td >";
                        echo "<td>" . $num['uname'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">设置<span
                                                                    class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#"><i class="icon-pencil"></i>编辑</a></li>
                                                            <li><a href="#"><i class="icon-trash"></i> 删除</a></li>
                                                        </ul>
                                                    </div>
                                                </td>';
                        echo "</tr>";
                    }

                    ?>
                    <!--                    <tr class="list-users">-->
                    <!--                        <td>10</td>-->
                    <!--                        <td>Joni D. Soto</td>-->
                    <!--                        <td>jonidsoto@provider.com</td>-->
                    <!--                        <td>215-xxx-xxxx</td>-->
                    <!--                        <td>Philadelphia, PA</td>-->
                    <!--                        <td>User</td>-->
                    <!--                        <td><span class="label label-important">Inactive</span></td>-->
                    <!--                        <td>-->
                    <!--                            <div class="btn-group">-->
                    <!--                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span-->
                    <!--                                            class="caret"></span></a>-->
                    <!--                                <ul class="dropdown-menu">-->
                    <!--                                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>-->
                    <!--                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>-->
                    <!--                                    <li><a href="#"><i class="icon-user"></i> Details</a></li>-->
                    <!--                                    <li class="nav-header">Permissions</li>-->
                    <!--                                    <li><a href="#"><i class="icon-lock"></i> Make <strong>Admin</strong></a></li>-->
                    <!--                                    <li><a href="#"><i class="icon-lock"></i> Make <strong>Moderator</strong></a></li>-->
                    <!--                                    <li><a href="#"><i class="icon-lock"></i> Make <strong>User</strong></a></li>-->
                    <!--                                </ul>-->
                    <!--                            </div>-->
                    <!--                        </td>-->
                    <!--                    </tr>-->
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
                <a href="new-user.php" class="btn btn-success">新用户</a>
            </div>
        </div>
    </div>
    <hr>
    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>
</div>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
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
</script>
</body>
</html>
