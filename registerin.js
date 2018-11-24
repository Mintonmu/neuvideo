$('#myModal').on('hide.bs.modal', function () {
    $(this).removeData('bs.modal');
    let toopit = $('#tooltip');
    toopit.css("display", "none");
});

function registerin() {
    let formData = new FormData();
    let img_file = document.getElementById("ipc");
    let fileObj = img_file.files[0];
    let uname = $('#uname').val();
    let password = $('#password1').val();
    let repassword = $('#repassword').val();
    let gender = $("input[name = 'gender']:checked").val();
    let birthdate = $('#birthdate').val();
    let email = $('#email').val();
    let toopit = $('#tooltip');
    msg = '';
    if (uname == '') {
        msg += "用户名为必填字段\n";
    }
    if (password == '' && repassword == '') {
        msg += "密码应为必填字段\n";
    }
    if (birthdate == '') {
        msg += "生日应为必填字段\n";
    }
    if (email == '') {
        msg += "email应为必填字段\n";
    }
    if (img_file.files.length == 0) {
        msg += "请上传头像\n";
    }
    if (password != repassword ? true : false) {
        $('#repassword').attr("class", "alert alert-danger");
    }
    if (msg != '') {
        toopit.css("display", "inline");
        toopit.html(msg);
        return;
    }
    formData.append('uname', uname);
    formData.append('password', password);
    formData.append('repassword', repassword);
    formData.append('gender', gender);
    formData.append('pic', fileObj);
    formData.append('birthdate', birthdate);
    formData.append('email', email);

    $.ajax({
        url: 'doUserRegister.php',
        type: 'post',
        data: formData,
        dataType: 'text',
        async: false,
        processData: false,
        contentType: false,
        success: function (result) {

            console.log(result);
            if (result == "success") {
                alert(result);
                $('#myModal').modal('hide');
                $('#uname').val('');
                $('#password1').val('');
                $('#repassword').val('');
                $("input[name = 'gender']:checked").val('0');
                $('#birthdate').val('');
                $('#email').val('');
            }
        },
        error: function (msg) {
            alert(msg);
        }
    })
}