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
        <title>Completion Tool Activities </title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="../css/vendor.min.css">

        <link rel="stylesheet" href="../css/elephant.min.css">
        <link rel="stylesheet" href="../css/application.min.css">
        <link rel="stylesheet" href="../css/font-awesome.css">

        <link rel="stylesheet" href="../css/demo.min.css">


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
                    <h3>Activity Reporting Tool</h3>


                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong> Completion Tool Activities</strong
                                <?php
                                $scopes = $_SESSION['permissions'];
                                if (in_array("CREATE_NEW_ACTIVITY", $scopes)) {
                                    ?>    
                                    <div class="row" id="creatediv">
                                        <div class="col-lg-12">
                                            <div class="pull-right">
                                                <a class="btn btn-primary "href="completion-tool" >New Activity</a>

                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel">

                                        <div class="panel-body">

                                            <div class="table-responsive">
                                                <table class="table table-middle" id="activitiesListTbl">
                                                    <thead>
                                                        <tr>
<!--                                                            <th>Code</th>-->
                                                            <th>Activity Date</th>
                                                            <th>Type</th>
                                                            <th>Description</th>
                                                            <th>Region</th>
                                                            <th>District</th>
                                                            <th>Implementer</th>
                                                            <th>Total Participants</th>

                                                            <th>Edit</th>
                                                            <?php
                                                            if (in_array("DELETE_ACTIVITY", $scopes)) {
                                                                ?>

                                                                <th>Delete </th>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>



                                        </div>
                                    </div>
                                </div>
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

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="deleteCompletionActivityForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete ?
                                        </p>
                                    </div>
                                    <input type="hidden" id="code" name="code"/>
                                    <input type="hidden"  name="type" value="deleteCompletionActivity"/>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                    <button type="submit"  class="btn btn-primary">YES</button>
                                </div>
                            </form>
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
        <script src="../js/completion-tool.js"></script>

    </body>
</html>
<!-- Localized -->