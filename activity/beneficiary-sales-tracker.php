<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beneficiary Sales Tracker</title>

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
                        <h3 class="m-b-0">Sales Tracker </h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">


                                <div class="col-xs-12">
                                    <form id="salesTrackerForm" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="setSalesTracker"/>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Date </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="activityDate" id="activityDate" data-provide="datepicker" required>
                                                    <span class="icon icon-calendar input-icon"></span>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Beneficiary Id</label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="beneficiaryCode" id="beneficiaryCode" readonly >

                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Beneficiary Name</label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="beneficiaryName" id="beneficiaryName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Type Of Beneficiary </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="beneficiaryType" id="beneficiaryType" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                <label for="name-1" class="control-label">Commodity </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="commodity" id="commodity" readonly>
                                                </div> 
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                <label for="name-1" class="control-label">Value Of Sales (USD) </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="salesUSD" id="salesUSD" required >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">

                                                <label for="name-1" class="control-label">Value Of Sales (Metric Tonnes ) </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="salesTonnes" id="salesTonnes" required>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-xs-12 ">
                                            <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                                <button class="btn btn-primary btn-block pull-right" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4>Sales History</h4>
                            <div class="row">
                                <div class=" col-lg-12 ">

                                    <div class="table-responsive">
                                        <table id="salesTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>

                                                    <th>Date</th>
                                                    <th>Value Of Sales(USD)</th>
                                                    <th>Value Of Sales(Metric Tonnes)</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                </div>


               <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="deleteSaleForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete ?.<span class="holder" id="regionholder"></span> 
                                        </p>
                                    </div>
                                    <input type="hidden" id="code" name="code"/>
                                    <input type="hidden"  name="type" value="deleteSale"/>


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
                <?php
                require_once '../footer.php';
                ?>
            </div>

            <script src="../js/vendor.min.js"></script>
            <script src="../js/elephant.min.js"></script>
            <script src="../js/application.min.js"></script>
            <script src="../js/demo.min.js"></script>
            <script src="../js/beneficiary-sales-tracker.js"></script>

    </body>
</html>
<!-- Localized -->