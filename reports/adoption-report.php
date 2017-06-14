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
        <title>Adoption Report</title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="../img/favicon.ico" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="../css/vendor.min.css">
        <link rel="stylesheet" href="../css/elephant.min.css">
        <link rel="stylesheet" href="../css/application.min.css">
        <link rel="stylesheet" href="../css/demo.min.css">
        <!--                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css">       
                        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
                        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.bootstrap4.min.css
                              ">-->
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
                        <div class="">
                            <strong> Adoption Report</strong>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">

                                    <div class="panel-body">

                                        <div class="table-responsive" >
                                            <table id="adoptionTbl" class="table table-bordered table-striped table-nowrap " cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th colspan="5">Total number people applying

                                                            techniques/technologies</th>
                                                        <th colspan="2">Total number of hectares under improved

                                                            techniques</th>



                                                    </tr>
                                                    <tr>
                                                        <th>Male</th>
                                                        <th>Female</th>
                                                        <th>Harvesting</th>
                                                        <th>Post-Harvest Handling</th>
                                                        <th>Storage</th>
                                                        <th>Harvesting</th>
                                                        <th>Post-Harvest Handling</th>
                                                        <th>Storage</th>

                                                    </tr>
                                                </thead>
                                                <tbody >

                                                </tbody>
                                            </table>
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
                            <img src="../img/load.gif"/>
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                            <span class="loader-text">Generating Report...</span>
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
        <script src="../js/report.js"></script>
        <!--https://cdn.datatables.net/buttons/1.3.1/js/buttons.bootstrap4.min.js
        //cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js

//cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js-->



    </body>
</html>
<!-- Localized -->