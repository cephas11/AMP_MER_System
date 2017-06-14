<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
require_once $path . '/classes/AuditClass.php';

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
        $createdBy = 'admin';
        //   print_r($contents) ;

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
                $sql = "INSERT INTO temp_beneficiaries (name,business_name,gender,email,contactno,community,educational_level,address,altcontactno,registered_business,ownership_type,establishment_years,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby) "
                        . "VALUES ('" . mysqli_real_escape_string($conn, $emapData[0]) . "','" . mysqli_real_escape_string($conn, $emapData[1]) . "','" . mysqli_real_escape_string($conn, $emapData[2]) . "','" . mysqli_real_escape_string($conn, $emapData[3]) . "','" . mysqli_real_escape_string($conn, $emapData[4]) . "','" . mysqli_real_escape_string($conn, $emapData[5]) . "','" . mysqli_real_escape_string($conn, $emapData[6]) . "',"
                        . "'" . mysqli_real_escape_string($conn, $emapData[7]) . "','" . mysqli_real_escape_string($conn, $emapData[8]) . "','" . mysqli_real_escape_string($conn, $emapData[9]) . "','" . mysqli_real_escape_string($conn, $emapData[10]) . "'"
                        . ",'" . mysqli_real_escape_string($conn, $emapData[11]) . "','" . mysqli_real_escape_string($conn, $emapData[12]) . "','" . mysqli_real_escape_string($conn, $emapData[13]) . "','" . mysqli_real_escape_string($conn, $emapData[14]) . "'"
                        . ",'" . mysqli_real_escape_string($conn, $emapData[15]) . "','" . mysqli_real_escape_string($conn, $emapData[16]) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')";

