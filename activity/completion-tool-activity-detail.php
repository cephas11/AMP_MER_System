<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Completion Tool Activity</title>

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
        <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.0.4/css/dataTables.checkboxes.css" rel="stylesheet" />
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
                        <h3 class="m-b-0">Activity Completion Tool </h3>
                    </div>
                    <div class="row gutter-xs">
                        <div class="card">

                            <div class="card-body">
                                
                                         
                                <form id="completionTooLActivityForm" method="POST" enctype="multipart/form-data">
                                    <div class="col-xs-12">

                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label for="name-1" class="control-label">Date of  Activity</label>
                                            <div class="input-with-icon">
                                                <input class="form-control" type="text" name="activityDate" id="activityDate" data-provide="datepicker">
                                                <span class="icon icon-calendar input-icon"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label  class="form-label">Type Of Activity</label>
                                            <select name="activityType" id="activityType" class="form-control select2">

                                              
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label  class="form-label">Activity Description</label>
                                            <select name="description" id="activityDescription" class="form-control ">

                                                
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <label  class="form-label">Category</label>
                                            <input class="form-control" type="text" name="category" id="category" readonly>

                                            <span class="help-block"></span>
                                        </div>





                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label  class="form-label">Region</label>
                                            <input class="form-control" type="text" id="region" name="region" readonly>


                                            <span class="help-block"></span>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label  class="form-label">District</label>
                                            <input class="form-control" type="text" id="district" name="district" readonly>



                                            <span class="help-block"></span>
                                        </div> 

                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <label  class="control-label">Community</label>
                                            <input  class="form-control" type="text" id="community" name="community" required>
                                            <small class="help-block"></small>
                                        </div>




                                        <div class="col-lg-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label  class="form-label">Activity Implementer </label>
                                                <input  class="form-control" type="text" id="activityImplementer" name="activityImplementer" readonly required>



                                                <span class="help-block"></span>
                                            </div>


                                        </div>

                                        <div class="row">

                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label  class="form-label">Male Participants</label>
                                                    <input  class="form-control" type="text" id="maleParticipants" name="maleParticipants" readonly required>
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label  class="form-label">Female Participants</label>
                                                    <input  class="form-control" type="text" id="femaleParticipants" name="femaleParticipants" readonly required>
                                                    <small class="help-block"></small>
                                                </div> 
                                            </div>
                                            <div class="col-lg-4 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label  class="control-label">Total Participants</label>
                                                    <input  class="form-control" type="text" id="totalParticipants" name="totalParticipants" readonly required>
                                                    <small class="help-block"></small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>




                                </form>




                            </div>
                            <div class="row">
                                <div class=" col-lg-12 ">

                                    <div class="table-responsive">
                                        <table id="participantsTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox">
                                                    </th>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>District</th>

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
                <?php
                require_once '../footer.php';
                ?>
            </div>

         <script src="../js/vendor.min.js"></script>
        <script src="../js/elephant.min.js"></script>
        <script src="../js/application.min.js"></script>
        <script src="../js/demo.min.js"></script>
       
        <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.0.4/js/dataTables.checkboxes.min.js"></script>
        <script src="../js/completion-tool-detail.js"></script>

    </body>
</html>
<!-- Localized -->