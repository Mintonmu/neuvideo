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
    <!--[if lte IE 8]>
    <script src="js/excanvas.min.js"></script><![endif]-->
    <style type="text/css">
        html, body {
            height: 100%;
        }
    </style>
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
                <a class="btn" href="my-profile.php"><i class="icon-user"></i> <?php if (!isset($_SESSION)) {
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
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">用户 <b
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
                            <li><a href="videotype.php">视频类型管理</a></li>
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
                    <li><a href="videotype.php">视频类型管理</a></li>
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
                    <h1>视频
                        <small>视频管理</small>
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
                    $ary = getVideoDate($_GET['num'], $_GET['size']);

                    while ($num = mysqli_fetch_assoc($ary[0])) {
                        echo '<tr class="list-roles">';
                        echo "<td >" . $num['vid'] . "</td >";
                        echo "<td id='" . "videoname_" . $num['vid'] . "'>" . $num['videoname'] . "</td >";
                        echo '<td>
                               <div class="btn-group">
                                                 <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#" onclick="trandata(\'' . $num["vid"] . '\',\'' . $num["videoname"] . '\',\'' . $num["tid"] . '\',\'' . $num["pic"] . '\',\'' . $num["intro"] . '\',\'' . $num["uploadadmin"] . '\',\'' . $num["address"] . '\');">设置<span class="caret"></span></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="icon-pencil"></i>编辑</a></li>
                                                            <li><a href="../update.php?vid=' . $num['vid'] . '"><i class="icon-trash"></i> 删除</a></li>
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
                        if (intval($_GET['num']) == 1) {
                            echo "<li><a href=\"video.php?num=1&size=" . $_GET['size'] . "\">Prev</a></li>";

                        } else {
                            echo "<li><a href=\"video.php?num=" . (intval($_GET['num']) - 1) . "&size=" . $_GET['size'] . "\">Prev</a></li>";
                        }
                        for ($i = 1; $i <= $ary[1]; $i++) {
                            echo "<li>" . "<a href=\"video.php?num=$i&size=" . $_GET['size'] . "\">" . $i . "</a></li>";
                        }
                        if (intval($_GET['num']) == $ary[2]) {
                            echo "<li><a href=\"video.php?num=$ary[2]&size=" . $_GET['size'] . "\">Next</a></li>";

                        } else {
                            echo "<li><a href=\"video.php?num=" . (intval($_GET['num']) + 1) . "&size=" . $_GET['size'] . "\">Next</a></li>";
                        }
                        ?>
                    </ul>

                </div>
                <a href="new-video.php" class="btn btn-success">添加视频</a>
                <br>
                <br>
                <hr>

            </div>
        </div>
    </div>

    <?php
    $p = new DBconnect();
    $Sql = "select * from videotype";
    $result = $p->executeSql($Sql);
    ?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <label style="vertical-align: inherit;">视频名称：</label>
                        <input type="hidden" name="vid" id="vid">
                        <input type="text" name="videoname_pro" id="videoname_pro">
                        <label class="control-label" for="name">视频类型</label>
                        <div class="controls">
                            <select class="form-control" name="videotype_pro" id="videotype_pro">
                                <?php


                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row["tid"]; ?>" selected>
                                        <?php echo $row["typename"]; ?>
                                    </option>
                                    <?php
                                } ?>
                            </select>

                        </div>
                        <label class="control-label" for="name">视频简介</label>
                        <div class="controls">
                                <textarea name="description_pro" id="description_pro" rows="4" cols="30"
                                          style="line-height: 1.5;height: 100px;"
                                          placeholder="请输入视频相关简介....."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pic">视频海报</label>
                            <input type="file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)"
                                   accept="image/*"/>
                            <label>原视频海报</label>
                            <img id="xmTanImg" style="height: 20%;width: 30%" src=""/>
                            <div id="xmTanDiv"></div>
                            <br>
                        </div>
                        <label class="control-label" for="email">下载地址</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="address_pro" id="address_pro"/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="modify_submit()">提交更改</button>
                </div>

                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>

    <hr>

    <footer class="well">
        <a>HackRandom工作室 版权所有©2018-2020 技术支持电话：13099255092</a>
    </footer>

</div>

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/jquery.flot.js"></script>
<script src="../assets/js/jquery.flot.resize.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
    function add_videotype() {
        let video_type = $("#videotype").val();
        $.ajax({
            url: "process.php",
            data: {"video_type": video_type},
            type: 'post',
            dataType: 'text',
            success: function (result) {
                if (result == "success") {
                    alert("添加视频类型成功");
                    self.location.reload(true);
                }
            },
            error: function (result) {
                alert("添加视频类型失败");
                self.history.go(-1);
            }
        })

    };
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
            console.log("成功读s取....");
            let img = document.getElementById("xmTanImg");
            img.src = e.target.result;
        }
        reader.readAsDataURL(file)
    }

    let trandata = function (vid, videoname, tid, pic, intro, uploadamin, address) {

        $("#vid").val(vid);
        $("#videoname_pro").val(videoname);
        $("#videotype_pro").val(tid);
        $("#xmTanImg").attr("src", "../" + pic);
        $("#description_pro").val(intro);
        $("#address_pro").val(address);

    };
    var modify_submit = function () {
        let form = new FormData();
        let vid = $("#vid").val();
        let videoname_pro = $("#videoname_pro").val();
        let videotype_pro = $("#videotype_pro option:selected").val();
        let img_file = document.getElementById("xdaTanFileImg");
        let fileObj = img_file.files[0];
        let intro = $("#description_pro").val();
        let address_pro = $("#address_pro").val();

        form.append("vid", vid);
        form.append("videoname_pro", videoname_pro);
        form.append("videotype_pro", videotype_pro);
        form.append("fileObj", fileObj);
        form.append("intro", intro);
        form.append("address_pro", address_pro);

        $.ajax({
            url: "../update.php",
            type: "post",
            data: form,
            dataType: 'text',
            async: false,
            processData: false,
            contentType: false,
            success: function (result) {
                $("#myModal").modal('hide');
                if (result == "success") {
                    $("#vid").val(vid);
                    $("#videoname_pro").val(videoname_pro);
                    $("#videotype_pro").val(videotype_pro);
                    $("#description_pro").val(intro);
                    $("#address_pro").val(address_pro);
                    alert("您已经修改成功");
                    location.reload(true);
                }
            },
            error: function (data) {
                console.log(data);
            }
        })

    };


    $(function () {
        var data = [
            {
                label: 'Page Views',
                data: [[0, 19000], [1, 15500], [2, 11100], [3, 15500]]
            }];
        var dataVisits = [
            {
                label: 'Visits',
                data: [[0, 1980], [1, 1198], [2, 830], [3, 1550]]
            }];
        var options = {
            legend: {
                show: true,
                margin: 10,
                backgroundOpacity: 0.5
            },
            points: {
                show: true,
                radius: 3
            },
            lines: {
                show: true
            },
            grid: {
                borderWidth: 1,
                hoverable: true
            },
            xaxis: {
                axisLabel: 'Month',
                ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
                tickDecimals: 0
            },
            yaxis: {
                tickSize: 1000,
                tickDecimals: 0
            }
        };
        var optionsVisits = {
            legend: {
                show: true,
                margin: 10,
                backgroundOpacity: 0.5
            },
            bars: {
                show: true,
                barWidth: 0.5,
                align: 'center'
            },
            grid: {
                borderWidth: 1,
                hoverable: true
            },
            xaxis: {
                axisLabel: 'Month',
                ticks: [[0, 'Jan'], [1, 'Feb'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sep'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']],
                tickDecimals: 0
            },
            yaxis: {
                tickSize: 1000,
                tickDecimals: 0
            }
        };

        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5,
                border: '1px solid #D6E9C6',
                padding: '2px',
                'background-color': '#DFF0D8',
                opacity: 0.80
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#placeholder, #visits").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    showTooltip(item.pageX, item.pageY, item.series.label + ": " + item.datapoint[1]);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        $.plot($("#placeholder"), data, options);
        $.plot($("#visits"), dataVisits, optionsVisits);
    });
</script>
</body>
</html>
