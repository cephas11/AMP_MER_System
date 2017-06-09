
<?php
session_start();
if ($_SESSION['login_valid'] != "YES") {
    ?>
    <script type="text/javascript">
        window.location = '../index.php';
    </script>
    <?php
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Roles And Permissions  </title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">



        <link rel="stylesheet" href="../css/vendor.min.css">
        <link rel="stylesheet" href="../css/elephant.min.css">
        <link rel="stylesheet" href="../css/application.min.css">
        <link rel="stylesheet" href="../css/demo.min.css">
        <!--        <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.0.4/css/dataTables.checkboxes.css" rel="stylesheet" />
        -->
        <link rel="stylesheet" href="../css/custom.css">
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
                    <div class="text m-b">
                        <h3 class="m-b-0">Roles And Permissions</h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">
                                <!--                                <div class="text-center"><h4>Activity Completion Reporting Tool </h4></div>
                                -->
                                <form id="assignPermissionsForm" method="POST" enctype="multipart/form-data">
                                    <input  type="hidden" name="type" value="saveGroupPermissions"/>

                                    <div class="col-xs-12">
                                        <div class="col-lg-12 col-md-12 col-sm-12">



                                            <div class="form-group">
                                                <label  class="form-label">User Group</label>
                                                <select name="userGroup" id="userGroup" class="form-control select2" required>

                                                    <option value="">Choose</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>


                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="pull-right">
                                                <a class="btn btn-primary "href="#" id="assign_all" >Assign All</a>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="" id="permisiontable" >

                                        <table id="formsTbl" class="participants table table-middle nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Permission</th>
                                                    <th></th>


                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>

                                        <?php
                                        $scopes = $_SESSION['permissions'];
                                        if (in_array("ASSIGN_USER_PERMISSIONS", $scopes)) {
                                            ?>
                                            <div class="col-xs-12 ">
                                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                                    <button class="btn btn-primary  btn-block pull-right"  type="submit">Save</button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
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
            require_once '../footer.php';
            ?>
        </div>

        <script src="../js/vendor.min.js"></script>
        <script src="../js/elephant.min.js"></script>
        <script src="../js/application.min.js"></script>
        <script src="../js/demo.min.js"></script>
        <script src="../js/select2.js"></script>
<!--        <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.0.4/js/dataTables.checkboxes.min.js"></script>
        -->
        <script src="../js/account.js"></script>

    </body>
</html>
<!-- Localized -->
Contact GitHub API Training Shop Blog About
© 2017 GitHub, Inc. Terms Privacy Security Status Help