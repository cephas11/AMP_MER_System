<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Beneficiary Form</title>

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
                    <div class="row gutter-xs">
                        <div class="card">
                            <div class="card-header">
                                <strong>New Beneficiary</strong>
                            </div>
                            <div class="card-body">
                                <form id="beneficiaryForm">
                                    <div class="col-xs-12">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Beneficiary Name</label>
                                                <input  class="form-control" type="text" name="beneficiaryName" required>
                                                <small class="help-block"></small>
                                            </div>  
                                            <div class="form-group">
                                                <label  class="control-label">Business Name</label>
                                                <input  class="form-control" type="text" name="businessName" required>
                                                <small class="help-block"></small>
                                            </div> 
                                            <div class="form-group">
                                                <label  class="form-label">Gender</label>
                                                <select name="gender"  class="form-control select2">

                                                    <option value="">Choose...</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>

                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label">Email</label>
                                                <input class="form-control" type="email" name="email" required>
                                                <small class="help-block"></small>
                                            </div> 

                                            <div class="form-group">
                                                <label  class="control-label">Tel NO</label>
                                                <input class="form-control" type="text" name="conntactNo" required>
                                                <small class="help-block"></small>
                                            </div> 
                                            <div class="form-group">
                                                <label  class="control-label">Contact Person</label>
                                                <input  class="form-control" type="text" name="contactPerson" >
                                                <small class="help-block"></small>
                                            </div> 
                                            <div class="form-group">
                                                <label  class="control-label">Contact Person No.</label>
                                                <input  class="form-control" type="text" name="contactPersonNo" >
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label">Fiscal Year</label>
                                                <select  name="fiscalYear" class="form-control select2">

                                                    <option value="">Choose...</option>
                                                    <option value="FY1 5">FY1 5</option>
                                                    <option value="FY1 6">FY1 6</option>
                                                    <option value="FY1 7">FY1 7</option>
                                                    <option value="FY1 8">FY1 8</option>
                                                    <option value="FY1 9">FY1 9</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="name-1" class="control-label">Date Registered</label>
                                                <div class="input-group date">
                                                    <input id="demo-datepicker-2" class="form-control" type="text" readonly required>
                                                    <span class="input-group-btn">
                                                        <button id="demo-datepicker-2-btn" class="btn btn-primary" type="button">
                                                            <span class="icon icon-calendar"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6">



                                            <div class="form-group">
                                                <label  class="form-label">Category</label>
                                                <select name="category" id="category" class="form-control select2">

                                                    <option value="">Choose...</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label">Description</label>
                                                <select id="description" name="description" class="form-control select2">



                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label">Region</label>
                                                <select id="region" name="region" class="form-control select2" >
                                                    <option value="">Choose...</option>

                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label">District</label>
                                                <select id="district" name="district" class="form-control select2" required>


                                                </select>
                                                <span class="help-block"></span>
                                            </div> 
                                            <div class="form-group">
                                                <label  class="control-label">Community</label>
                                                <input  class="form-control" type="text" name="community" required>
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">

                                                <label  class="control-label">GPS Coordinates (Longitude)</label>
                                                <input class="form-control" type="text" name="longitude" required>
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label">GPS Coordinates (Latitude)</label>
                                                <input  class="form-control" type="text" name="latitude" required>
                                                <small class="help-block"></small>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Registered By</label>
                                                <input  class="form-control" type="text" name="registeredBy" required>
                                                <small class="help-block"></small>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                            <button class="btn btn-primary pull-right" type="submit">Save</button>
                                        </div>
                                    </div>
                                </form>
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
        <script src="../js/beneficiary-view.js"></script>

    </body>
</html>
<!-- Localized -->