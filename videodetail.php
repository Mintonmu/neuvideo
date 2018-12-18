<!DOCTYPE html>
<html lang="zh-cmn-Hans" class="ua-mac ua-webkit">
<head>
    <?php
    session_start();
    $vid = $_GET['vid'];

    include("system/dbConn.php");
    $d = new DBconnect();
    $r = $d->executeSql("select * from videos where vid=" . $vid);
    $rese = mysqli_fetch_assoc($r);
    $d->update("videos", array("hittimes"), array($rese['hittimes'] + 1), "vid", $vid);
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Neu视频</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"
          href="https://img3.doubanio.com/f/shire/8377b9498330a2e6f056d863987cc7a37eb4d486/css/ui/dialog.css"/>
    <link rel="stylesheet" type="text/css"
          href="https://img3.doubanio.com/f/movie/1d829b8605b9e81435b127cbf3d16563aaa51838/css/movie/mod/reg_login_pop.css"/>
    <link href="https://img3.doubanio.com/f/shire/bf61b1fa02f564a4a8f809da7c7179b883a56146/css/douban.css"
          rel="stylesheet" type="text/css">
    <link href="https://img3.doubanio.com/f/shire/ae3f5a3e3085968370b1fc63afcecb22d3284848/css/separation/_all.css"
          rel="stylesheet" type="text/css">
    <link href="https://img3.doubanio.com/f/movie/8864d3756094f5272d3c93e30ee2e324665855b0/css/movie/base/init.css"
          rel="stylesheet">
    <link rel="alternate" href="android-app://com.douban.movie/doubanmovie/subject/25890005/"/>
    <link rel="stylesheet" href="https://img3.doubanio.com/dae/cdnlib/libs/LikeButton/1.0.5/style.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>

    <script src="assets/star.js"></script>
    <script src="assets/jquery.rating-stars.min.js"></script>
    <style type="text/css">
        img {
            max-width: 100%;
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: #ddd;
        }

        h2 {
            text-align: center;
        }

        .rating {
            position: relative;
            width: 240px;
            height: 45px;
            background: url(index/icon.png) repeat-x;
            margin: 20px;
        }

        .rating-disply {
            width: 48px;
            height: 45px;
            background-position: 0 -45px;
            background: url(index/icon.png) repeat-x 0 -44px;

        }

        .rating-mask {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .rating-item {
            list-style: none;
            float: left;
            width: 48px;
            height: 45px;
            cursor: pointer;
        }


    </style>
    <link rel="stylesheet" href="https://img3.doubanio.com/misc/mixed_static/3ec890df550a76f7.css">
</head>

<body>

<?php

$r = $d->executeSql("select * from levels where vid=$vid and uid=" . $_SESSION['uid']);

$rr = mysqli_fetch_assoc($r);
if ($rr){
    $score = $rr['score'];
}else{
    $score=0;
}
//echo "select * from levels where vid=$vid and uid=".$_SESSION['uid'];

?>


<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Neu视频网站</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="welcome.php">首页</a></li>
                <?php
                $res = $d->selectALL('videotype');
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<li class="nav-item"><a  class="nav-link" href="CatPage.php?tid=' . $row['tid'] . '">' .
                        $row['typename'] . '</a></li>';
                }
                ?>
                <div class="dropdown pull-right" style="left: 100%">
                    <div class="btn-group pull-right">
                        <a class="btn" href="#"><i class="icon-user"></i><?php

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
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </ul>
        </div>
    </div>
