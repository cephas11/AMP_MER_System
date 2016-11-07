<?php

//$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
//require_once $path .'/databaseConnectionClass.php';
require_once '../databaseConnectionClass.php';

class BeneficiaryClass {
    //put your code here
    var $response = array();

    public function getDescriptionBasedOnCategory($category_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
	$query = mysqli_query($conn, "SELECT * FROM description_categories_view WHERE category_code='".$category_code."'");
        //print("Hello here");
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
    
    public function getDistrictsBasedOnRegion($district_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
	$query = mysqli_query($conn, "SELECT * FROM region_districts_view WHERE egion_code='".$category_code."'");
        //print("Hello here");
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

}
