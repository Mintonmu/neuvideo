<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php
    if(!isset($_GET['pageNum'])){
        $_GET['pageNum']=1;
    }
    if(!isset($_GET['pageSize'])){
        $_GET['pageSize']=12;
    }
?>

<nav class="navbar navbar-default" style="background-color: #1E1E1E">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">NeuVideo</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/neuvideo">首页 <span class="sr-only">(current)</span></a></li>
                <?php
                include('database.php');
                $d = new DataBase();
                $res = $d->selectALL('videotype');
                while ($row = mysqli_fetch_assoc($res)) {
                //                    echo $row['adminname'] . '<br>';
                if($_GET['tid']!=$row['tid']){
                echo '<li><a href="cat.php?tid=' . $row['tid'] . '">' .
                $row['typename'] . '</a></li>';
                }else{
                echo '<li class="active"><a href="cat.php?tid=' . $row['tid'] . '">' .
                $row['typename'] . '</a></li>';
                }
                }
                ?>
            </ul>
            <!--搜索-->
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="关键字" name="search">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            <ul class="nav navbar-nav topbar-nav ml-md-auto align-items-center navbar-right">
                <?php if(isset($_COOKIE["username"]))
                {
                    echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="collapse"
                                                  data-target="#help-dropdown" href="#"><i class="icon-info-sign"></i>';
                $c = $d->executeSql("select * from users where uid=".$_COOKIE["uid"]);
                $res = mysqli_fetch_assoc($c);
                echo $res['uname'];
                echo '<b class="caret"></b></a> <ul id="help-dropdown" class="collapse">
                <li><a onclick="modify()">修改个人设置</a></li> <li><a onclick="logout()">登出</a></li>
            </ul> </li>'; }else{ echo "<li><a onclick='openLogin()'>登录</a></li>";
                echo "<li><a onclick='openRegister()'>注册</a></li>"; } ?>
                <!-- /.dropdown-user --> </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="bs-example" data-example-id="thumbnails-with-custom-content">

    <?php
    $pageNum = $_GET['pageNum'];
    $pageSize = $_GET['pageSize'];
    if(isset($_GET['tid'])&&isset($_GET['search'])){
        $sql ='select * from videos where tid='.$_GET['tid'].' and videoname like "%' . $_GET['search'] . '%"  limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
        //echo $sql;
        $r = $d->executeSql($sql);
    $sql1 ='select count(*) as number from videos where tid='.$_GET['tid'].' and videoname like "%' . $_GET['search'] . '%"  limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    //echo $sql1;
    $res = mysqli_fetch_assoc($d->executeSql($sql1));
    $data = intval($res['number']/$pageSize)+1;
    }else if(isset($_GET['tid'])){
    $sql ="select * from videos where tid=".$_GET['tid'].' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    //echo $sql;
    $r = $d->executeSql($sql);
    $sql1 ="select count(*) as number from videos where tid=".$_GET['tid'].' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    //echo $sql1;
    $res = mysqli_fetch_assoc($d->executeSql($sql1));

    $data = intval($res['number']/$pageSize)+1;

    }else if(isset($_GET['search'])){
    $sql ='select * from videos where videoname like "%'.$_GET['search'].'%"'.' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
    //echo $sql;
    $r = $d->executeSql($sql);
    $sql1 = 'select count(*) as number from videos where videoname like "%'.$_GET['search'].'%"'.' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    //echo $sql1;
    $res = mysqli_fetch_assoc($d->executeSql($sql1));
    $data = intval($res['number']/$pageSize)+1;
    }else{
    $sql ='select * from videos'.' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
    //echo $sql;
    $r = $d->executeSql($sql);
    $sql1 ='select count(*) as number from videos'.' limit ' . (($pageNum - 1) * $pageSize) . "," . $pageSize;;
    //echo $sql1;
    $res = mysqli_fetch_assoc($d->executeSql($sql1));
    $data = intval($res['number']/$pageSize)+1;
    }
    while($res = mysqli_fetch_assoc($r))
    {
    echo '<div class="row"><div class="col-sm-6 col-md-4"><div class="thumbnail">';
    echo '<img data-src="admin/'.$res['pic'] .' alt="50%x100" src="admin/'. $res['pic'] .'" data-holder-rendered="true" style="height: 50%; width: 50%; display: block;">';
    echo ' <div class="caption"><h3>' .$res['videoname'] . '</h3>';
        echo '<p>'.$res['intro']. '</p>';
        echo '<p><a href="videodetail.php?vid='. $res['vid'] .'" class="btn btn-primary" role="button">详情</a></p>
    </div>
</div>
</div>';
    }
    ?>
</div>

</div>


