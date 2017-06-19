<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuditClass
 *
 * @author matiyas
 */if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';

class AuditClass {

    //put your code here

    public function setAuditLog($activity, $userid = null) {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        if ($userid == null) {
            $userid = $_SESSION['meruserid'];
        } else {
            $userid = $userid;
        }

        mysqli_query($conn, "INSERT INTO audit_logs(user_id,activity)"
                . " VALUES "
                . "('" . mysqli_real_escape_string($conn, $userid) . "','" . mysqli_real_escape_string($conn, $activity) . "')");
    }

}
