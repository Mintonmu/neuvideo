<!DOCTYPE>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Neu视频</title>
    <link rel="stylesheet" type="text/css" href="assets/banner.css">
    <script src="./assets/jquery.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script
            <!-- 新 Bootstrap4 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>

    <!-- popper.min.js 用于弹窗、提示、下拉菜单 -->
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>

    <!-- 最新的 Bootstrap4 核心 JavaScript 文件 -->
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>


<body>

<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Neu视频网站</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">首页</a>
        </li>
        <?php

        include('system/dbConn.php');
        $d = new DBconnect();
        $res = $d->selectALL('videotype');
        while ($row = mysqli_fetch_assoc($res)) {
            echo '<li class="nav-item"><a  class="nav-link" href="' . $row['tid'] . '">' .
                $row['typename'] . '</a></li>';
        }
        ?>
        <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="dropdown" style="left: 100%">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <?php if (!isset($_SESSION)) {
                    session_start();
                }

                $c = $d->executeSql("select * from users where uname=" . $_SESSION["username"]);
                $res = mysqli_fetch_assoc($c);
                echo $_SESSION["username"];
                ?>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">修改个人设置</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="userlogout.php">登出</a>
            </div>
        </div>
    </ul>
</nav>


<div class="banner" id="banner1" style="margin: 40px auto;">
    <div class="banner-view"></div>
    <div class="banner-btn"></div>
    <div class="banner-number"></div>
    <div class="banner-progres"></div>
</div>
<div class="container">
    <?php
    $r = $d->executeSql("select * from videotype");
    while ($row = mysqli_fetch_assoc($r)) {
        echo '<div align="center">
        <h1 style="color: #F0F8FF">' . $row['typename'] . '</h1>
        </div>';
        echo '<div class="row">';
        $rr = $d->executeSql("SELECT * FROM ( 
                                SELECT *, ABS(NOW() - uploaddate) AS diffTime 
                                FROM videos
                                ORDER BY diffTime ASC 
                                ) videos where tid = " . $row['tid'] . " LIMIT 3");
        while ($row2 = mysqli_fetch_assoc($rr)) {
            $video_id = $row2['vid'];
            $video_name = $row2['videoname'];
            $video_url = 'videodetail.php?vid=' . $video_id;
            $video_pic = 'admin/' . $row2['pic'];
            echo '<div class="col-xs-6 col-md-4" align="center">' .

                '<a href="' . $video_url . '" class="thumbnail">' .
                '<img src="' . $video_pic . '" alt="' . $video_name . '">' .
                '</a>' .
                '<a href="' . $video_url . '"><lable id="title" > <font size="5">' . $video_name . '</font></lable></a>' .
                '</div>';
        }
        echo '</div>';
    }
    ?>


</div>


<form action="" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">我的信息</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label style="vertical-align: inherit;">用 户 名:</label>
                        <input type="text" name="uname" id="uname" placeholder="用户名"
                               value="<?php echo $res['uname'] ?>">
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">密 码:</label>
                        <input type="password" name="password1" id="password1" placeholder="密码">
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">性 别:</label>
                        <br>
                        <input type="radio" name="gender" value="0" <?php if ($res['gender'] == '0') echo 'checked' ?>>男
                        &nbsp;&nbsp;
                        <input type="radio" name="gender" value="1"<?php if ($res['gender'] == '1') echo 'checked' ?>>女
                        <br>
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">生 日:</label>
                        <br>
                        <input type="date" name="birthdate" id="birthdate" value="<?php echo $res['birthdate'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pic">头像</label>
                        <input type="file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)" accept="image/*"/>
                        <img id="xmTanImg"  style="height: 20%;width: 50%" src="<?php echo $res['pic'] ?>"/>
                        <div id="xmTanDiv"></div>
                        <br>
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">电子邮箱:</label>
                        <input type="email" name="email" id="email" placeholder="电子邮箱"
                               value="<?php echo $res['email'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">提交更改</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <script type="text/javascript" src="assets/banner.js"></script>
    <script type="text/javascript">

        var banner = new FragmentBanner({
            container: "#banner1",//选择容器 必选
            imgs: ['index/a1.png', 'index/a2.png', 'index/a3.png', 'index/a4.png', 'index/a5.png'],//图片集合 必选
            size: {
                width: 1000,
                height: 560
            },//容器的大小 可选
            //行数与列数 可选
            grid: {
                line: 12,
                list: 14
            },
            index: 0,//图片集合的索引位置 可选
            type: 2,//切换类型 1 ， 2 可选
            boxTime: 5000,//小方块来回运动的时长 可选
            fnTime: 10000//banner切换的时长 可选
        });
    </script>

    <div style="text-align:center;">
    </div>
</body>

</html>
<?php
//if ($_SERVER['HTTP_REFERER'] == "") {
//    echo "<script>confirm('本系统不允许从地址栏访问');</script>";
//    echo "<script>location.href= \"index.php\";</script>";
//    exit();
//}
//?>
