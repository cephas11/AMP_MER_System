<?php

if (session_status() == PHP_SESSION_NONE) {
    ob_start();
    session_start();
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
require_once $path . '/classes/AuditClass.php';

class LoginClass {

    var $response = array();

    public function login($username, $password) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $password = md5($password);
        $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . trim($username) . "' AND password = '" . trim($password) . "'");

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);

                $userType = $row['usergroup'];
                $userid = $row['id'];
                $permissions = array();
                
                $permission = new AccountClass();
                $results = $permission->getUserPermission($userType);
                while ($one = mysqli_fetch_assoc($results)) {
                    array_push($permissions, $one['perm_keyword']);
                }

                $this->response['data'] = mysqli_fetch_array($results, MYSQLI_ASSOC);

                $_SESSION['usergroup'] = $userType;
                $_SESSION['username'] = $username;
                $_SESSION['meruserid'] = $userid;
                $_SESSION['login_valid'] = "YES";
                $_SESSION['permissions'] = $permissions;

                echo '0';
            } else {
                echo '1';
            }
        }
    }

}
