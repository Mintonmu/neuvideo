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
                    <li><a href="stats.html">Stats</a></li>
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
                    <li><a href="users.php">Users</a></li>
                    <li class="active"><a href="roles.php">Roles</a></li>
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
            <div class="row-fluid">
                <div class="page-header">
                    <h1>Roles
                        <small>Manage roles</small>
                    </h1>
                </div>
                <table class="table table-striped table-bordered table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Description</th>
                        <th>Slug</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="list-roles">
                        <td>1</td>
                        <td>Admin</td>
                        <td>Aliquam erat volutpat. Vivamus molestie tempor pellentesque. Praesent lobortis, neque.</td>
                        <td>admin</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="list-roles">
                        <td>2</td>
                        <td>Moderator</td>
                        <td>Phasellus scelerisque, quam ac bibendum pulvinar, erat ligula pulvinar risus, in
                            ultricies...
                        </td>
                        <td>mod</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="list-roles">
                        <td>3</td>
                        <td>User</td>
                        <td>Donec cursus, velit eu fermentum ullamcorper, libero est.</td>
                        <td>user</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">Actions <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                    <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <a href="new-role.php" class="btn btn-success">New Role</a>
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
    });
</script>
</body>
</html>
