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
        <title>Beneficiary Employment History</title>
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
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
                        <h3 class="m-b-0">Employment History Form </h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">


                                <div class="col-xs-12">
                                    <form id="employeesForm" method="POST" enctype="multipart/form-data">

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


                                        <div class="row">

                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">

                                                    <label  class="control-label">Total household size:</label>
                                                    <input class="form-control" type="text" name="totalsize" >
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">

                                                    <label  class="control-label">Total number of males:</label>
                                                    <input class="form-control" type="text" name="males" >
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label  class="control-label">Total number of females:</label>
                                                    <input  class="form-control" type="text" name="females" >
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                            <div class="form-group col-lg-1"></div>
                                            <div class="form-group col-lg-9">
                                                <label  class="form-label">
                                                    Have you employed any farm hands or additional labour as a result of USDA assistance during this fiscal

                                                    year?
                                                </label>
                                                <div class="input-with-icon">
                                                    <select name="employed" id="employed" class="form-control select2" required>

                                                        <option value="">Choose...</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group col-lg-1"></div>

                                        </div>

                                        <div class="row" style="display: none" id="createBtn">
                                            <div class="col-lg-12">
                                                <div class="pull-right">
                                                    <button class="btn btn-primary"   onclick="addRow('employmentTbl')" >Add New Employee</button>
                                                    <button  class="btn btn-danger"   onclick="deleteRow('employmentTbl')" >Delete Employee</button>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class=" col-lg-12 ">

                                                <div class="table-responsive">
                                                    <table id="employmentTbl" class="table table-middle nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th>Name Of Employee</th>
                                                                <th>Gender</th>
                                                                <th>Date Of Employment </th>
                                                                <th>Type Of Employment</th>
                                                                <th>Duration</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="checkbox" name="chk[]"/></td>
                                                                <td><input type="text"  name="employeeNames[]" class="empname" required/></td>
                                                                <td>
                                                                    <select name="gender[]" class="form-control gender" required>

                                                                        <option value="">Choose...</option>
                                                                        <option value="female">Female</option>
                                                                        <option value="male">Male</option>
                                                                    </select>
                                                                </td>
                                                                <td><input  type="text" name="employmentDate[]" class="empdate" data-provide="datepicker" required></td>

                                                                <td>
                                                                    <select name="employmentType[]" id="employmentType" class="form-control emptype" required >
                                                                        <option value="">Choose...</option>

                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <select name="duration[]" id="duration" class="form-control duration" required >
                                                                        <option value="">Choose...</option>

                                                                    </select>
                                                                </td>


                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                        <?php
                                        $scopes = $_SESSION['permissions'];
                                        if (in_array("ADD_EMPLOYMENT_DETAILS", $scopes)) {
                                            ?> 

                                            <div style="margin-top: 15px"></div>
                                            <div class=" row col-xs-12 ">
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
                            <h4>Employment History</h4>
                            <div class="row">
                                <div class=" col-lg-12 ">

                                    <div class="table-responsive">
                                        <table id="employemntTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Employee Name </th>
                                                    <th>Gender</th>
                                                    <th>Role</th>
                                                    <th>Duration</th>
                                                    <th>Date Employed</th>
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
            <script src="../js/employment-tracker-detail.js"></script>

    </body>
</html>
<!-- Localized -->