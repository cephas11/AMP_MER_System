
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
        <title>User Groups</title>

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
                        <h3 class="m-b-0">User Groups</h3>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-10 ">

                            </div>
                            <div class="col-md-2 ">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userGroupModal" data-whatever="@mdo"> New User Group</button>
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
                                        <table id="usergroupsTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>

                                                    <th>Name</th>

                                                    <th>Action </th>

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

                <div class="modal fade" id="userGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">New User Group</h4>
                            </div>
                            <form id="saveUserGroupForm" method="POST" >
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label  class="control-label">Name:</label>
                                        <input type="text" class="form-control" name="usergroup" id="usergroup" required>
                                    </div>
                                    <input type="hidden" class="form-control" name="type" value="saveUserGroup">


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Update User Group</h4>
                            </div>
                            <form id="updateUserGroupForm" >
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="region" class="control-label">Name:</label>
                                        <input type="text" class="form-control" name="usergroupdetail" id="usergroupdetail" required>
                                    </div>
                                    <input type="hidden" class="form-control" name="type" value="updateUserGroupInformation">

                                    <input type="hidden" class="form-control" name="usergroupid" id="code">
                  

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="post" id="deleteUserGroupForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete this region?.<span class="holder" id="regionholder"></span> 
                                        </p>
                                    </div>
                                    <input type="hidden" id="groupid" name="usergroupid"/>
                                    <input type="hidden"  name="type" value="deleteUserGroup"/>


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
        <script src="../js/usergroup.js"></script>

        <script src="../js/jquery.validate.js"></script>

    </body>
</html>
<!-- Localized -->