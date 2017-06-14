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
        <title>Beneficiary Adoption Tracker</title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="../img/favicon.ico" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <!--        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">-->



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
                        <h3 class="m-b-0"> Techniques/Technologies Adoption Tracker </h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">


                                <div class="col-xs-12">
                                    <form id="adoptionTrackerForm" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="setAdoptionTracker"/>


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
                                                <label for="name-1" class="control-label">Gender </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="gender" id="gender" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Business Name </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="businessName" id="businessName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Beneficiary Category  </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="beneficiaryCategory" id="beneficiaryCategory" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                <label for="name-1" class="control-label">Region </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="region" id="region" readonly>
                                                </div> 
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                                <label for="name-1" class="control-label">District </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="district" id="district" readonly >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-4 col-sm-12">

                                                <label for="name-1" class="control-label">Community </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="community" id="community" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label  class="form-label">Fiscal Year</label>
                                                <div class="input-with-icon">
                                                    <select  name="fiscalYear" id="fiscalYear" class="form-control select2" required>

                                                        <option value="">Choose...</option>

                                                        <option value="FY16">FY16</option>
                                                        <option value="FY17">FY17</option>
                                                        <option value="FY18">FY18</option>
                                                        <option value="FY19">FY19</option>
                                                        <option value="FY20">FY20</option>

                                                    </select>            
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>


                                        <div class="form-group row">
                                            <label  class="form-label">Has beneficiary applied/adopted any techniques/technologies as a result of USDA assistance during

                                                fiscal year?</label>
                                            <select name="applied" id="applied" class="form-control select2" required>

                                                <option value="">Choose...</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>

                                            <span class="help-block"></span>
                                        </div>



                                        <div class="form-group row" id="techniquesdiv" style="display: none">




                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="harvesting_technology">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-label">Harvesting techniques/technologies</span>
                                            </label>

                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="handling_technology">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-label">Post-harvest handling techniques/technologies</span>
                                            </label>

                                            <label class="custom-control custom-control-primary custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" name="storage_technology">
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-label">Storage techniques/technologies</span>
                                            </label>
                                            <br><br>

                                            <label  class="form-label">

                                                What Other techniques/technologies has beneficiary applied/adopted so far (please tick)?
                                            </label>
                                            <select name="techniqus[]" id="techniques" multiple class="form-control select2" required>

                                                <option value="">Choose...</option>
<!--                                                <option value="Harvesting techniques/technologies">Harvesting techniques/technologies</option>
                                                <option value="Post-harvest handling techniques/technologies">Post-harvest handling techniques/technologies</option>
                                                <option value="Storage techniques/technologies">Storage techniques/technologies</option>
                                             -->
                                                <option value="Improved farm management practice">Improved farm management practice</option>
                                                <option value="Improved poultry feed">Improved poultry feed</option>
                                                <option value="Feed testing techniques">Feed testing techniques</option>

                                            </select>

                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group row" id='reasondiv' style="display: none">
                                            <label for="name-1" class="control-label">Reason </label>
                                            <div class="input-with-icon">
                                                <textarea class="form-control" name="reason" rows="6" cols="6"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h4 class="text-center">To what size of land (Hectares) did beneficiary apply the following techniques/technologies?</h4>
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Harvesting </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="harvesting"  id="harvesting"/>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Post-harvest handling  </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="handling" id="handling" />
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label for="name-1" class="control-label">Storage  </label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="storage" id="storage" />
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>
                                        <?php
                                        $scopes = $_SESSION['permissions'];
                                        if (in_array("ADD_ADOPTION_TRACKER", $scopes)) {
                                            ?> 
                                            <div class="col-xs-12 " id="saveBtn">
                                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                                    <button class="btn btn-primary btn-block pull-right" type="submit">Save</button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>


                                    </form>
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4>Tracker History</h4>
                            <div class="row">
                                <div class=" col-lg-12 ">

                                    <div class="table-responsive">
                                        <table id="adoptionTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Fiscal Year</th>
                                                    <th>Adoption Applied</th>
                                                    <th>Techniques Applied/Reason</th>
                                                    <th>Harvesting</th>
                                                    <th>Post-Harvest</th>
                                                    <th>Storage</th>
                                                     <th>Harvesting Technology</th>
                                                    <th>Post-Harvest Technology</th>
                                                    <th>Storage Technology</th>
                                                    <th>Date Added</th>
                                                    <?php
                                                    if (in_array("DELETE_ADOPTION_TRACKER_RECORD", $scopes)) {
                                                        ?> 
                                                        <th>Action</th>
                                                        <?php
                                                    }
                                                    ?>
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
                            <img src="../img/load.gif"/>
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
            <script src="../js/adoption-tracker-detail.js"></script>

    </body>
</html>
<!-- Localized -->