</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">新增</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="txt_departmentname">用户名</label>
                    <input type="text" name="username" class="form-control" id="username"
                           placeholder="用户名">

                </div>
                <div class="form-group">
                    <label for="txt_parentdepartment">密码</label>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="密码">
                </div>

                <div class="form-group" style="display:None" id="repassword_input">
                    <label for="txt_parentdepartment">确认密码</label>
                    <input type="password" name="repassword" class="form-control" id="repassword"
                           placeholder="确认密码">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭
                </button>
                <button type="button" id="btn_submit" class="btn btn-primary"><span
                        class="glyphicon glyphicon-floppy-disk"></span>保存
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modify_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                <?php

                            $c = $d->executeSql("select * from users where uid=".$_COOKIE["uid"]);
                $res = mysqli_fetch_assoc($c);

                ?>


                <h4 class="modal-title" id="modify_label">修改</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="txt_departmentname">用户名</label>
                    <input type="text" name="username" class="form-control" id="busername"
                           placeholder="用户名" value="<?php echo $res['uname']?>">
                    <input hidden id="uid" value="<?php echo $res['uid']?>" />

                </div>
                <div class="form-group">
                    <label for="txt_parentdepartment">密码</label>
                    <input type="password" name="password" class="form-control" id="bpassword"
                           placeholder="密码">
                </div>
                <div class="form-group">
                    <label for="gender">性别</label>

                    <input type="radio" name="gender" value="0" <?php if($res['gender']=='0') echo 'checked' ?> >男
                    &nbsp;
                    <input type="radio" name="gender" value="1" <?php if($res['gender']=='1') echo 'checked' ?> >女
                </div>
                <div class="form-group">
                    <label for="birthday">生日</label>
                    <input type="date" name="birthday" class="form-control" id="birthday" value="<?php echo $res['birthdate']?>">
                </div>

                <div class="form-group">
                    <label for="pic">头像</label>
                    <input type="file" id="xdaTanFileImg" onchange="xmTanUploadImg(this)" accept="image/*"/>
                    <img id="xmTanImg" src="<?php echo "admin/".$res['pic'] ?>" />
                    <div id="xmTanDiv"></div>
                </div>
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="邮箱" value="<?php echo $res['email']?>">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="delMember">
                    删除
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span
                        class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭
                </button>
                <button type="button" onclick="modify_f()" class="btn btn-primary"><span
                        class="glyphicon glyphicon-floppy-disk"></span>保存
                </button>
            </div>
        </form>
    </div>
</div>

</body>
<script type="text/javascript" src="assets/js/swiper.min.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var swiper = new Swiper('.swiper-container',{
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
            onInit: function(swiper) {
                swiper.slides[2].className = "swiper-slide swiper-slide-active";
            },
            breakpoints: {
                668: {
                    slidesPerView: 1,
                }
            }
        });
    }

    function openLogin() {
        $("#myModalLabel").text("登录");
        $("#repassword_input").hide();
        $('#myModal').modal();
    }

    function openRegister() {
        $("#myModalLabel").text("注册");
        $("#repassword_input").show();
        $('#myModal').modal();
    }

    $(function(){
        $("#btn_submit").click(function() {
            if($("#myModalLabel").text()=="登录"){
                login();
            }else{
                register();
            }
        });
    });
    function login(){
        let _username = $("#username").val();
        let _password = $("#password").val();
        var datas = {
            username: _username,
            password: _password,
            flag:0
        };
        $.ajax({
            url: 'login.php',
            type: 'post',
            data: datas,
            dataType: 'text',
            success: function (result) {
                console.log(result);
                if (result === 'success') {
                    alert('登录成功');
                    window.location.reload();
                }else{
                    alert("登录失败: "+result);
                }
            },
            error: function (data) {
                alert("登录失败: "+data);
            }
        })
    }
    function register(){
        console.log("register");
        let _username = $("#username").val();
        let _password = $("#password").val();
        let repassword = $("#repassword").val();
        if(_password!=repassword){
            alert('密码不相同');
            return;
        }
        var datas = {
            username: _username,
            password: _password,
            flag:1
        };
        $.ajax({
            url: 'login.php',
            type: 'post',
            data: datas,
            dataType: 'text',
            success: function (result) {
                console.log(result);
                if (result === 'success') {
                    alert('注册成功');
                    window.location.reload();
                }else{
                    alert("注册失败: "+result);
                }
            },
            error: function (date) {
                alert("注册失败"+date);
            }
        })
    }
    //todo:  修改id
    function modify_f() {

        let username = $('#busername').val();
        if (username === '') {
            alert("必须输入用户名");
            return;
        }
        var form = new FormData();
        let password = $('#bpassword').val();
        if (password != '') {
            form.append("password", password);
        }
        let type = $("input[name = 'gender']:checked").val();
        console.log(type);
        let birthday = $('#birthday').val();
        let email = $('#email').val();
        var img_file = document.getElementById("xdaTanFileImg");
        var fileObj = img_file.files[0];
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
        var uid = $('#uid').val();
        form.append('uid', uid);

        $.ajax({
            url: 'admin/process.php',
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
            error: function () {
                alert("失败");
                window.location.reload();
            }
        })
    }
    function logout(){
        setCookie("username", "", -1);
        alert("登出");
        window.location.reload();
    }
    //设置cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
    function modify(){
        $("#modify_label").text("修改个人信息");
        $('#modify_dialog').modal();
    }
    function openSearch(){
        let te = $("#search").val();
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