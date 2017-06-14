<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReportClass
 *
 * @author matiyas
 */
$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
require_once $path . '/classes/AuditClass.php';

class ReportClass {

    //put your code here
    var $response = array();

    public function getBeneficiaries($query_data) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, $query_data);
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

    public function getActivityReport() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT * FROM activity_completion_tool_view WHERE status=0");
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

     public function getFinancialReport() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT count(financial_services_tracker.id) as totals, sum(financial_services_tracker.amount_disbursed) as volume, financial_services_tracker.financial_type ,beneficiaries.gender FROM `financial_services_tracker` LEFT JOIN beneficiaries ON financial_services_tracker.beneficiary_code = beneficiaries.code GROUP BY beneficiaries.gender, financial_services_tracker.financial_type");
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
    
     public function getSalesReport() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT sales_tracker.id,sales_tracker.commodity,sum(sales_tracker.value_usd) as usd,sum(sales_tracker.value_tonnes) as value_tonnes FROM `sales_tracker` GROUP BY sales_tracker.commodity");
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
    
    public function getAdoptionReport() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT * from adoption_report");
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $results[] = $row;
            }
            $querypeople = mysqli_query($conn, "SELECT gender,COUNT(gender) AS  total FROM mer_system.beneficiaries WHERE code IN (SELECT DISTINCT  beneficiary_code FROM mer_system.adoption_tracker WHERE applied ='yes') GROUP BY gender");
            while ($row = mysqli_fetch_array($querypeople, MYSQLI_ASSOC)) {
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
