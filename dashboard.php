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
        <title>Dashboard</title>
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#27ae60">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="css/vendor.min.css">
        <link rel="stylesheet" href="css/elephant.min.css">
        <link rel="stylesheet" href="css/application.min.css">
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
                    <div class="title-bar">

                        <h1 class="title-bar-title">
                            <span class="d-ib">Dashboard</span>

                    </div>
                    <?php
            print_r($_SESSION['permissions']);                    
                    ?>
                  
                    <div class="row gutter-xs">
                        <div class="col-md-6 col-lg-3 col-lg-push-0">
                            <div class="card bg-primary-inverse">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-middle media-left">
                                            <span class="bg-primary circle sq-48">
                                                <span class="icon icon-user"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Beneficiaries</h6>
                                            <h3 class="media-heading">
                                                <span class="fw-l" id="beneficiary"></span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-lg-push-3">
                            <div class="card bg-info-inverse">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-middle media-left">
                                            <span class="bg-info circle sq-48">
                                                <span class="icon icon-shopping-bag"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Activities</h6>
                                            <h3 class="media-heading">
                                                <span class="fw-l" id="activities"></span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-3 col-lg-pull-3">
                            <div class="card bg-danger-inverse">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-middle media-left">
                                            <span class="bg-danger circle sq-48">
                                                <span class="icon icon-user"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Beneficiaries Trained</h6>
                                            <h3 class="media-heading">
                                                <span class="fw-l" id="bentrained"></span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-lg-pull-0">
                            <div class="card bg-warning-inverse">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-middle media-left">
                                            <span class="bg-warning circle sq-48">
                                                <span class="icon icon-users"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Beneficiaries applying techniques/technologies</h6>
                                            <h3 class="media-heading">
                                                <span class="fw-l" id="benapplied"></span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutter-xs">
                        <div class="col-xs-12 col-md-12">
                            
                            <div class="panel panel-body text-center" data-toggle="match-height">
<!--                                 <h4 class="m-b-0">Beneficiaries Per region</h4>
                               --> <div class="card-body">
                                    <h4 class="card-title pull-left">Beneficiaries Per region</h4>
                                </div>
                                <canvas id="myChart"  data-hide='["gridLinesX", "legend"]'></canvas>
                               
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="panel panel-body text-center" data-toggle="match-height">
                                 <div class="card-body">
                                    <h4 class="card-title pull-left">Beneficiaries Per category</h4>
                                </div>
                                <canvas id="myChartCategory"  data-hide='["gridLinesX", "legend"]'></canvas>
                          
<!--                                <h6 class="m-b-0">Beneficiaries Per category</h6>-->

                            </div>
                        </div>
                    </div>

                    <div class="row gutter-xs">
                        <div class="col-xs-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Beneficiaries Per Districts</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-chart">
                                        <canvas id="districtsChart"
                                                data-hide='["gridLinesX", "legend"]'
                                                ></canvas>
                                    </div>
                                </div>
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
        <script src="js/dashboard.js"></script>

        <script src="js/elephant.min.js"></script>
        <script src="js/application.min.js"></script>

    </body>
</html>
<!-- Localized -->