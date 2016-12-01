<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';

class ActivityClass {
    
     var $response = array();

    public function getBeneficiaries($regcode,$catcode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE region_code='" . $regcode . "' AND  category_code='" . $catcode . "' ");
        
         $response["data"] = array();
        
         $i=0;
         
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $sample = array();
                $sample[0] = $row['code'];
                $sample[1] = $row['name'];
                $response["data"][$i] = $sample;
               
                $i = $i+1;
           }
            echo json_encode($response);

          
        } else {

        echo    $feedback = json_encode($this->response);
        }

      
        $connection->closeConnection($conn);
    } 
    
    
}
