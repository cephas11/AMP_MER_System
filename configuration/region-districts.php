
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Region Districts</title>

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

                    <div class="text m-b">
                        <h3 class="m-b-0">Region Districts</h3>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-10 ">

                            </div>
                            <div class="col-md-2 ">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regionDistrictsModal" data-whatever="@mdo">Add New </button>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom:5px;">

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="regionDistrictTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>Region</th>

                                                    <th>District</th>
                                                    <th>Delete</th>
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

                <div class="modal fade" id="regionDistrictsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">New </h4>
                            </div>
                            <form id="saveRegionDistrictsForm">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="region" class="control-label">Region:</label>
                                        <select id="region" name="region" class="form-control select2" required>
                                            <option value="" >Choose Region</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="control-label">Districts:</label>

                                        <select id="districts" name="districts[]"  class="form-control select2" multiple="multiple" required>
                                           
                                        </select>
                                    </div>
                                        
                                    <input type="hidden" name="type" value="saveRegionDistricts">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                 <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="deleteRegionDistrictForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete ? 
                                        </p>
                                    </div>
                                    <input type="hidden" id="code" name="code"/>
                                    <input type="hidden"  name="type" value="deleteRegionDistrict"/>


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
        <script src="../js/region-districts.js"></script>


    </body>
</html>
<!-- Localized -->
