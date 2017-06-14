<?php
session_start();
if ($_SESSION['login_valid'] != "YES") {
    ?>
    <script type="text/javascript">
        window.location = 'index.php';
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Reset Password</title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="../img/favicon.ico" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="css/vendor.min.css">
        <link rel="stylesheet" href="css/elephant.min.css">
        <link rel="stylesheet" href="css/application.min.css">
        <link rel="stylesheet" href="css/demo.min.css">
    </head>
    <body class="layout layout-header-fixed">
        <?php
        require_once 'header.php';
        ?>
        <div class="layout-main">
            <?php
            require_once 'sidebar.php';
            ?>
            <div class="layout-content">
                <div class="layout-content-body">
                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong>Change Password</strong>
                            </div>
                            <div class="card-body">
                                <form id="changePasswordForm">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"> New Password</label>
                                            <input  class="form-control" type="password" name="password_val" required>
                                            <small class="help-block"></small>
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label">Confirm Password</label>
                                            <input  class="form-control" type="password" name="confirm_password" required>
                                            <small class="help-block"></small>
                                        </div> 



                                    </div>
                                    <div class="col-xs-12">
                                        <input type="hidden" value="changePassword" name="type"/>
                                        <br><br>
                                    </div>
                                    <div class="col-xs-12 ">
                                        <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                            <button class="btn btn-primary  btn-block pull-right" type="submit">Update Password</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal fade" id="loaderModal" data-keyboard="false" data-backdrop="static" role="dialog" >
                    <div class="modal-dialog" role="document">


                        <div  id="loader" style="margin-top:30% ">
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                            <span class="loader-text">Wait...</span>
                        </div>


                    </div>
                </div>
            </div>
            <?php
            require_once 'footer.php';
            ?>
        </div>

        <script src="js/vendor.min.js"></script>
        <script src="js/elephant.min.js"></script>
        <script src="js/application.min.js"></script>
        <script src="js/demo.min.js"></script>
        <script src="js/select2.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
<!-- Localized -->