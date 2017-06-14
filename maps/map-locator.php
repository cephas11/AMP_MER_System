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
<!DOCTYPE html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Maps</title>

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" href="../img/favicon.ico" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
    <!--    <link rel="manifest" href="manifest.json">-->
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
    <meta name="theme-color" content="#ffffff">
    <!--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    -->
    <link rel="stylesheet" href="../css/vendor.min.css">
    <link rel="stylesheet" href="../css/elephant.min.css">
    <link rel="stylesheet" href="../css/application.min.css">
    <link rel="stylesheet" href="../css/demo.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <style type="text/css">


    </style>
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
                    <h3 class="m-b-0">Maps</h3>
                    <small>Click on filter to display all beneficiaries locations on map.</small>
                </div>


                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel">
                            <div class="panel-body">
                                <form method="POST" id="filterResultsForm">
                                    <div class="col-lg-12 col-md-12 col-sm-12">

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <div class="form-group">
                                                    <label  class="form-label">Region</label>
                                                    <select id="region" name="region" class="form-control select2" >
                                                        <option selected  value="">Choose..</option>

                                                        <option  value="">All</option>

                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <!--                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                            
                                                                                            <div class="form-group">
                                                                                                <label  class="form-label">District</label>
                                                                                                <select id="district" name="district" class="form-control select2" >
                                            
                                                                                                    <option selected value="">Choose...</option>
                                            
                                                                                                </select>
                                                                                                <span class="help-block"></span>
                                                                                            </div>
                                                                                        </div>-->
                                            <div class="col-lg-6 col-md-6 col-sm-12">

                                                <div class="form-group">
                                                    <label  class="form-label">Description</label>
                                                    <select id="category" name="category" class="form-control select2" >
                                                        <option selected value="">Choose..</option>

                                                        <option  value="">All</option>

                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
                                            <input type="hidden" name="type" value="getFilteredBeneficiariesLocations"/>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">

                                        </div>

                                    </div>
                                    <div class="col-xs-12 ">
                                        <div class="col-sm-offset-3 col-sm-6 col-md-offset-6 col-md-6">

                                            <input class="btn btn-primary  btn-block pull-right" type="submit" value="Filter"/>
                                        </div>
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <div class="col-xs-12">
                        <div id="map" style=" height: 500px;"></div>
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

        </div>
        <?php
        require_once '../footer.php';
        ?>
    </div>
    <script src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyBJ9GGHgRkGMRBP72c_XTQ1yM9f02TF43A" 
    type="text/javascript"></script>
    <script src="../js/vendor.min.js"></script>
    <script src="../js/elephant.min.js"></script>
    <script src="../js/application.min.js"></script>
    <script src="../js/select2.js"></script>
    <script type="text/javascript" src="../js/map.js"></script>




</body>
</html>
