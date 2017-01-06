<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';

class LoginClass {

    var $response = array();

    public function login($username, $password) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

       // $password = md5($password);
        $query = mysqli_query($conn,"SELECT * FROM users WHERE username = '" . trim($username) . "' AND password = '" . trim($password) . "'");

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);

                $userType = $row['usergroup'];
                $userid = $row['id'];

                $_SESSION['usergroup'] = $userType;
                $_SESSION['username'] = $username.$userid;
                $_SESSION['meruserid'] = $userid;
                $_SESSION['login_valid'] = "YES";
                echo '0';
            } else {
                echo '1';
            }
        }
    }

}
