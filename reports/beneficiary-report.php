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
        <title>Beneficiary Report</title>

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
        <link rel="stylesheet" href="../css/font-awesome.css">

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
                        <div class="card">
                            <div class="card-header">
                                <strong> Beneficiary Report</strong>
                            </div>
                            <div class="card-body">
                                <form id="generateReport">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">Fiscal Year</label>
                                                <select  name="fiscalYear" id="fiscalYear" multiple class="form-control select2">

                                                    <option value="">Choose...</option>

                                                    <option value="FY16">FY16</option>
                                                    <option value="FY17">FY17</option>
                                                    <option value="FY18">FY18</option>
                                                    <option value="FY19">FY19</option>
                                                    <option value="FY20">FY20</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">Beneficiary Category</label>
                                                <select  name="category" id="category" multiple class="form-control select2">

                                                    <option value="">Choose...</option>


                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">Beneficiary Description</label>
                                                <select  name="description" id="description" multiple class="form-control select2">

                                                    <option value="">Choose...</option>



                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">Gender</label>
                                                <select  name="gender" id="gender" multiple class="form-control select2">

                                                    <option value="">Choose...</option>

                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>


                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">Region</label>
                                                <select  name="region" id="region" multiple class="form-control select2">

                                                    <option value="">Choose...</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div> 
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label  class="form-label">District</label>
                                                <select  name="district" id="district" multiple class="form-control select2">

                                                    <option value="">Choose...</option>


                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-xs-12 ">
                                        <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                            <button class="btn btn-primary  btn-block pull-right" type="submit">Generate</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">

                                    <div class="panel-body">

                                        <div class="table-responsive" >
                                            <table id="beneficiaresListTbl" class="table table-bordered table-striped table-nowrap " cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>Fiscal Year</th>
                                                        <th>Date Registered</th>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Beneficiary Name</th>
                                                        <th>Business Name</th>
                                                        <th>Gender</th>
                                                        <th>Region</th>
                                                        <th>District</th>
                                                        <th>Community</th>
                                                        <th>Registered By</th>      
                                                        <th>Date Created</th>         

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


    </body>
</html>
<!-- Localized -->