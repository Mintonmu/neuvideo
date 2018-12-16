<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Neu后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/site.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
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
                    <li><a href="../doAdminLogin.php">登出</a></li>
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
                            <li class="divider"></li>
                            <li><a href="videotype.php">视频类型管理</a> </li>
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
                    <li><a href="roles.php">管理员</a></li>
                    <li class="nav-header"><i class="icon-signal"></i>视频和评论</li>
                    <li><a href="video.php">视频管理</a></li>
                    <li><a href="videotype.php">视频类型管理</a> </li>
                    <li><a href="comment.php">评论管理</a></li>
                    <li class="nav-header"><i class="icon-user"></i>信息</li>
                    <li><a href="my-profile.php">我的信息</a></li>
                    <li><a href="#">我的设置</a></li>
                    <li><a href="../Adminlogout.php">登出</a></li>
                </ul>
            </div>
        </div>
        <div class="span9">
            <div class="row-fluid">
                <div class="page-header">
                    <h1>
                        <small>添加视频</small>
                    </h1>
                </div>
                <form action="../update.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="name">视频名</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="videoname"/>
                            </div>
                        </div>

                        <?php
                        include("../../system/dbConn.php");
                        $p = new DBconnect();
                        $Sql = "select * from videotype";
                        $result = $p->executeSql($Sql);
                        ?>
                        <div class="control-group">
                            <label class="control-label" for="name">视频类型</label>
                            <div class="controls">
                                <select class="form-control" name="videotype">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <option value="<?php echo $row["tid"]; ?>">
                                            <?php echo $row["typename"]; ?>
                                        </option>
                                        <?php
                                    } ?>
                                </select>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="name">视频简介</label>
                            <div class="controls">
                                <textarea name="description" id="description" rows="4" cols="30"
                                          style="line-height: 1.5;height: 100px;"
                                          placeholder="请输入视频相关简介,字数少于100字....."></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="file">上传海报</label>
                            <div class="controls">
                               <span class="btn btn-success fileinput-button">
                                <input type="file" name="pic" id="ipc" accept="image/gif,image/png,image/jpeg">
                            </span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">下载地址</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="address"/>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" class="btn btn-success btn-large"
                                   value="添加视频"/> <a class="btn" href="users.php">取消</a>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>

</div>
<script>
    $("#description").on("input propertychange", function () {
        var $this = $(this),
            _val = $this.val(),
            count = "";
        if (_val.length > 200) {
            $this.val(_val.substring(0, 200));
        }
        count = 100 - $this.val().length;
        $("#text-count").text(count);
    });

</script>

</body>
</html>
