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
        $createdBy = 'aba';


        if ($contents !== FALSE) {
 // fgets() Gets a line from file pointer and read the first line from $handle and ignore it.   
            fgets($contents);
            // created loop here
            while (($emapData = fgetcsv($contents, 10000, ",")) !== FALSE) {

                //It wiil insert a row to our beneficiary table from our csv file`
//           echo  'name is : '. $emapData[0].'<br>';
//            echo "INSERT INTO temp_beneficiaries (name,business_name,gender,email,contactno,community,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby) "
//            . "VALUES ('" . mysqli_real_escape_string($conn,$emapData[0]) . "','" . mysqli_real_escape_string($conn,$emapData[1]) . "','" . mysqli_real_escape_string($conn,$emapData[2]) . "','" . mysqli_real_escape_string($conn,$emapData[3]) . "','" . mysqli_real_escape_string($conn,$emapData[4]) . "','" . mysqli_real_escape_string($conn,$emapData[5]) . "','" . mysqli_real_escape_string($conn,$emapData[6]) . "',"
//                    . "'" . mysqli_real_escape_string($conn,$emapData[7]) . "','" . mysqli_real_escape_string($conn,$emapData[8]) . "','" . mysqli_real_escape_string($conn,$emapData[9]) . "','" . mysqli_real_escape_string($conn,$emapData[10]) . "',"
//                    . "'" . mysqli_real_escape_string($conn,$createdBy) . "')";
//           
                $sql = "INSERT INTO temp_beneficiaries (name,business_name,gender,email,contactno,community,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby) "
                        . "VALUES ('" . mysqli_real_escape_string($conn, $emapData[0]) . "','" . mysqli_real_escape_string($conn, $emapData[1]) . "','" . mysqli_real_escape_string($conn, $emapData[2]) . "','" . mysqli_real_escape_string($conn, $emapData[3]) . "','" . mysqli_real_escape_string($conn, $emapData[4]) . "','" . mysqli_real_escape_string($conn, $emapData[5]) . "','" . mysqli_real_escape_string($conn, $emapData[6]) . "',"
                        . "'" . mysqli_real_escape_string($conn, $emapData[7]) . "','" . mysqli_real_escape_string($conn, $emapData[8]) . "','" . mysqli_real_escape_string($conn, $emapData[9]) . "','" . mysqli_real_escape_string($conn, $emapData[10]) . "',"
                        . "'" . mysqli_real_escape_string($conn, $createdBy) . "')";

                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"bulk-beneficiary-upload\"
						</script>";
                }
            }
        }


        fclose($contents);
        echo "<script type=\"text/javascript\">
					
						window.location = \"bulk-beneficiary-upload\"
					</script>";
    }

    public function emptyBenficiaryTempTable() {
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

    public function setBeneficiaryBulkData($tabledata) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $createdby = 'admin';
        $datecreated = date("Y-m-d");
        foreach ($tabledata as $item) { //foreach element in $arr
            $code = 'BENE' . $this->generateuniqueCode(10);
            $query = mysqli_query($conn, "INSERT INTO beneficiaries(code,name,business_name,gender,email,contactno,category_code,description_code,region_code,district_code,community,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby,datecreated,timeadded)"
                    . " VALUES "
                    . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $item['name']) . "','" . mysqli_real_escape_string($conn, $item['businessName']) . "',"
                    . "'" . mysqli_real_escape_string($conn, $item['gender']) . "','" . mysqli_real_escape_string($conn, $item['email']) . "','" . mysqli_real_escape_string($conn, $item['contactno']) . "',"
                    . "'" . mysqli_real_escape_string($conn, $item['category']) . "','" . mysqli_real_escape_string($conn, $item['description']) . "','" . mysqli_real_escape_string($conn, $item['region']) . "','" . mysqli_real_escape_string($conn, $item['district']) . "',"
                    . "'" . mysqli_real_escape_string($conn, $item['community']) . "','" . mysqli_real_escape_string($conn, $item['longitude']) . "','" . mysqli_real_escape_string($conn, $item['latitude']) . "','" . mysqli_real_escape_string($conn, $item['fiscalYear']) . "',"
                    . "'" . mysqli_real_escape_string($conn, $item['dateRegistered']) . "','" . mysqli_real_escape_string($conn, $item['registeredBy']) . "','" . mysqli_real_escape_string($conn, $createdby) . "','" . $datecreated . "','" . time() . "')");
        }


        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Data saved successfully';
            echo json_encode($this->response);
            //   $query->close();
            $this->emptyBenficiaryTempTable();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getBeneficiaresList() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view ");
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

    private function generateuniqueCode($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
