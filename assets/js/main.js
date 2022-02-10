/*
    Авторизация
 */
$(".btn-signin").click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');

    let email = $('input[name="auth-email"]').val(),
        password = $('input[name="auth-password"]').val(),
        rememberMe = $('.remember:checked').val();

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            email: email,
            password: password,
            rememberMe: rememberMe
        },
        success(data) {
            if (data.status) {
                $(".btn-animate").toggleClass("btn-animate-grow");
                $(".welcome").toggleClass("welcome-left");
                $(".cover-photo").toggleClass("cover-photo-down");
                $(".frame").toggleClass("frame-short");
                $(".profile-photo").toggleClass("profile-photo-down");
                $(".btn-goback").toggleClass("btn-goback-up");
                $(".forgot").toggleClass("forgot-fade");
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.auth-msg').removeClass('none').text(data.message);
            }
        }
    });
});

/*
    Регистрация
 */

$('.btn-signup').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');

    let name = $('input[name="name"]').val(),
        surname = $('input[name="surname"]').val(),
        password = $('input[name="password"]').val(),
        email = $('input[name="email"]').val(),
        password_confirm = $('input[name="confirmpass"]').val();

    let formData = new FormData();
    formData.append('name', name);
    formData.append('surname', surname);
    formData.append('password', password);
    formData.append('confirmpass', password_confirm);
    formData.append('email', email);


    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success(data) {
            if (data.status) {
                $(".nav").toggleClass("nav-up");
                $(".form-signup-left").toggleClass("form-signup-down");
                $(".success").toggleClass("success-left");
                $(".frame").toggleClass("frame-short");
                $("#check").addClass("checked");
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                }
                $('.reg-msg').removeClass('none').text(data.message);
            }
        }
    });

});

$(function () {
    $(".btn").click(function () {
        $(".form-signin").toggleClass("form-signin-left");
        $(".form-signup").toggleClass("form-signup-left");
        $(".frame").toggleClass("frame-long");
        $(".signup-inactive").toggleClass("signup-active");
        $(".signin-active").toggleClass("signin-inactive");
        $(".forgot").toggleClass("forgot-left");
        $(this).removeClass("idle").addClass("active");
    });
});

/*$(function () {
    $(".btn-signup").click(function () {
        $(".nav").toggleClass("nav-up");
        $(".form-signup-left").toggleClass("form-signup-down");
        $(".success").toggleClass("success-left");
        $(".frame").toggleClass("frame-short");
    });
});*/

/*$(function () {
    $(".btn-signin").click(function () {
        $(".btn-animate").toggleClass("btn-animate-grow");
        $(".welcome").toggleClass("welcome-left");
        $(".cover-photo").toggleClass("cover-photo-down");
        $(".frame").toggleClass("frame-short");
        $(".profile-photo").toggleClass("profile-photo-down");
        $(".btn-goback").toggleClass("btn-goback-up");
        $(".forgot").toggleClass("forgot-fade");
    });
});*/
