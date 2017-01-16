

<?php
session_start();
if ($_SESSION['login_valid'] != "YES") {
    ?>
    <script type="text/javascript">
        window.location = '../index.php';
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Users</title>

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
                        <h3 class="m-b-0">Users</h3>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-10 ">

                            </div>
                            <div class="col-md-2 ">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal" id="createUserBtn" style="display: none" data-whatever="@mdo">Add New User</button>
                            </div>
                        </div>
                    </div>
                    <div style="margin-bottom:5px;">

                    </div>
                    <div class="row">

                        <div class="col-xs-12">
                            <h4> <p class="userdetails holder"></p></h4>

                            <div class="panel">

                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="usersTbl" class="table table-middle nowrap">
                                            <thead>
                                                <tr>

                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Contact No</th>
                                                    <th>User Group</th>
                                                    <th>Created By</th>

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

                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">New User</h4>
                            </div>
                            <form id="saveUserForm" >
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="region" class="control-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="control-label">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="control-label">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="region" class="control-label">Contact No:</label>
                                        <input type="text" min="10" class="form-control" name="phoneno" id="phoneno" required>
                                    </div>

                                    <div class="form-group">
                                        <label  class="form-label">User Group</label>
                                        <select name="userGroup" id="userGroup" class="form-control select2" required>

                                            <option value="">Choose</option>

                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <input type="hidden" class="form-control" name="type" value="saveUser">


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
                            <form method="post" id="deleteUserForm">
                                <div class="modal-body">
                                    <div>
                                        <p>
                                            Are you sure you want to delete this User?.<span class="holder" id="userholder"></span> 
                                        </p>
                                    </div>
                                    <input type="hidden" id="userid" name="userid"/>
                                    <input type="hidden"  name="type" value="deleteUser"/>


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
        <script src="../js/users.js"></script>
        <script src="../js/select2.js"></script>
        <script src="../js/jquery.validate.js"></script>

    </body>
</html>
<!-- Localized -->
