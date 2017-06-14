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
        <title>Beneficiary Bulk Form</title>

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
        <link rel="stylesheet" href="../css/custom.css">
        <link rel="stylesheet" href="../css/sweet-alert.min-v2.2.0.css">


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
                            <a href="../download-multiple.php?file=bulksample.xlsx" class="btn btn-sm btn-warning" >Download Sample</a>

                            <br>
<!--                            <small style="color: #39f;"> 
                                name,business_name,gender,email,contactno,community,educational_level,address,
                                <br>altcontactno,registered_business,ownership_type,establishment_years,longitude,latitude,fiscalyear,dateregistered,registeredby
                            </small>-->

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
                                                            <th>Category</th>
                                                            <th>Description</th>
                                                            <th>Beneficiary Name</th>
                                                            <th>Business Name</th>
                                                            <th>Gender</th>
                                                            <th>Educational Level</th>
                                                            <th>Address</th>
                                                            <th>Region</th>
                                                            <th>District</th>
                                                            <th>Community</th>
                                                            <th>ContactNo</th>
                                                            <th>Alt ContactNo</th>
                                                            <th>Email</th>
                                                            <th>Registered Business</th>
                                                            <th>OwnerShip Type</th>
                                                            <th>Years Of Establishment</th>
                                                            <th>Longitude</th>
                                                            <th>Latitude</th>
                                                            <th>Registered By</th>
                                                            <th> Id </th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>


                                            <div class="row" id="saveButton">
                                                <div class="col-xs-12">
                                                    <div class="col-md-2 ">
                                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#clearModal" data-whatever="@mdo">Clear</button>
                                                    </div>
                                                    <div class="col-md-8 ">

                                                    </div>
                                                    <div class="col-md-2 ">
                                                        <!--                                                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#confirmModal" data-whatever="@mdo">Save</button>
                                                        -->
                                                    </div>
                                                </div>
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
                <div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div>
                                    <p>
                                        By clicking on the confirm button ,you will be clearing all data  in this table. 
                                    </p>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Canel</button>
                                <button type="button" id="clearBeneficiary" class="btn btn-primary">Confirm</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h6 class="modal-title" >Confirm Beneficiary Information </h6>
                            </div>

                            <form id="saveBeneficiaryForm">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Fiscal Year:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 fiscalyear"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Date Registered:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 dateRegistered"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Category:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 category"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Description :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 description"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Beneficiary Name:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 beneficiary"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Business Name:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 business"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Gender:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 gender"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Educational Level:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 level"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Address :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 address"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Region :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 region"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo"> District:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 district"></div>
                                        </div> 
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Community :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 community"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Contact No:</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 contactno"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Alt ContactNo :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 altcontactno"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Email :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 email"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Registered Business :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 regBusiness"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Ownership Type :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 ownership"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Years Of Establishment :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 estabishment"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Longitude :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 longitude"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Latitude :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 latitude"></div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="col-lg-4 col-md-4 col-sm-6 displayInfo">Registered By :</div>
                                            <div class="col-lg-8 col-md-8 col-sm-6 registeredBy"></div>
                                        </div>



                                    </div>

                                    <input type="hidden" name="fiscalYear" id="fiscalYear">
                                    <input type="hidden" name="dateRegistered" id="dateRegistered">
                                    <input type="hidden" name="category" id="category" value="">
                                    <input type="hidden" name="description" id="description" >
                                    <input type="hidden" name="beneficiaryName" id="beneficiaryName">
                                    <input type="hidden" name="businessName" id="businessName">
                                    <input type="hidden" name="gender" id="gender">
                                    <input type="hidden" name="educational_level" id="educational_level">
                                    <input type="hidden" name="address" id="address">
                                    <input type="hidden" name="region" id="region">
                                    <input type="hidden" name="district" id="district">
                                    <input type="hidden" name="community" id="community">
                                    <input type="hidden" name="contactno" id="contactno">
                                    <input type="hidden" name="altcontactno" id="altcontactno">
                                    <input type="hidden" name="email" id="email">
                                    <input type="hidden" name="registered_business" id="registered_business">
                                    <input type="hidden" name="ownership_type" id="ownership_type">
                                    <input type="hidden" name="establishment_years" id="establishment_years">
                                    <input type="hidden" name="longitude" id="longitude">
                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="registeredBy" id="registeredBy">
                                    <input type="hidden" name="beneficiaryId" id="beneficiaryId">
                                 

                                    <input type="hidden" name="bulkInsert" >
                                    <input type="hidden" value="saveBeneficiary" name="type"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
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
        <script src="../js/sweet-alert.min.js"></script>

        <script src="../js/beneficiary-upload.js"></script>

    </body>
</html>
<!-- Localized -->