//                echo "INSERT INTO temp_beneficiaries (name,business_name,gender,email,contactno,community,educational_level,address,altcontactno,registered_business,ownership_type,establishment_years,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby) "
//                        . "VALUES ('" . mysqli_real_escape_string($conn, $emapData[0]) . "','" . mysqli_real_escape_string($conn, $emapData[1]) . "','" . mysqli_real_escape_string($conn, $emapData[2]) . "','" . mysqli_real_escape_string($conn, $emapData[3]) . "','" . mysqli_real_escape_string($conn, $emapData[4]) . "','" . mysqli_real_escape_string($conn, $emapData[5]) . "','" . mysqli_real_escape_string($conn, $emapData[6]) . "',"
//                        . "'" . mysqli_real_escape_string($conn, $emapData[7]) . "','" . mysqli_real_escape_string($conn, $emapData[8]) . "','" . mysqli_real_escape_string($conn, $emapData[9]) . "','" . mysqli_real_escape_string($conn, $emapData[10]) . "'"
//                        . ",'" . mysqli_real_escape_string($conn, $emapData[11]) . "','" . mysqli_real_escape_string($conn, $emapData[12]) . "','" . mysqli_real_escape_string($conn, $emapData[13]) . "','" . mysqli_real_escape_string($conn, $emapData[14]) . "'"
//                        . ",'" . mysqli_real_escape_string($conn, $emapData[15]) . "','" . mysqli_real_escape_string($conn, $emapData[16]) . "','" . mysqli_real_escape_string($conn, $createdBy) . "')";

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
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE active=0 ");
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

    public function setBeneficiary($info) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $createdby = $_SESSION['meruserid'];
        $datecreated = date("Y-m-d");
        $categorycode = explode('-', $info['category']);
        $category_code = $categorycode[1];

        $regcode = explode('-', $info['region']);
        $reg_code = $regcode[1];

        $fiscalyear = explode('FY', $info['fiscalYear']);


        $shortcode = $regcode[0] . $categorycode[0] . $fiscalyear[1];



        $query = mysqli_query($conn, "INSERT INTO beneficiaries(name,business_name,gender,email,contactno,category_code,description_code,region_code,district_code,community,educational_level,address,altcontactno,registered_business,ownership_type,establishment_years,longitude,latitude,fiscalyear,dateregistered,registeredby,createdby,datecreated,timeadded)"
                . " VALUES "
                . "('" . mysqli_real_escape_string($conn, $info['beneficiaryName']) . "','" . mysqli_real_escape_string($conn, $info['businessName']) . "',"
                . "'" . mysqli_real_escape_string($conn, $info['gender']) . "','" . mysqli_real_escape_string($conn, $info['email']) . "','" . mysqli_real_escape_string($conn, $info['contactno']) . "',"
                . "'" . mysqli_real_escape_string($conn, $category_code) . "','" . mysqli_real_escape_string($conn, $info['description']) . "','" . mysqli_real_escape_string($conn, $reg_code) . "','" . mysqli_real_escape_string($conn, $info['district']) . "',"
                . "'" . mysqli_real_escape_string($conn, $info['community']) . "','" . mysqli_real_escape_string($conn, $info['educational_level']) . "','" . mysqli_real_escape_string($conn, $info['address']) . "','" . mysqli_real_escape_string($conn, $info['altcontactno']) . "','" . mysqli_real_escape_string($conn, $info['registered_business']) . "','" . mysqli_real_escape_string($conn, $info['ownership_type']) . "','" . mysqli_real_escape_string($conn, $info['establishment_years']) . "',"
                . "'" . mysqli_real_escape_string($conn, $info['longitude']) . "','" . mysqli_real_escape_string($conn, $info['latitude']) . "','" . mysqli_real_escape_string($conn, $info['fiscalYear']) . "',"
                . "'" . mysqli_real_escape_string($conn, $info['dateRegistered']) . "','" . mysqli_real_escape_string($conn, $info['registeredBy']) . "','" . mysqli_real_escape_string($conn, $createdby) . "','" . $datecreated . "','" . time() . "')");

        if ($query) {
            $new_id = mysqli_insert_id($conn);
            $id = str_pad("$new_id", 5, '0', STR_PAD_LEFT);
            $bene_code = $shortcode . $id;

            mysqli_query($conn, "UPDATE beneficiaries SET code='" . $bene_code . "' WHERE beneficiary_id=$new_id");

            if (isset($info['bulkInsert'])) {
                $this->removeBenficiaryTempTable($info['beneficiaryId']);
            }

            $this->response['success'] = '1';
            $this->response['message'] = 'Data saved successfully';

            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }


        $connection->closeConnection($conn);
    }

    public function setRegistrar($registrarInfo) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $createdby = 'admin';
        $datecreated = date("Y-m-d");
        $exists = $this->checkRegistrarExistence($registrarInfo['email']);
        if ($exists > 0) {
            $this->response['success'] = '0';
            $this->response['message'] = 'Registrar already exist ';
            echo json_encode($this->response);
        } else {
            $code = 'REG' . $this->generateuniqueCode(10);
            $query = mysqli_query($conn, "INSERT INTO registers(code,name,email,contactno,createdby)"
                    . " VALUES "
                    . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $registrarInfo['name']) . "','" . mysqli_real_escape_string($conn, $registrarInfo['email']) . "','" . mysqli_real_escape_string($conn, $registrarInfo['contactno']) . "','" . $createdby . "')");

            if ($query) {
                $this->response['success'] = '1';
                $this->response['message'] = 'Data saved successfully';
                echo json_encode($this->response);
            } else {
                $this->response['success'] = '0';
                $this->response['message'] = 'couldnt save' . mysqli_error($conn);
                echo json_encode($this->response);
            }
        }

        $connection->closeConnection($conn);
    }

    private function checkBeneficiaryExistence($email) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE email='" . mysqli_real_escape_string($conn, $email) . "'");

        return mysqli_num_rows($query);

        $connection->closeConnection($conn);
    }

    private function checkRegistrarExistence($email) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM registers WHERE email='" . mysqli_real_escape_string($conn, $email) . "'");

        return mysqli_num_rows($query);

        $connection->closeConnection($conn);
    }

    public function deleteBeneficiary($code) {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE beneficiaries SET active=1 WHERE code='" . mysqli_real_escape_string($conn, $code) . "'");


        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Beneficiary Data deleted successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }

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

    public function getBeneficiaryInfo($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE code='" . $code . "'");

        if (mysqli_num_rows($query) > 0) {

            $feedback = json_encode(mysqli_fetch_assoc($query));
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function upadteBeneficiary($beninfo) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $query = mysqli_query($conn, "UPDATE beneficiaries set name='" . mysqli_real_escape_string($conn, $beninfo['beneficiaryName']) . "',business_name='" . mysqli_real_escape_string($conn, $beninfo['businessName']) . "'"
                . ",educational_level='" . mysqli_real_escape_string($conn, $beninfo['educational_level']) . "'"
                . ",address='" . mysqli_real_escape_string($conn, $beninfo['address']) . "',community='" . mysqli_real_escape_string($conn, $beninfo['community']) . "',"
                . "contactno='" . mysqli_real_escape_string($conn, $beninfo['contactno']) . "',altcontactno='" . mysqli_real_escape_string($conn, $beninfo['altcontactno']) . "'"
                . ",email='" . mysqli_real_escape_string($conn, $beninfo['email']) . "',registered_business='" . mysqli_real_escape_string($conn, $beninfo['registered_business']) . "'"
                . ",ownership_type='" . mysqli_real_escape_string($conn, $beninfo['ownership_type']) . "',establishment_years='" . mysqli_real_escape_string($conn, $beninfo['establishment_years']) . "',"
                . "longitude='" . mysqli_real_escape_string($conn, $beninfo['longitude']) . "',latitude='" . mysqli_real_escape_string($conn, $beninfo['latitude']) . "',dateregistered='" . mysqli_real_escape_string($conn, $beninfo['dateRegistered']) . "',modon=NOW() WHERE code='" . mysqli_real_escape_string($conn, $beninfo['beneficiaryCode']) . "'");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = $beninfo['beneficiaryName'] . ' information updated successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }


        $connection->closeConnection($conn);
    }

    public function removeBenficiaryTempTable($beneficary_id) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the databaseSELECT * FROM region_districts_view WHERE egion_code=
        mysqli_query($conn, "DELETE FROM temp_beneficiaries WHERE beneficiary_id=$beneficary_id");
        $connection->closeConnection($conn);
    }

}

// print_r($info);
//        $fiscalYear = $info['fiscalYear'];
//        $category = $info['category'];
//        $description = $info['description'];
//        $beneficiaryName = $info['beneficiaryName'];
//        $businessName = $info['businessName'];
//        $gender = $info['gender'];
//        $region = $info['region'];
//        $district = $info['district'];
//        $community = $info['community'];
//        $conntactNo = $info['conntactNo'];
//        $email = $info['email'];
//        $longitude = $info['longitude'];
//        $latitude = $info['latitude'];
//        $registeredBy = $info['registeredBy'];
