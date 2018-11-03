<!DOCTYPE html>
<html lang="en">
<head>
    <!--    --><?php
    //    if ($_SERVER['HTTP_REFERER'] == "") {
    //        echo "<script>alert('本系统不允许从地址栏访问');</script>";
    //        echo "<script>window.close();</script>";
    //        exit();
    //    }
    //    ?>
    <meta charset="utf-8">
    <title>后台管理系统</title>
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
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="welcome.php">主页</a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户 <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-user.html">添加新用户</a></li>
                            <li class="divider"></li>
                            <li><a href="users.html">管理用户</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">管理员 <b
                                    class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="new-role.html">添加管理员</a></li>
                            <li class="divider"></li>
                            <li><a href="roles.html">管理管理员</a></li>
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
                    <li class="nav-header"><i class="icon-wrench"></i> Administration</li>
                    <li class="active"><a href="users.html">Users</a></li>
                    <li><a href="roles.html">Roles</a></li>
                    <li class="nav-header"><i class="icon-signal"></i> Statistics</li>
                    <li><a href="stats.html">General</a></li>
                    <li><a href="user-stats.html">Users</a></li>
                    <li><a href="visitor-stats.html">Visitors</a></li>
                    <li class="nav-header"><i class="icon-user"></i> Profile</li>
                    <li><a href="my-profile.html">My profile</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="well hero-unit">
                <h1>Welcome，<?php echo $_SESSION["adminname"]; ?></h1>
                <p>欢迎您的登录，感谢您选择我们</p>
                <p><a class="btn btn-success btn-large" href="users.html">Manage Users &raquo;</a></p>
            </div>
            <div class="row-fluid">
                <div class="span3">
                    <h3>Total Users</h3>
                    <p><a href="users.html" class="badge badge-inverse">563</a></p>
                </div>
                <div class="span3">
                    <h3>New Users Today</h3>
                    <p><a href="users.html" class="badge badge-inverse">8</a></p>
                </div>
                <div class="span3">
                    <h3>Pending</h3>
                    <p><a href="users.html" class="badge badge-inverse">2</a></p>
                </div>
                <div class="span3">
                    <h3>Roles</h3>
                    <p><a href="roles.html" class="badge badge-inverse">3</a></p>
                </div>
            </div>
            <br/>
            <div class="row-fluid">
                <div class="page-header">
                    <h1>Pending Users
                        <small>Approve or Reject</small>
                    </h1>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="pending-user">
                        <td>564</td>
                        <td>John S. Schwab</td>
                        <td>johnschwab@provider.com</td>
                        <td>402-xxx-xxxx</td>
                        <td>Bassett, NE</td>
                        <td>User</td>
                        <td><span class="label label-important">Inactive</span></td>
                        <td><span class="user-actions"><a href="javascript:void(0);"
                                                          class="label label-success">Approve</a> <a
                                        href="javascript:void(0);" class="label label-important">Reject</a></span></td>
                    </tr>
                    <tr class="pending-user">
                        <td>565</td>
                        <td>Juliana M. Sheffield</td>
                        <td>julianasheffield@provider.com</td>
                        <td>803-xxx-xxxx</td>
                        <td>Columbia, SC</td>
                        <td>User</td>
                        <td><span class="label label-important">Inactive</span></td>
                        <td><span class="user-actions"><a href="javascript:void(0);"
                                                          class="label label-success">Approve</a> <a
                                        href="javascript:void(0);" class="label label-important">Reject</a></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>

    <footer class="well">
        &copy; Strass - More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> -
        Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a>
    </footer>

</div>

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
