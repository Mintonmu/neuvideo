<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>NeuVideo</title>
    <link href="./favicon.ico" rel="shortcut icon"/>
    <meta name="author" content="fly">

    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <script language="javascript" src="assets/jquery.min.js"></script>
    <link href="assets/css/play.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Neu视频网站</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="welcome.php">首页</a></li>
                <?php
                include('system/dbConn.php');
                $d = new DBconnect();
                $res = $d->selectALL('videotype');
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<li class="nav-item"><a  class="nav-link" href="CatPage.php?tid=' . $row['tid'] . '">' .
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
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </ul>
        </div>
    </div>
</nav>
<div class="head-v3">

    <div class="centers">
        <select style="border:0px;font-size:18px" onchange="xuanzejiekou(this)">
            <option value="http://jqaaa.com/jx.php?url=">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;选择接口</option>
            <option value="http://api.wlzhan.com/sudu/?url=">万能接口1</option>
            <option value="http://api.47ks.com/webcloud/?v=">万能接口2</option>
            <option value="http://jiexi.071811.cc/jx2.php?url=">万能接口3</option>
            <option value="http://jqaaa.com/jq3/?url=&url=">万能接口4</option>
            <option value="http://yun.baiyug.cn/vip/index.php?url=">万能接口5</option>
            <option value="https://jiexi.071811.cc/jx2.php?url=">万能接口6</option>
            <option value="http://api.xiaomil.com/a/index.php?url=">腾讯视频接口1</option>
            <option value="http://api.pucms.com/?url=">爱奇艺超清接口1</option>
            <option value="http://api.baiyug.cn/vip/index.php?url=">爱奇艺超清接口2</option>
            <option value="https://api.flvsp.com/?url=">爱奇艺超清接口3</option>
            <option value="http://api.xfsub.com/index.php?url=">芒果TV超清接口</option>
            <option value="http://65yw.2m.vc/chaojikan.php?url=">芒果TV手机接口</option>
            <option value="http://www.82190555.com/index/qqvod.php?url=">优酷超清接口</option>
            <option value="http://vip.jlsprh.com/index.php?url=">搜狐视频接口</option>
            <option value="http://2gty.com/apiurl/yun.php?url=">乐视视频接口</option>
        </select>
        <div class="searchs">
            <div class="from">

                <?php
                $vid = $_GET['vid'];
                $r = $d->executeSql("select * from videos where vid=" . $vid);
                $res = mysqli_fetch_assoc($r);

                ?>
                <input name="url" id="url" type="text" class="text" value="<?php echo $res['address'] ?>">

                <input name="doplayers" type="button" id="doplayers" class="button" onclick="jiexi()" value="立即播放">
            </div>
            <div id="clear"></div>
        </div>
        <div id="ckplays">
            <iframe id="jiekou" name="jiekou" src="./play.html" width="100%" height="650px"></iframe>
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


        <script type="text/javascript">
            players();
            $("#doplayers").bind("click", function () {
                players()
            });

            function players() {
                var a = $('#url').val();
                if ($('#url').val() == "") {
                    alert('请输入视频网站网址！');
                    $('#url').focus();
                    return (false)
                }
            }

            var jiekou = ""

            function jiexi() {
                var url = document.getElementById("url").value;
                var dizhi = ""

                if (url.indexOf("://") == -1) {
                    url = "http://" + document.getElementById("url").value;
                }

                if (jiekou == "") {
                    document.getElementById("jiekou").src = "https://jx.lache.me/cc/?url=" + url;
                } else {
                    document.getElementById("jiekou").src = jiekou + url;
                }
            }

            function xuanzejiekou(v) {
                var url = document.getElementById("url").value;
                if (url == "") {
                    alert('请输入视频网站网址！');
                } else {
                    jiekou = v.value
                }
            }


            jiexi();
            players();
        </script>
    </div>

</body>
</html>

