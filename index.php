<?php
require "vendor/db.php";

session_start();

if (isset($_SESSION['user'])) {
    header('Location: profile.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log in/Sign up screen animation</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
<div class="container">
    <div class="frame">
        <div class="nav">
            <ul class
            "links">
            <li class="signin-active"><a class="btn">Sign in</a></li>
            <li class="signup-inactive"><a class="btn">Sign up </a></li>
            </ul>
        </div>
        <div ng-app ng-init="checked = false">
            <form class="form-signin" method="post" name="form">
                <label for="auth-email">Email</label>
                <input class="form-styling" type="text" name="auth-email"/>
                <label for="auth-password">Password</label>
                <input class="form-styling" type="text" name="auth-password"/>
                <input type="checkbox" id="checkbox" class="remember"/>
                <label for="checkbox"><span class="ui"></span>Keep me signed in</label>
                <div class="btn-animate">
                    <a class="btn-signin" type="submit">Sign in</a>
                </div>
                <p class="auth-msg none">Lorem ipsum dolor sit amet.</p>
            </form>

            <form class="form-signup" method="post" name="form">
                <label for="name">Name</label>
                <input class="form-styling" type="text" name="name"/>
                <label for="surname">Surname</label>
                <input class="form-styling" type="text" name="surname"/>
                <label for="email">Email</label>
                <input class="form-styling" type="text" name="email"/>
                <label for="password">Password</label>
                <input class="form-styling" type="text" name="password"/>
                <label for="confirmpass">Confirm password</label>
                <input class="form-styling" type="text" name="confirmpass"/>
                <a ng-click="checked = !checked" class="btn-signup" type="submit">
                    Sign Up
                </a>
                <p class="reg-msg none">Lorem ipsum dolor sit amet.</p>
            </form>

            <div class="success">
                    <svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                         viewBox="0 0 100 100" id="check">
                        <g><path fill-rule="evenodd"
                                 clip-rule="evenodd"
                                 fill="#6BBE66"
                                 d="M48,0c26.51,0,48,21.49,48,48S74.51,96,48,96S0,74.51,0,48 S21.49,0,48,0L48,0z M26.764,49.277c0.644-3.734,4.906-5.813,8.269-3.79c0.305,0.182,0.596,0.398,0.867,0.646l0.026,0.025 c1.509,1.446,3.2,2.951,4.876,4.443l1.438,1.291l17.063-17.898c1.019-1.067,1.764-1.757,3.293-2.101 c5.235-1.155,8.916,5.244,5.206,9.155L46.536,63.366c-2.003,2.137-5.583,2.332-7.736,0.291c-1.234-1.146-2.576-2.312-3.933-3.489 c-2.35-2.042-4.747-4.125-6.701-6.187C26.993,52.809,26.487,50.89,26.764,49.277L26.764,49.277z"/></g></svg>
                    <div class="successtext">
                        <p> Thanks for signing up! Check your email for confirmation.</p>
                    </div>
            </div>
        </div>

        <div class="forgot">
            <a href="#">Forgot your password?</a>
        </div>

        <div>
            <div class="cover-photo"></div>
            <div class="profile-photo"></div>
            <h1 class="welcome">Welcome to my site</h1>
            <a class="btn-go-profile" href="profile.php">Go profile</a>
            <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
        </div>
    </div>

    <a id="refresh" value="Refresh" onClick="history.go()">
        <svg class="refreshicon" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
             width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;"
             xml:space="preserve">
         <path d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z"/>
    </svg>
    </a>
</div>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js'></script>
<script src="assets/js/main.js"></script>
</body>
</html>
