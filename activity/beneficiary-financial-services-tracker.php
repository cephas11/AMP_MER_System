<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beneficiary Financial Services Tracker</title>

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
        <!--        <link rel="stylesheet" href="../css/custom.css">-->
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
                        <h3 class="m-b-0">Financial Services Tracker </h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">


                                <div class="col-xs-12">
                                    <form id="financialTrackerForm" name="financialTrackerForm" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="setFinancialTracker"/>

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
                                                    <input class="form-control" type="text" name="beneficiaryName" id="beneficiaryName" disabled>
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
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Type Of Financial Service </label>
                                                <select name="financialType" id="financialType" class="form-control select2" required>

                                                    <option value="">Choose...</option>
                                                    <option value="Loan">Loan</option>
                                                    <option value="Grant">Grant</option>

                                                </select>

                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div id="loan" style="display: none;">
                                            <div class="row" >
                                                <h4 class="text-center">Loan</h4>
                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Purpose Of Loan </label>
                                                    <select name="loanPurpose" id="loanPurpose" class="form-control select2 loan">

                                                        <option value="">Choose...</option>
                                                        <option value="Purchase poultry feed inputs"> Purchase poultry feed inputs</option>
                                                        <option value="Construct or purchase processor-owned distribution centers/warehouse">Construct or purchase processor-owned distribution centers/warehouse</option>
                                                        <option value="Purchase, repair or upgrade processing, testing and other plant equipment"> Purchase, repair or upgrade processing, testing and other plant equipment</option>
                                                        <option value="Expand feed processing plant facility">Expand feed processing plant facility</option>

                                                    </select>

                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>
                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Amount Disbursed </label>
                                                    <div class="input-with-icon">
                                                        <input class="form-control loan" type="text" name="amountDisbursed" id="amountDisbursed" >
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Date Of Disbursement </label>

                                                    <div class="input-with-icon">
                                                        <input class="form-control loan" type="text" name="disbursementDate" id="disbursementDate" data-provide="datepicker" >
                                                        <span class="icon icon-calendar input-icon"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label ">Amount Repaid </label>
                                                    <div class="input-with-icon">
                                                        <input class="form-control loan" type="text" name="amountRepaid" id="amountRepaid" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label ">Amount Outstanding </label>
                                                    <div class="input-with-icon">
                                                        <input class="form-control loan" type="text" name="amountOustanding" id="amountOustanding" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label ">Final Repayment Date </label>


                                                    <div class="input-with-icon">
                                                        <input class="form-control loan" type="text" name="repaymentDate" id="repaymentDate" data-provide="datepicker" >
                                                        <span class="icon icon-calendar input-icon"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>
                                        </div>


                                        <div id="grant" style="display: none;">
                                            <h4 class="text-center">Grant</h4>     
                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Amount Disbursed </label>
                                                    <div class="input-with-icon">
                                                        <input class="form-control grant" type="text" name="amountDisbursedGrant" id="amountDisbursedGrant" >
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row" >

                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Date Of Disbursement </label>

                                                    <div class="input-with-icon">
                                                        <input class="form-control grant" type="text" name="disbursementDateGrant" id="disbursementDateGrant" data-provide="datepicker" >
                                                        <span class="icon icon-calendar input-icon"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-1"></div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-lg-1"></div>
                                                <div class="form-group col-lg-9">
                                                    <label for="name-1" class="control-label">Grant Purpose  </label>
                                                    <select name="grantPurpose" id="grantPurpose" class="form-control select2" >

                                                        <option value="">Choose...</option>
                                                        <option value="Renovations to existing post-harvest storage structures">Renovations to existing post-harvest storage structures</option>

                                                    </select>

                                                </div>
                                                <div class="form-group col-lg-1"></div>

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
                            <h4>Financial History</h4>
                            <div class="row">
                                <div class=" col-lg-12 ">

                                    <div class="table-responsive">
                                        <table id="financialTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>

                                                    <th>Financial Type</th>
                                                    <th>Amount Disbursed</th>
                                                    <th>Date Of Disbursement</th>
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

                <div class="modal fade" id="financeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Detail</h4>
                            </div>
                            <form  >
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="region" class="control-label">Financial Type:</label>
                                        <input type="text" class="form-control" id="financialTypeDetail"  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="region" class="control-label">Amount Disbursed:</label>
                                        <input type="text" class="form-control" id="amountDisbursedDetail"  readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="control-label">Date Of Disbursement:</label>
                                        <input type="text" class="form-control" id="disbursementDateDetail"  readonly>
                                    </div>
                                    <div id="grantdiv">
                                        <div class="form-group">
                                            <label for="region" class="control-label">Purpose Of Grant:</label>
                                            <input type="text" class="form-control" id="grantPurposeDetail"  readonly>
                                        </div>
                                    </div>
                                    <div id="loandiv">
                                        <div class="form-group">
                                            <label for="region" class="control-label">Purpose Of Loan:</label>
                                            <input type="text" class="form-control" id="loanPurposeDetail"  readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="region" class="control-label">Amount Repaid:</label>
                                            <input type="text" class="form-control" id="amountRepaidDetail"  readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="region" class="control-label">Amount Outstanding  :</label>
                                            <input type="text" class="form-control" id="amountOutstandingDetail"  readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="region" class="control-label">Final Repayment Date:</label>
                                            <input type="text" class="form-control" id="repaymentDateDetail"  readonly>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="deleteFinanceForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete?<span class="holder" id="regionholder"></span> 
                                        </p>
                                    </div>
                                    <input type="hidden" id="code" name="code"/>
                                    <input type="hidden"  name="type" value="deleteFinace"/>


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
            <script src="../js/select2.js"></script>
            <script src="../js/beneficiary-financial-tracker.js"></script>
            <script src="../js/jquery.validate.js"></script>
    </body>
</html>
<!-- Localized -->