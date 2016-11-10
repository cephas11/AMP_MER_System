<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beneficiary Bulk Form</title>

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

                    <div class="card">
                        <div class="card-header">
                            <strong>Bulk Beneficiary Upload</strong>
                            <br>
                            <small style="color:red;">* Upload csv or excel file sheet only.This is the format below</small>
<!--                              <br>  <small style="color:red;">*Beneficiary Name,Business Name</small>
                            -->
                        </div>

                        <div class="card-body">
                            <form enctype="multipart/form-data" method="post" action="import.php">
                                <div class="col-lg 12">
                                    <div class="col-lg-6">
                                        <input id="form-control-9" name="file" type="file" required="required">
                                    </div>
                                    <div class="col-lg-6">
                                        <button class="btn btn-outline-info" name="Import" type="submit">Import</button>
                                    </div>
                                </div>  
                            </form>

                        </div>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong>Bulk Beneficiary</strong>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-middle" id="beneficiaryTbl">
                                                    <thead>
                                                        <tr>

                                                            <th>Fiscal Year</th>
                                                            <th>Date Registered</th>
                                                            <th>Beneficiary Name</th>
                                                            <th>Business Name</th>
                                                            <th>Gender</th>
                                                            <th>Email</th>
                                                            <th>ContactNo</th>
                                                            <th>Region</th>
                                                            <th>District</th>
                                                            <th>Category</th>
                                                            <th>Description</th>
                                                            <th>Community</th>
                                                            <th>Longitude</th>
                                                            <th>Latitude</th>
                                                            <th>Registered By</th>
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
        <script src="../js/beneficiary-upload.js"></script>

    </body>
</html>
<!-- Localized -->