<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>  Beneficiary Form</title>

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
        <link rel="stylesheet" href="css/vendor.min.css">
        <link rel="stylesheet" href="css/elephant.min.css">
        <link rel="stylesheet" href="css/application.min.css">
        <link rel="stylesheet" href="css/demo.min.css">
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
                                <form>
                                <div class="col-xs-12">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="name-1" class="control-label">Benficiary Name</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div>  
                                        <div class="form-group">
                                            <label for="name-1" class="control-label">Business Name</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div> 
                                        <div class="form-group">
                                            <label for="demo-select2-1" class="form-label">Gender</label>
                                            <select id="demo-select2-2"  class="form-control">

                                                <option value="">Choose...</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>

                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="name-1" class="control-label">Contac NO</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div> 

                                    </div>

                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label for="name-1" class="control-label">Email</label>
                                            <input id="name-1" class="form-control" type="email" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div> 
                                        <div class="form-group">
                                            <label for="demo-select2-1" class="form-label">Region</label>
                                            <select id="demo-select2-1" class="form-control">

                                                <option value="">Choose...</option>
                                                <option value="">Greater Accra</option>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="name-1" class="control-label">District</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div> 
                                    </div>
                                    <div class="col-lg-4">

                                        <div class="form-group">
                                            <label for="name-1" class="control-label">Community</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div>
                                        <div class="form-group">

                                            <label for="name-1" class="control-label">GPS Coordinates (Longitude)</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
                                            <small class="help-block"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="name-1" class="control-label">GPS Coordinates (Latitude)</label>
                                            <input id="name-1" class="form-control" type="text" name="name_1" required>
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
            require_once './footer.php';
            ?>
        </div>
        <script src="js/vendor.min.js"></script>
        <script src="js/elephant.min.js"></script>
        <script src="js/application.min.js"></script>
        <script src="js/demo.min.js"></script>

    </body>
</html>
<!-- Localized -->