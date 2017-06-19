<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
require_once $path . '/classes/AuditClass.php';

class AccountClass {

    var $response = array();

//

    public function setUserGroup($name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdBy = $_SESSION['username'];
        $audit = new AuditClass();

        $results = $this->checkUserGroupExistence($name);
        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User Group already exist';
        } else {
            $query = mysqli_query($conn, "INSERT INTO user_groups(name,createdBy) VALUES ('" . mysqli_real_escape_string($conn, $name) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            if ($query) {
                $audit->setAuditLog('Created ' . $name . ' user group');
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
        $audit = new AuditClass();
        $audit->setAuditLog("Retreived user groups");

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
            $audit = new AuditClass();
            $audit->setAuditLog("Updated" . $name . " user group information");
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

    public function deleteUserGroup($id, $name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE user_groups SET active = 1 WHERE id=$id");
        if ($query) {
            $audit = new AuditClass();
            $audit->setAuditLog("Deleted " . $name . " user group ");

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

    public function deleteUser($id, $name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE users SET deleted = 1 WHERE id=$id");
        $audit = new AuditClass();
        $audit->setAuditLog("Deleted user " . $name);
        if ($query) {


            $this->response['success'] = '1';
            $this->response['message'] = 'User  deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function retreivePermissions() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM permissions");
        $audit = new AuditClass();
        $audit->setAuditLog("Retreived permissions ");

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

        $createdBy = $_SESSION['meruserid'];
        $this->deleteUserPermission($usergroup);

        $audit = new AuditClass();
        foreach ($data as $perm) { //foreach element in $arr
            $query = mysqli_query($conn, "INSERT INTO permissions_and_roles(user_group_id,perm_keyword,createdby) VALUES ('" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $perm) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            $audit->setAuditLog("Added" . $perm . " permission to " . $usergroup);
        }

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Permissions added to UserGroup';
        }
        $connection->closeConnection($conn);
        echo json_encode($this->response);
    }

    private function deleteUserPermission($usergroup) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        mysqli_query($conn, "DELETE FROM permissions_and_roles WHERE user_group_id=$usergroup");



        $connection->closeConnection($conn);
    }

    public function getUserPermission($usergroup) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT perm_keyword FROM permissions_and_roles WHERE user_group_id=$usergroup");



        $connection->closeConnection($conn);
        return $query;
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
        $createdBy = $_SESSION['username'];

        $results = $this->checkUserExistence($email);
        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User already exist';
        } else {
            $audit = new AuditClass();
            $audit->setAuditLog("Created new user " . $name);

            $password = $this->generateuniqueCode();
            $password_hash = md5($password);
            $query = mysqli_query($conn, "INSERT INTO users(name,username,password,email,phoneno,usergroup,createdby) VALUES ('" . mysqli_real_escape_string($conn, $name) . "','" . mysqli_real_escape_string($conn, $username) . "','" . mysqli_real_escape_string($conn, $password_hash) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $phoneno) . "','" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            if ($query) {

                $this->sendemail($username, $email, $password);
            } else {
                $this->response['success'] = '0';
                $this->response['message'] = 'Error creating user';
                $this->response['userdetails'] = 'Error: ' . mysqli_error($conn);
            }
        }

        $connection->closeConnection($conn);
    }

    private function sendemail($username, $emmail, $password) {

        $to = $emmail;
        $subject = 'Account created';
        $from = 'Amp Mer System ';

// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
        $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
        $message = '<html><body>';
        $message .= 'Hello,' . $username . '.\n Your account has successfully been created.'
                . 'sername:' . $username . ',Password:' . $password . '';

        $message .= '</body></html>';


        $result = mail($to, $subject, $message, $headers);
        if (!$result) {
            $this->response['success'] = '0';
            $this->response['message'] = 'User created successfully but Email wasnt sent';
            $this->response['userdetails'] = 'Username: ' . $username;
        } else {
            $this->response['success'] = '1';
            $this->response['message'] = 'User created successfully.User Details has been sent to email';
            $this->response['userdetails'] = 'Username: ' . $username;
        }
        echo json_encode($this->response);
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
        $query = mysqli_query($conn, "SELECT * FROM users_view WHERE deleted=0");
        if (mysqli_num_rows($query) > 0) {
            $audit = new AuditClass();
            $audit->setAuditLog("Retreived all users");

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

    public function getGroupPermissions($usergroup) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $results = $this->getUserPermission($usergroup);

        if (mysqli_num_rows($results) == 0) {
            $this->response['success'] = '1';
            $this->response['message'] = 'New permission to be assigned';
        } else {
            $this->response['success'] = '0';

            $this->response['message'] = array();

            while ($one = mysqli_fetch_assoc($results)) {
                array_push($this->response['message'], $one);
            }

            $this->response['data'] = mysqli_fetch_array($results, MYSQLI_ASSOC);
        }

        $feedback = json_encode($this->response);

        echo $feedback;
    }

    public function getUserInfo($userid) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM users_view WHERE id=$userid");

        if (mysqli_num_rows($query) > 0) {

            $feedback = json_encode(mysqli_fetch_assoc($query));
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function updateUserInfo($name, $username, $email, $phoneno, $usergroup, $id) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database


        $query = mysqli_query($conn, "UPDATE users SET name =  '" . mysqli_real_escape_string($conn, $name) . "' , username =  '" . mysqli_real_escape_string($conn, $username) . "' , email =  '" . mysqli_real_escape_string($conn, $email) . "' , phoneno =  '" . mysqli_real_escape_string($conn, $phoneno) . "' , usergroup =  '" . mysqli_real_escape_string($conn, $usergroup) . "'  WHERE id=$id");
        if ($query) {
            $audit = new AuditClass();

            $audit->setAuditLog("Updated " . $name . " information");

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

    public function setPermission($name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $results = $this->checkPermissionExistence($name);
        if ($results > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'Permission Keyword already exist';
        } else {
            $query = mysqli_query($conn, "INSERT INTO permissions(perm_keyword) VALUES ('" . mysqli_real_escape_string($conn, $name) . "')");
            if ($query) {
                $audit = new AuditClass();

                $audit->setAuditLog("Added " . $name . " permission");

                $this->response['success'] = '1';
                $this->response['message'] = 'New Permission saved successfully';
            }
        }
        echo json_encode($this->response);

        $connection->closeConnection($conn);
    }

    private function checkPermissionExistence($name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM permissions WHERE perm_keyword LIKE '%" . $name . "%'");
//echo  "SELECT * FROM permissions WHERE perm_keyword LIKE '%".$name."%'";

        $connection->closeConnection($conn);
        return mysqli_num_rows($query);
    }

    public function updatePassword($password) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $password_hash = md5($password);

        $query = mysqli_query($conn, "UPDATE users SET password = '" . $password_hash . "' WHERE id=" . $_SESSION['meruserid'] . "");
        if ($query) {
            $audit = new AuditClass();
            $audit->setAuditLog("Changed password ");

            $this->response['success'] = '1';
            //s    $this->response['query']= "UPDATE users SET password = '" . $password_hash . "' WHERE id=".$_SESSION['meruserid']."";
            $this->response['message'] = 'Password  updated successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
//        $connection->closeConnection($conn);
    }

    public function forgotPassword($email) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = "SELECT * FROM users where email='" . $email . "'";
        $result = mysqli_query($conn, $query);
        $Results = mysqli_fetch_array($result);

        if (count($Results) >= 1) {

            $encrypt = $Results['id'];
            $to = $email;
            $subject = "Forget Password";
            $from = 'Mer Application Portal';
            $body = 'Hi ' . $Results['name'] . ', <br><br>Click here to reset your password localhost/AMP_MER_System/reset-password.php?encrypt=' .urlencode($encrypt)  . '&action=reset   <br/> <br/>--<br>Amplifies Ghana<br>';
            $headers = "From: " . strip_tags($from) . "\r\n";
            // $headers .= "Reply-To: " . strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

          $result =  mail($to, $subject, $body, $headers);
//          if (!$result) {
//              
//          }else{
//              
//          }
          
            $this->response['success'] = '1';
            $this->response['message'] = 'Your password reset link send to your e-mail address';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'Email not found';
            echo json_encode($this->response);
        }
    }

    
     public function getUserId($id) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = "SELECT * FROM users where id='" . $id . "'";
        $result = mysqli_query($conn, $query);
        $Results = mysqli_fetch_array($result);

        if (count($Results) >= 1) {
            return $Results['id'];
        }else{
            return 0;
        }
           
    }
    
     public function resetPassword($password,$userid) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $password_hash = md5($password);

        $query = mysqli_query($conn, "UPDATE users SET password = '" . $password_hash . "' WHERE id=".$userid."");
        if ($query) {
//            $audit = new AuditClass();
//            $audit->setAuditLog("Reset password ",$userid);

            $this->response['success'] = '1';
            //s    $this->response['query']= "UPDATE users SET password = '" . $password_hash . "' WHERE id=".$_SESSION['meruserid']."";
            $this->response['message'] = 'Password  changed successfully.Kindly login with new password.';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' .$userid. mysqli_error($conn);
            echo json_encode($this->response);
        }
//        $connection->closeConnection($conn);
    }

}
