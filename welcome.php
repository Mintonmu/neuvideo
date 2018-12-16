<!DOCTYPE>
<html>
<?php
//if ($_SERVER['HTTP_REFERER'] == "") {
//    echo "<script>confirm('本系统不允许从地址栏访问');</script>";
//    echo "<script>location.href= \"index.php\";</script>";
//    exit();
//}
//?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Neu视频</title>
    <link rel="stylesheet" type="text/css" href="assets/banner.css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/reset.css">
    <link rel="stylesheet" type="text/css" href="./assets/css.css">
</head>
<body style="background-image: url('./index/backimage.jpeg');background-repeat: no-repeat;">
<nav class="navbar navbar-inverse" role="navigation" style="padding-bottom: 0">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Neu视频网站</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">首页</a></li>
                <?php
                include('system/dbConn.php');
                $d = new DBconnect();
                $res = $d->selectALL('videotype');
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<li class="nav-item "><a  class="nav-link" href="CatPage.php?tid=' . $row['tid'] . '">' .
                        $row['typename'] . '</a></li>';
                }
                ?>
                <div class="dropdown pull-right" style="left: 100%">
                    <div class="btn-group pull-right">
                        <a class="btn" href="#"><i class="icon-user"></i><?php
                            session_start();
                            $c = $d->executeSql("select * from users where uname=" . $_SESSION["username"]);
                            $res = mysqli_fetch_assoc($c);

                            echo $_SESSION["username"]; ?></a>
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">修改个人设置</a>
                            </li>
                            <li class="divider"></li>
                            <li><a class="dropdown-item" href="userlogout.php">登出</a></li>
                    </div>
                </div>
            </ul>
            </ul>
        </div>
    </div>
</nav>


<div class="train_banner">
    <ul class="banner_images clearfix">
        <li><a href="#"><img src="index/a9.jpg" alt=""></a></li>
        <li><a href="#"><img src="index/a8.jpg" alt=""></a></li>
        <li><a href="#"><img src="index/a7.jpg" alt=""></a></li>
        <li><a href="#"><img src="index/a4.jpg" alt=""></a></li>
        <li><a href="#"><img src="index/a5.jpg" alt=""></a></li>
        <li><a href="#"><img src="index/a6.jpg" alt=""></a></li>
    </ul>
    <ul class="banner_index clearfix">
        <div class="banner_index-frame">
            <li class='current'></li>
        </div>
    </ul>
    <div class="train_banner_left">
        <div class="train_banner_li"><img src="index/train-banner-left.png"></div>
    </div>
    <div class="train_banner_right">
        <div class="train_banner_li"><img src="index/train-banner-right.png"></div>
    </div>
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
            $video_pic = './posters/' . $row2['pic'];
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
                        <input type="text" name="uname_pro" id="uname_pro" placeholder="用户名"
                               value="<?php echo $res['uname'] ?>">
                        <input type="hidden" id="uid" name="uid" value="<?php echo $res['uid'] ?>"/>
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">密 码:</label>
                        <input type="password" name="password1_pro" id="password1_pro" placeholder="密码"
                               value="<?php echo $res['password'] ?>">
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">性 别:</label>
                        <br>
                        <input type="radio" name="gender_pro"
                               value="0" <?php if ($res['gender'] == '0') echo 'checked' ?>>男
                        &nbsp;&nbsp;
                        <input type="radio" name="gender_pro"
                               value="1"<?php if ($res['gender'] == '1') echo 'checked' ?>>女
                        <br>
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">生 日:</label>
                        <br>
                        <input type="date" name="birthdate_pro" id="birthdate_pro"
                               value="<?php echo $res['birthdate'] ?>">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="pic">头像</label>
                        <input type="file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)" accept="image/*"/>
                        <img id="xmTanImg" style="height: 20%;width: 50%" src="<?php echo $res['pic'] ?>"/>
                        <div id="xmTanDiv"></div>
                        <br>
                    </div>

                    <div class="form-group">
                        <label style="vertical-align: inherit;">电子邮箱:</label>
                        <input type="email" name="email_pro" id="email_pro" placeholder="电子邮箱"
                               value="<?php echo $res['email'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="modify_f()">提交更改</button>
            </div>

            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>


<div style="text-align:center;">
</div>
</body>

</html>

<script type="text/javascript" src="assets/index.js"></script>
<script>
    window.onload = function () {
        banner();
    }
</script>
<script>

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
            url: 'admin/update.php',
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
