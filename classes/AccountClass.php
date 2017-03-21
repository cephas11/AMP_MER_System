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
                $audit->setAuditLog('Created ' . $name . ' user goup');
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
        $audit->setAuditLog("Retreive user groups");

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
            $audit->setAuditLog("Updated" . $name . " user group ");
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
        if ($query) {
            $audit = new AuditClass();
            $audit->setAuditLog("Deleted user " . $name);

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

    public function retreiveForms() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM forms");
        $audit = new AuditClass();
        $audit->setAuditLog("Retreive Forms ");

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


        $this->deleteUserPermission($usergroup);



        $array = json_decode($data, true);

        foreach ($array as $item) { //foreach element in $arr
            $query = mysqli_query($conn, "INSERT INTO permissions_and_roles(user_group_id,form_id,view_status,edit_status,delete_status,create_status,createdby) VALUES ('" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $item['formid']) . "','" . mysqli_real_escape_string($conn, $item['view']) . "','" . mysqli_real_escape_string($conn, $item['edit']) . "','" . mysqli_real_escape_string($conn, $item['deletestatus']) . "','" . mysqli_real_escape_string($conn, $item['all']) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
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

    private function getUserPermission($usergroup) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM permissions_and_roles WHERE user_group_id=$usergroup");



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
            $password = $this->generateuniqueCode();

            $query = mysqli_query($conn, "INSERT INTO users(name,username,password,email,phoneno,usergroup,createdby) VALUES ('" . mysqli_real_escape_string($conn, $name) . "','" . mysqli_real_escape_string($conn, $username) . "','" . mysqli_real_escape_string($conn, $password) . "','" . mysqli_real_escape_string($conn, $email) . "','" . mysqli_real_escape_string($conn, $phoneno) . "','" . mysqli_real_escape_string($conn, $usergroup) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')");
            if ($query) {
                $audit = new AuditClass();
                $audit->setAuditLog("Created new user " . $name);

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
            $this->response['userdetails'] = 'Username: ' . $username . '. Password: ' . $password;
        } else {
            $this->response['success'] = '1';
            $this->response['message'] = 'User created successfully.User Details has been sent to email';
            $this->response['userdetails'] = 'Username: ' . $username . '. Password: ' . $password;
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
            $audit->setAuditLog("Retreive users");

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

            //$this->response['data'] = mysqli_fetch_array($results,MYSQLI_ASSOC);
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

}
