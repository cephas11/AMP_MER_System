
<?php
ob_start();
session_start();

//session_start();
if (isset($_REQUEST['logout']) == 'logout') {
    session_destroy();
    ?>
    <script type="text/javascript">
        window.location = 'index.php';
    </script>
    <?php
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log In -USAD Portal</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <meta name="description" content="Mer System is a web protal to track farmers activities">

        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@naksoid">
        <meta name="twitter:creator" content="@naksoid">
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="../img/favicon.ico" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="css/vendor.min.css">
        <link rel="stylesheet" href="css/elephant.min.css">
        <link rel="stylesheet" href="css/login-3.min.css">
        <link rel="stylesheet" href="css/logincustom.css">
        <link rel="stylesheet" href="css/custom.css">
    </head>
    <body>

        <!--        <ul class="slideshow" style=":after {content: '';background: transparent url('img/background.jpg') repeat top left};">
                    <li><span style="background-image: url('img/background.jpg')"></span></li>
                    <li><span style="background-image: url('img/background2.jpg')"></span></li>
                    <li><span style="background-image: url('img/background3.jpg')"></span></li>
                    <li><span style="background-image: url('img/background.jpg')"></span></li>
                    <li><span style="background-image: url('img/background2.jpg')"></span></li>
                    <li><span style="background-image: url('img/background3.jpg')"></span></li>
        
                </ul>-->

        <ul class="slideshow" style=":after {content: '';background: transparent url('img/background.jpg') repeat top left};">
            <li><span style="background-image: url('img/background5.jpg')"></span></li>
            <li><span style="background-image: url('img/background5.jpg')"></span></li>
            <li><span style="background-image: url('img/background5.jpg')"></span></li>
            <li><span style="background-image: url('img/background5.jpg')"></span></li>
            <li><span style="background-image: url('img/background5.jpg')"></span></li>
            <li><span style="background-image: url('img/background5.jpg')"></span></li>

        </ul>
        <h2 class="text-center" style="text-transform: uppercase;">
            Amplifies Ghana Project Monitoring And Reporting platform
        </h2>
        <div class="login">

            <div class="login-body">
                <a class="login-brand" href="#">
                    <img class="img-responsive" src="img/logo2.png"  alt="USAD">
<!--                    <img class="img-responsive" src="img/logo.png" height="30" width="70" alt="USAD">
                    -->
                </a>
                <h3 class="login-heading">Sign in</h3>
                <p class="holder text-center"></p>
                <div class="login-form">
                    <form id="loginForm" data-toggle="md-validator"  method="POST">
                        <input class="md-form-control" type="hidden" name="type" value="login">
                           
                        <div class="md-form-group md-label-floating">
                            <input class="md-form-control" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter username." required>
                            <label class="md-control-label">Username</label>
                        </div>
                        <div class="md-form-group md-label-floating">
                            <input class="md-form-control" type="password" name="password" minlength="6" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                            <label class="md-control-label">Password</label>
                        </div>
                        <div class="md-form-group md-custom-controls">
                            <label class="custom-control custom-control-primary custom-checkbox">
                                <input class="custom-control-input" type="checkbox" checked="checked">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-label">Keep me signed in</span>
                            </label>
                            <span aria-hidden="true"> · </span>
                            <a href="#">Forgot password?</a>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>

        </div>
        <script src="js/vendor.min.js"></script>
        <script src="js/elephant.min.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>
<!-- Localized -->