</nav>
<div id="wrapper" style="text-align: center">

    <div id="content">

        <h1>
            <span style="text-align: left" property="v:itemreviewed"><?php echo $rese['videoname'] ?></span>
            <span class="year"> <small> 上传于: <?php echo $rese['uploaddate'] ?> </small></span>
        </h1>

        <div class="grid-16-8 clearfix">

            <div class="indent clearfix">
                <div class="subjectwrap clearfix">

                    <div class="subject clearfix">

                        <div id="mainpic" class="">
                            <img src="admin/<?php echo $rese['pic'] ?>" title="点击看更多海报" alt="山河故人"/>
                        </div>
                        <!-- 简介 -->
                        <div id="info">
                            <p>
                                <?php echo $rese['intro'] ?>
                            </p>
                        </div>
                    </div>

                    <div id="interest_sect_level" class="clearfix">
                        <input type="hidden" id="vid" value="<?php echo $rese['vid'] ?>">
                        <p><a href="videoplay.php?vid=<?php echo $rese['vid'] ?>" class="btn btn-primary btn-lg"
                              href="#"
                              role="button" style="color: #FFFFFF">播放</a></p>
                        评价:
                        <div class="rating" id="rating2"></div>
                        <textarea id="cmt" rows="10" cols="60" name="cmt"></textarea>

                        <button type="submit" id="comment" onclick="submitdata();">提交评论</button>

                    </div>

                </div>

            </div>
            <?php
            if (!isset($_GET['pageNum'])) {
                $pageNum = 1;
            } else {
                $pageNum = $_GET['pageNum'];
            }
            if (!isset($_GET['pageSize'])) {
                $pageSize = 10;
            } else {
                $pageSize = $_GET['pageSize'];
            }
            //echo $pageNum;
            $sql = "SELECT comments.content,comments.cdate,users.uname,users.pic,levels.score FROM users JOIN comments ON users.uid = comments.uid JOIN levels ON comments.uid = levels.uid AND comments.vid = levels.vid  where levels.vid = " . $_GET['vid'] . " order by cdate limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
            //echo $sql;
            $r = $d->executeSql($sql);
            ?>
            <div class="review-list  ">
                <ul>
                    <?php
                    while ($resc = mysqli_fetch_assoc($r)) {
                        echo '<li>
        
        <div class="main review-item" id="7019675">
    <header class="main-hd">
        <a>
            <img width="24" height="24" src=' . $resc['pic'] . '>
        </a>
        <a property="v:reviewer" class="name">' . $resc['uname'] . '</a>
        <b style="color:#FF4500">' . $resc['score'] . '分</b>
            <span property="v:dtreviewed" class="main-meta">' . $resc['cdate'] . '</span>
    </header>
        <div class="main-bd">
            <div id="review_7019675_short" class="review-short" data-rid="7019675">
                <div class="short-content">
                    <!-- 回复 -->
        ' . $resc['content'] . '
                </div>
            </div>
            <div id="review_7019675_full" class="hidden">
                <div id="review_7019675_full_content" class="full-content"></div>
            </div>
        </div>
        </div>
    </li>
        </li>';
                    }
                    ?>
                </ul>
                <ul class="pagination">
                    <?php

                    $sql = "SELECT comments.content,comments.cdate,users.uname,users.pic,levels.score FROM users JOIN comments ON users.uid = comments.uid JOIN levels ON comments.uid = levels.uid AND comments.vid = levels.vid  where levels.vid = " . $_GET['vid'];
                    $res = mysqli_num_rows($d->executeSql($sql));
                    $res = intval($res / $pageSize) + 1;
                    //echo $res;

                    if (intval($_GET['pageNum']) == 1) {
                        echo "<li><a href=\"videodetail.php?vid=$vid&pageNum=1&pageSize=$pageSize\">Prev</a></li>";

                    } else {
                        echo "<li><a href=\"videodetail.php?vid=$vid&pageNum=" . (intval($_GET['pageNum']) - 1) . "&pageSize=$pageSize\">Prev</a></li>";
                    }
                    for ($i = 1; $i <= $res; $i++) {
                        echo "<li>" . "<a href=\"videodetail.php?vid=$vid&pageNum=$i&pageSize=$pageSize\">" . $i . "</a></li>";
                    }
                    if (intval($_GET['pageNum']) == $res) {
                        echo "<li><a href=\"videodetail.php?vid=$vid&pageNum=$res&pageSize=$pageSize\">Next</a></li>";

                    } else {
                        echo "<li><a href=\"videodetail.php?vid=$vid&pageNum=" . (intval($_GET['pageNum']) + 1) . "&pageSize=$pageSize\">Next</a></li>";
                    }
                    ?>
                </ul>


</body>
<script type="text/javascript">

    let vid = $("#vid").val();
    $('#rating2').star({
        modus: 'entire', //点亮模式
        total: 5, //几颗星
        num: <?php echo $score;?>, //默认点亮个数
        readOnly: false,//是否只读
        chosen: function (count, total) { //点击后事件
            $.ajax({


                url: "admin/Backgroundpage/process.php",
                type: 'post',
                data: {'count': count, 'vid': vid},
                dataType: 'text',

                success: function (res) {
                    console.log(res);
                    if (res == 'insert') {
                        alert("评价成功");
                    }
                    else if (res == 'update') {
                        alert("更新评价成功");
                    }
                    else {
                        alert("评价失败");
                    }
                },
                error: function (res) {


                }


            })
        }

    })


    let submitdata = function () {
        let cmt = $("#cmt").val();
        let stars = $("#rating-stars-value").val();
        let data = {
            'vid': vid,
            'cmt': cmt,
            'stars': stars,
        };
        $.ajax({
            url: "admin/Backgroundpage/process.php",
            type: 'post',
            data: data,
            dataType: 'text',
            success: function (res) {
                if (res == 'success') {
                    alert("评论成功");
                    $("#cmt").val("");
                }
                else {
                    alert("评论失败");
                }
            },
            error: function (res) {
            }
        })

    };

</script>
<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        background: #ddd;
    }

    h2 {
        text-align: center;
    }
</style>
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