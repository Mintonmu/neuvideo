function login() {
    var username = document.getElementById("ID").value;
    var password = document.getElementById("PASSWORD").value;
    if (username == "") {
        $.jGrowl("用户名不能为空！", {header: '提醒'});
    } else if (password == "") {
        $.jGrowl("密码不能为空！", {header: '提醒'});
    } else {
        AjaxFunc();
    }
}

function AjaxFunc() {
    var username = document.getElementById("ID").value;
    var password = document.getElementById("PASSWORD").value;
    $.ajax({
        type: 'post',
        url: "doAdminLogin.php",
        dataType: "text",
        data: {"adminname": username, "password": password},
        success: function (data) {
            console.log(data);
            if (data != "success") {
                if (confirm("您的密码或者用户名错误！！")) {
                    console.log("focus");
                    document.getElementById("ID").focus();
                }
                return;
            }
            self.location.href = "welcome.php"

        },
        error: function (xhr) {
            //
            // confirm("您的密碼或者賬戶錯誤");
            // document.getElementById("ID").focus();

            console.log(xhr);
        }
    });
}