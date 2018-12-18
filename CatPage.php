<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Neu视频网</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body style="background-image: url('./index/backimage.jpeg');background-repeat: no-repeat;">
<?php
if (!isset($_GET['pageNum'])) {
    $_GET['pageNum'] = 1;
}
if (!isset($_GET['pageSize'])) {
    $_GET['pageSize'] = 12;
}
?>
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Neu视频网站</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="welcome.php">首页</a></li>
                <?php
                include('system/dbConn.php');
                $d = new DBconnect();
                $res = $d->selectALL('videotype');
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($_GET['tid'] == $row['tid']) {
                        echo '<li class="nav-item active"><a  class="nav-link" href="CatPage.php?tid=' . $row['tid'] . '">' .
                            $row['typename'] . '</a></li>';
                    } else {

                        echo '<li class="nav-item"><a  class="nav-link" href="CatPage.php?tid=' . $row['tid'] . '">' .
                            $row['typename'] . '</a></li>';
                    }
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
            <form class="form-inline mt-2 mt-md-0">
                <input name="search" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </ul>
        </div>
    </div>
</nav>
<div class="bs-example" data-example-id="thumbnails-with-custom-content">

    <?php
    $pageNum = $_GET['pageNum'];
    $pageSize = $_GET['pageSize'];
    if (isset($_GET['tid']) && isset($_GET['search'])) {
        $sql = 'select * from videos where tid=' . $_GET['tid'] . ' and videoname like "%' . $_GET['search'] . '%"  limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql;
        $r = $d->executeSql($sql);
        $sql1 = 'select count(*) as number from videos where tid=' . $_GET['tid'] . ' and videoname like "%' . $_GET['search'] . '%"  limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql1;
        $res = mysqli_fetch_assoc($d->executeSql($sql1));
        $data = intval($res['number'] / $pageSize) + 1;
    } else if (isset($_GET['tid'])) {
        $sql = "select * from videos where tid=" . $_GET['tid'] . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql;
        $r = $d->executeSql($sql);
        $sql1 = "select count(*) as number from videos where tid=" . $_GET['tid'] . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql1;
        $res = mysqli_fetch_assoc($d->executeSql($sql1));

        $data = intval($res['number'] / $pageSize) + 1;

    } else if (isset($_GET['search'])) {
        $sql = 'select * from videos where videoname like "%' . $_GET['search'] . '%"' . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
        //echo $sql;
        $r = $d->executeSql($sql);
        $sql1 = 'select count(*) as number from videos where videoname like "%' . $_GET['search'] . '%"' . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql1;
        $res = mysqli_fetch_assoc($d->executeSql($sql1));
        $data = intval($res['number'] / $pageSize) + 1;
    } else {
        $sql = 'select * from videos' . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
        //echo $sql;
        $r = $d->executeSql($sql);
        $sql1 = 'select count(*) as number from videos' . ' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
        //echo $sql1;
        $res = mysqli_fetch_assoc($d->executeSql($sql1));
        $data = intval($res['number'] / $pageSize) + 1;
    }
    while ($res = mysqli_fetch_assoc($r)) {
        echo '<div class="row"><div class="col-sm-6 col-md-4"><div class="thumbnail">';
        echo '<img data-src="posters/' . $res['pic'] . ' alt="50%x100" src="posters/' . $res['pic'] . '" data-holder-rendered="true" style="height: 50%; width: 50%; display: block;">';
        echo ' <div class="caption"><h3>' . $res['videoname'] . '</h3>';
        echo '<p>' . $res['intro'] . '</p>';
        echo '<p><a href="videodetail.php?vid=' . $res['vid'] . '" class="btn btn-primary" role="button">详情</a></p>
          </div>
        </div>
      </div>';
    }
    ?>
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

</body>
<script type="text/javascript" src="assets/js/swiper.min.js"></script>
<script type="text/javascript">


    window.onload = function () {
        var swiper = new Swiper('.swiper-container', {
            autoplay: true,
            speed: 2500,
            autoplayDisableOnInteraction: false,
            loop: true,
            centeredSlides: true,
            slidesPerView: 2,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            prevButton: '.swiper-button-prev',
            nextButton: '.swiper-button-next',
            onInit: function (swiper) {
                swiper.slides[2].className = "swiper-slide swiper-slide-active";
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                }
            }
        });
    }

</script>


<script type="text/javascript">
    //判断浏览器是否支持FileReader接口
    if (typeof FileReader == 'undefined') {
        document.getElementById("xmTanDiv").InnerHTML = "<h1>当前浏览器不支持FileReader接口</h1>";
        //使选择控件不可操作
        document.getElementById("xmTanImg").setAttribute("disabled", "disabled");
    }

    //选择图片，马上预览
    function xmTanUploadImg(obj) {
        var file = obj.files[0];
        console.log(obj);
        console.log(file);
        console.log("file.size = " + file.size);  //file.size 单位为byte
        var reader = new FileReader();
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
            var img = document.getElementById("xmTanImg");
            img.src = e.target.result;
            //或者 img.src = this.result;  //e.target == this
        }
        reader.readAsDataURL(file)
    }
</script>
</html>
