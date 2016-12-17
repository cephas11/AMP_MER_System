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
                                                <span class="icon icon-files-o"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Total Loan Given Out</h6>
                                            <h3 class="media-heading">
                                               <span class="fw-l" id="loan"></span>
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
                                                <span class="icon icon-envelope-o"></span>
                                            </span>
                                        </div>
                                        <div class="media-middle media-body">
                                            <h6 class="media-heading">Total Grant Given Out</h6>
                                            <h3 class="media-heading">
                                                <span class="fw-l" id="grant"></span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gutter-xs">
                        <div class="col-xs-12 col-md-6">
                            <div class="panel panel-body text-center" data-toggle="match-height">
                                <canvas data-chart="line" data-labels='["Western", "Central", "Greater", "North"]' data-values='[{"backgroundColor": "rgba(80, 180, 50, 0.2)", "borderColor": "#50b432", "borderWidth": 2, "pointBackgroundColor": "#50b432", "pointRadius": 1, "label": "Visitors", "data": [60285, 50687, 56529, 49634]}]' data-hide='["gridLinesX", "legend"]' height="150" width="300"></canvas>
                              
                              
                                <h6 class="m-b-0">Beneficiaries Per region</h6>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="panel panel-body text-center" data-toggle="match-height">
                                <canvas data-chart="line" data-labels='["May", "Jun", "Jul", "Aug"]' data-values='[{"backgroundColor": "transparent", "borderColor": "#50b432", "label": "Visitors", "data": [60285, 50687, 56529, 49634]}]' data-hide='["legend"]' height="150" width="300"></canvas>
                                <h6 class="m-b-0">Beneficiaries Per category</h6>

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
                                        <canvas id="demo-visitors" data-chart="bar" data-animation="false" data-labels='["Aug 1", "Aug 2", "Aug 3", "Aug 4", "Aug 5", "Aug 6", "Aug 7", "Aug 8", "Aug 9", "Aug 10", "Aug 11", "Aug 12", "Aug 13", "Aug 14", "Aug 15", "Aug 16", "Aug 17", "Aug 18", "Aug 19", "Aug 20", "Aug 21", "Aug 22", "Aug 23", "Aug 24", "Aug 25", "Aug 26", "Aug 27", "Aug 28", "Aug 29", "Aug 30", "Aug 31"]' data-values='[{"label": "Visitors", "backgroundColor": "#27ae60", "borderColor": "#27ae60",  "data": [29432, 20314, 17665, 22162, 31194, 35053, 29298, 36682, 45325, 39140, 22190, 28014, 24121, 39355, 36064, 45033, 42995, 30519, 20246, 42399, 37536, 34607, 33807, 30988, 24562, 49143, 44579, 43600, 18064, 36068, 41605]}]' data-hide='["legend", "scalesX"]' height="150"></canvas>
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