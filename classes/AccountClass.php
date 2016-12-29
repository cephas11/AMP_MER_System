<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
session_start();

class AccountClass {

    var $response = array();

//

    public function setUserGroup($name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdBy = 'admin';

        $results = $this->checkUserGroupExistence($name);
        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User Group already exist';
        } else {
            $query = mysqli_query($conn, "INSERT INTO user_groups(name,createdBy) VALUES ('" . mysqli_real_escape_string($conn, $name) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            if ($query) {
                $this->response['success'] = '1';
                $this->response['message'] = 'User Group saved successfully';
                
            }
        }
        echo json_encode($this->response);

        $connection->closeConnection($conn);
    }

    public function getUserGroups() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM user_groups WHERE active=0");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $feedback = json_encode($results);
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function updateUserGroup($id, $name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "UPDATE user_groups SET name =  '" . mysqli_real_escape_string($conn, $name) . "' WHERE id=$id");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'User Group updated successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function deleteUserGroup($id) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE user_groups SET active = 1 WHERE id=$id");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'User Group updated successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function retreiveForms() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM forms");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $feedback = json_encode($results);
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function setPermissionsAndRoles($usergroup, $data) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdBy = 'admin';


        $results = $this->checkUserPermission($usergroup);

        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User Group has permissions already assigned to it.Go to update to alter permissions save';
        } else {

            $array = json_decode($data, true);

            foreach ($array as $item) { //foreach element in $arr
                $query = mysqli_query($conn, "INSERT INTO permissions_and_roles(user_group_id,form_id,view_status,edit_status,delete_status,create_status,createdby) VALUES ('" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $item['formid']) . "','" . mysqli_real_escape_string($conn, $item['view']) . "','" . mysqli_real_escape_string($conn, $item['edit']) . "','" . mysqli_real_escape_string($conn, $item['deletestatus']) . "','" . mysqli_real_escape_string($conn, $item['all']) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            }

            if ($query) {
                $this->response['success'] = '1';
                $this->response['message'] = 'Permissions added to UserGroup';
            }
        }
        echo json_encode($this->response);

        $connection->closeConnection($conn);
    }

    private function checkUserPermission($usergroup) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM permissions_and_roles WHERE user_group_id=$usergroup");



        $connection->closeConnection($conn);
        return mysqli_num_rows($query);
    }

    private function checkUserGroupExistence($name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM user_groups WHERE name LIKE '%" . $name . "%'");


        $connection->closeConnection($conn);
        return mysqli_num_rows($query);
    }

    public function setUser($name, $username, $email, $phoneno, $usergroup) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdBy = 'admin';

        $results = $this->checkUserExistence($email);
        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User already exist';
        } else {
            $password = $this->generateuniqueCode();

            $query = mysqli_query($conn, "INSERT INTO users(name,username,password,email,phoneno,usergroup,createdby) VALUES ('" . mysqli_real_escape_string($conn, $name) . "','" . mysqli_real_escape_string($conn, $username) . "','" . mysqli_real_escape_string($conn, $password) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $phoneno) . "','" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            if ($query) {
                //     $this->sendemail($username, $email, $password);
                $this->response['success'] = '1';
                $this->response['message'] = 'User created successfully';

                //   $query->close();
            }
        }
        echo json_encode($this->response);
        $connection->closeConnection($conn);
    }

    private function sendemail($username, $email, $password) {

        $to = "$email";
        $subject = 'User Created Successfully';
        $from = 'Amp Mer System';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
        $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<table width="100%" cellspacing="0" cellpadding="0" border="0" align="center" style="border-left-color:#e4e4e4;border-left-style:solid;border-left-width:1px;border-right-color:#e4e4e4;border-right-style:solid;border-right-width:1px">
    <tbody><tr bgcolor="#f5f5f5">
        <td align="center" style="border-collapse:collapse;color:#7a7a7a;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;padding-left:10px;padding-right:10px">
            <table width="594">
                <tbody><tr>
                    <td align="left" style="border-collapse:collapse;color:#7a7a7a;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px">
                        <a href="">
                            <img alt="Amp Mer System" height="52" src="http://35.161.105.234/AMP_MER_System/img/logo2.png" width="208" style="border:none;line-height:100%;outline:none;text-decoration:none" class="CToWUd">
                        </a>              </td>
                </tr>
                </tbody></table>
        </td>
    </tr>


    <tr bgcolor="#ffffff">
        <td align="center" style="border-collapse:collapse;color:#7a7a7a;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;padding:30px 10px 50px">
            <table width="594" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody><tr>
                    <td style="border-collapse:collapse;color:#7a7a7a;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;padding-bottom:30px">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td align="left" valign="top" style="border-collapse:collapse;color:#7a7a7a;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;padding-bottom:15px">
                                    <h1 style="color:#666666;font-size:28px;font-style:normal;font-weight:700;margin:0">Hi ' . $firstname . ',</h1>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" valign="top" style="border-collapse:collapse;color:#949494;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:20px">
                                    <strong>Below is your credentials to login to Amp Mer System portal.</strong><br>
                                    <br>
<strong>Username:</strong>' . $username . '<br>
<strong>Password:</strong>' . $password . '<br><br><br>

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

               
                </tbody></table>
        </td>
    </tr>



    <tr width="100%" bgcolor="#f0f0f0" align="center">
        <td align="center" style="border-collapse:collapse;color:#7a7a7a;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;padding:20px 10px;text-align:center">
            <table width="594" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>

                <tr>
                    <td align="center" valign="top" style="border-collapse:collapse;color:#999;font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;padding-top:10px">
                        Copyright Amp Mer System 2016 |  Greater Accra, Ghana · <br>
                        
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>';

        $message .= '</body></html>';


        mail($to, $subject, $message, $headers);
    }

    private function generateuniqueCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getUsers() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM users WHERE deleted=0");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $feedback = json_encode($results);
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    private function checkUserExistence($email) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='" . $email . "'");


        $connection->closeConnection($conn);
        return mysqli_num_rows($query);
    }

    public function getUserGroupPermissions() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $user_group = $_SESSION['usergroup'];
        $query = mysqli_query($conn, "SELECT * FROM permissions_and_roles WHERE user_group_id=" . $user_group . "");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $feedback = json_encode($results);
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function getFormPermissions($formid) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $user_group = $_SESSION['usergroup'];
        $query = mysqli_query($conn, "SELECT * FROM permissions_and_roles WHERE user_group_id=" . $user_group . " AND form_id=$formid");

        if (mysqli_num_rows($query) > 0) {
            $results = mysqli_fetch_array($query, MYSQLI_ASSOC);
            $feedback = json_encode($results);
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

}
