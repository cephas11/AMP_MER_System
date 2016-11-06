<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Regions</title>

    </head>
    <body class="layout layout-header-fixed">
      
        <div class="layout-main">
           
            <div class="layout-content">
                <div class="layout-content-body">

                    <div class="text m-b">
                        <h3 class="m-b-0">Regions</h3>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-10 ">

                            </div>
                            <div class="col-md-2 ">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regionModal" data-whatever="@mdo">Add New Region</button>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom:5px;">

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            
                                    <div>
                                        <table  id="regionstb">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Name</th>

                                                    <th>Action </th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody id="dataset">
                                                
                                            </tbody>
                                        </table>
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="regionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">New Region</h4>
                            </div>
                            <form id="saveRegionForm" >
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="region" class="control-label">Name:</label>
                                        <input type="text" class="form-control" name="region" id="region" required>
                                    </div>
                                    <input type="hidden" class="form-control" name="type" value="saveRegion">


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php
            require_once 'footer.php';
            ?>
        </div>

<!--        <script src="../js/vendor.min.js"></script>
      
        <script src="../js/elephant.min.js"></script>
        <script src="../js/application.min.js"></script>
        <script src="../js/demo.min.js"></script>-->
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        
        <script src="js/test-region.js"></script>

<!--        <script src="../js/jquery.validate.js"></script>-->

    </body>
</html>
<!-- Localized -->
