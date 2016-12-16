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
                    <h3>Beneficiaries</h3>

                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong> Beneficiaries List</strong>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pull-right">
                                            <a class="btn btn-primary "href="beneficiary-form" >New Beneficiary</a>
                                            <a  class="btn btn-primary" href="bulk-beneficiary-upload" >Bulk Upload</a>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel">

                                        <div class="panel-body">

                                            <div class="table-responsive">
                                                <table class="table table-middle" id="beneficiaresListTbl">
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
                            <form method="post" id="deleteBeneficiaryForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete this beneficiary?.<span class="holder" id="beneficiaryholder"></span> 
                                        </p>
                                    </div>
                                    <input type="hidden" id="code" name="code"/>
                                    <input type="hidden"  name="type" value="deleteBeneficiary"/>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                    <button type="submit" id="deleteBeneficiary" class="btn btn-primary">YES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel"><span class="holder"></span> Information </h4>
                            </div>
                            <form id="updatebeneficiaryForm">

                                <div class="modal-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <br>
                                            <div class="form-group">
                                                <label  class="form-label">Fiscal Year</label>

                                                <input  class="form-control" type="text" name="fiscalYear" id="fiscalYear" disabled>
                                                <small class="help-block"></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="name-1" class="control-label">Date of  Registration</label>
                                                <div class="input-with-icon">
                                                    <input class="form-control" type="text" name="dateRegistered" id="dateRegistered" data-provide="datepicker">
                                                    <span class="icon icon-calendar input-icon"></span>
                                                </div>


                                            </div>


                                            <div class="form-group">
                                                <label  class="form-label">Category </label>

                                                <input  class="form-control" type="text" name="category" id="category" disabled>
                                                <small class="help-block"></small>
                                            </div>



                                            <div class="form-group">
                                                <label  class="form-label">Description </label>

                                                <input  class="form-control" type="text" name="description" id="description" disabled>
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label"> Name</label>
                                                <input  class="form-control" type="text" name="beneficiaryName" id="beneficiaryName" required>
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label">Business Name</label>
                                                <input  class="form-control" type="text" name="businessName" id="businessName" required>
                                                <small class="help-block"></small>
                                            </div> 

                                            <div class="form-group">
                                                <label  class="control-label">Gender </label>
                                                <input  class="form-control" type="text" name="gender" id="gender" disabled>
                                                <small class="help-block"></small>
                                            </div> 


                                            <div class="form-group">
                                                <label  class="form-label">Educational Level</label>
                                                <select name="educational_level" id="educational_level" class="form-control ">

                                                    <option value="Primary">Primary</option>
                                                    <option value="Secondary">Secondary</option>
                                                    <option value="Tertiary">Tertiary</option>
                                                    <option value="None">None</option>
                                                </select>

                                                <span class="help-block"></span>
                                            </div>

                                            <div class="form-group">
                                                <label  class="control-label">Address</label>
                                                <input  class="form-control" type="text" name="address" id="address" required>
                                                <small class="help-block"></small>
                                            </div>



                                            <div class="form-group">
                                                <label  class="control-label">Region </label>
                                                <input  class="form-control" type="text" name="region" id="region" disabled>
                                                <small class="help-block"></small>
                                            </div> 


                                            <div class="form-group">
                                                <label  class="control-label">District </label>
                                                <input  class="form-control" type="text" name="district" id="district" disabled>
                                                <small class="help-block"></small>
                                            </div> 


                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label  class="control-label">Community</label>
                                                    <input  class="form-control" type="text" name="community" id="community" required>
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label  class="control-label">Tel NO</label>
                                                        <input class="form-control" type="text" name="contactno" id="contactno" required>
                                                        <small class="help-block"></small>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label  class="control-label">Alternate Phone NO</label>
                                                        <input class="form-control" type="text" name="altcontactno" id="altcontactno">
                                                        <small class="help-block"></small>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label  class="control-label">Email</label>
                                                        <input class="form-control" type="email" name="email" id="email" >
                                                        <small class="help-block"></small>
                                                    </div> 
                                                </div>

                                            </div>
                                            <div class="col-lg-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <label  class="form-label">Registered Business</label>
                                                    <select name="registered_business" id="registered_business" class="form-control " >

                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>

                                                    </select>

                                                    <span class="help-block"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label  class="form-label">Ownership Type</label>
                                                    <input class="form-control" type="text" name="ownership_type" id="ownership_type" >

                                                </div>
                                                <div class="form-group">
                                                    <label  class="control-label">Years Of Establishment</label>
                                                    <input  class="form-control" type="text" name="establishment_years" id="establishment_years" required>
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>
                                            <div>

                                                <div class="col-lg-2 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label  class="form-label ">GPS Coordinates :</label>

                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-12 col-sm-12">
                                                    <div class="form-group">

                                                        <label  class="control-label">Longitude</label>
                                                        <input class="form-control" type="text" name="longitude" id="longitude" value="0">
                                                        <small class="help-block"></small>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label  class="control-label">Latitude</label>
                                                        <input  class="form-control" type="text" name="latitude" id="latitude" value="0">
                                                        <small class="help-block"></small>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label  class="control-label">Registered By </label>
                                                <input  class="form-control" type="text" name="registeredBy" id="registeredBy" disabled>
                                                <small class="help-block"></small>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <input type="hidden" value="updateBeneficiary" name="type"/>
                                        <input type="hidden"  id="beneficiaryCode" name="beneficiaryCode"/>

                                        <br><br>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Update</button>

                                </div>
                            </form>

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