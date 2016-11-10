<?php

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';

//require_once '../databaseConnectionClass.php';

class BeneficiaryClass {

    //put your code here
    var $response = array();

    public function getDescriptionBasedOnCategory($category_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM description_categories_view WHERE category_code='" . $category_code . "'");
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
        $query = mysqli_query($conn, "SELECT * FROM region_districts_view WHERE egion_code='" . $category_code . "'");
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

    public function bulkbeneficiaryUpload($filecontents) {
        // echo 'file is good'.$filecontents;

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $contents = fopen($filecontents, "r");
        while (($emapData = fgetcsv($contents, 10000, ",")) !== FALSE) {

            //It wiil insert a row to our beneficiary table from our csv file`
//echo $emapData[0];
            $sql = "INSERT INTO temp_beneficiaries (fiscalyear,dateregistered,name,business_name,gender,email,contactno,community,longitude,latitude,registeredby) VALUES ('" . mysql_real_escape_string($emapData[0]) . "','" . mysql_real_escape_string($emapData[1]) . "','" . mysql_real_escape_string($emapData[2]) . "','" . mysql_real_escape_string($emapData[3]) . "','" . mysql_real_escape_string($emapData[4]) . "','" . mysql_real_escape_string($emapData[5]) . "','" . mysql_real_escape_string($emapData[6]) . "','" . mysql_real_escape_string($emapData[7]) . "','" . mysql_real_escape_string($emapData[8]) . "','" . mysql_real_escape_string($emapData[9]) . "','" . mysql_real_escape_string($emapData[10]) . "','" . mysql_real_escape_string($emapData[11]) . "')";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"bulk-beneficiary-upload\"
						</script>";
            }
        }
        fclose($contents);
        echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"bulk-beneficiary-upload\"
					</script>";
    }

    private function emptyBenficiaryTempTable() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the databaseSELECT * FROM region_districts_view WHERE egion_code=
        mysqli_query($conn, "TRUNCATE temp_beneficiaries");

        $connection->closeConnection($conn);
    }
 public function getBeneficiaryFileContents() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM temp_beneficiaries ");
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
