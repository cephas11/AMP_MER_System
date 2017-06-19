
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "reset") {
        require_once './classes/AccountClass.php';

        $new = new AccountClass();
        $id = urldecode($_GET['encrypt']);
        $response = $new->getUserId($id);

        if ($response == 0) {
            echo 'Invalid key please try again.';
        } else {
            ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>Reset Password</title>
                    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
                    <meta name="description" content="Mer System is a web protal to track farmers activities">

                    <meta property="og:type" content="website">
                    <meta name="twitter:card" content="summary_large_image">
                    <meta name="twitter:site" content="@naksoid">
                    <meta name="twitter:creator" content="@naksoid">
                    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
                    <link rel="icon" type="image/png" href="img/favicon.ico" sizes="32x32">
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
                    <link rel="stylesheet" href="css/sweet-alert.min-v2.2.0.css">

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

                    <div class="login">

                        <div class="login-body">
                            <h6 class="login-heading">Reset password?</h6>

                            <p class="holder text-center"></p>
                            <div class="login-form">
                                <form id="resetPassworrdForm" data-toggle="md-validator"  method="POST">
                                    <input class="md-form-control" type="hidden" name="type" value="resetpassword">
                                    <input class="md-form-control" type="hidden" name="userid" value="<?php echo urldecode($_GET['encrypt'])?>">

                                    <div class="md-form-group md-label-floating">
                                        <input class="md-form-control" type="password" name="password" id="password" spellcheck="false" autocomplete="off"  required>
                                        <label class="md-control-label">New Password</label>
                                    </div>
                                    <div class="md-form-group md-label-floating">
                                        <input class="md-form-control" type="password" name="confirm_password" id="confirm_password" spellcheck="false" autocomplete="off" required>
                                        <label class="md-control-label">Confirm Password</label>
                                    </div>

                                    <button class="btn btn-primary btn-block" type="submit">Reset</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <script src="js/vendor.min.js"></script>
                    <script src="js/elephant.min.js"></script>
                    <script src="js/login.js"></script>
                    <script src="js/sweet-alert.min.js"></script>

                </body>
            </html>
            <!-- Localized -->


            <?php
        }
    }
} else {
    echo 'Please you are at wrong page';
}
?>
