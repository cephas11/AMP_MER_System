<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';

class DashboardClass {

    public function getTotalBeneficiaries() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT count(beneficiary_id) AS total FROM beneficiaries WHERE active=0");
        while ($row = mysqli_fetch_assoc($query)) {
            $total = $row['total'];
        }
        $connection->closeConnection($conn);
        echo $total;
    }

    public function getTotalActivitiesCompleted() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT count(id) AS total FROM completion_tool_activity WHERE status=0");
        while ($row = mysqli_fetch_assoc($query)) {
            $total = $row['total'];
        }
        $connection->closeConnection($conn);
        echo $total;
    }

    public function getLoanGivenOut() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT amount
FROM total_amount_disbursed_view    
WHERE  financial_type='Loan'  
");
        while ($row = mysqli_fetch_assoc($query)) {
            $total = $row['amount'];
        }
        $connection->closeConnection($conn);
        echo $total;
    }

    public function getGrantGivenOut() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT amount
FROM total_amount_disbursed_view    
WHERE  financial_type='Grant'  
");
        while ($row = mysqli_fetch_assoc($query)) {
            $total = $row['amount'];
        }
        $connection->closeConnection($conn);
        echo $total;
    }

    //
    public function getRegions() {
        $results = array();
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_per_region ");

        if (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

                $results[] = $row['name'];
                
            }
        }

        echo json_encode($results);
        $connection->closeConnection($conn);
    }
      public function getBeneficiaryPerRegion() {
        $results = array();
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_per_region ");

        if (mysqli_num_rows($query) > 0) {

            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

                $results[] = $row['total'];
                
            }
        }

        echo json_encode($results);
        $connection->closeConnection($conn);
    }


}
