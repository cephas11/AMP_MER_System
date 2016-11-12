<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beneficiary List</title>

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


                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong> Beneficiaries List</strong>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel">
                                        <div class="panel-body">

                                            <div class="table-responsive">
                                                <table class="table table-middle" id="beneficiaresListTbl">
                                                    <thead>
                                                        <tr>
                                                            <th>Code</th>

                                                            <th>Beneficiary Name</th>
                                                            <th>Business Name</th>
                                                            <th>Gender</th>
                                                            <th>Email</th>
                                                            <th>ContactNo</th>
                                                            <th>Fiscal Year</th>
                                                            <th>Category</th>
                                                            <th>Description</th>
                                                            <th>Region</th>
                                                            <th>District</th>
                                                            <th>Community</th>
                                                            <th>Longitude</th>
                                                            <th>Latitude</th>
                                                            <th>Date Registered</th>
                                                            <th>Registered By</th>         
                                                            <th>Created By</th>
                                                            <th>Date Created</th>
                                                            <th>Date Modified</th>
                                                            <th>Modified By</th>
                                                            <th>Action</th>

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

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div>
                                    <p>
                                        By clicking on the confirm button ,you will be saving all  data in the table as beneficiaries. 
                                    </p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Canel</button>
                                <button type="button" id="saveBeneficiary" class="btn btn-primary">Confirm</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="loaderModal" data-keyboard="false" data-backdrop="static" role="dialog" >
                    <div class="modal-dialog" role="document">


                        <div  id="loader" style="margin-top:30% ">
                            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                            <span class="loader-text">Loading...</span>
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
        <script src="../js/beneficiaries-list.js"></script>

    </body>
</html>
<!-- Localized -->