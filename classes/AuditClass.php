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
    
    public function auditlogs() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
     
        $query = mysqli_query($conn, "SELECT * FROM audit_logs_view ORDER BY dateacreated DESC");
        if (mysqli_num_rows($query) > 0) {


            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $feedback = json_encode($results);
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

}
