<?php

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path .'/databaseConnectionClass.php';

class ConfigurationClass {

    public $db;
    //put your code here
    var $response = array();

    public function setRegion($name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = 'REG' . $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO region(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Region saved successfully';
            echo json_encode($this->response);
 	 //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getRegion() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
	$query = mysqli_query($conn, "SELECT * FROM region");
        
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

    public function setDistrict($name) {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = 'DST' . $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO districts(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'District saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getDistricts() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, " SELECT * FROM districts ");
        //print_r($query);
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

    public function getUnAssignedDistricts() {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_districts_view");

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

    public function setRegionDistricts($region, $districts) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

       
        if (sizeof($districts) > 0) {
            foreach ($districts as $district) {
                 $code = $this->generateuniqueCode(8);
                $query = mysqli_query($conn, "INSERT INTO region_districts(code,districts_code,region_code) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $district) . "','" . mysqli_real_escape_string($conn, $region) . "')");
          
              //  echo  "INSERT INTO region_districts(code,districts_code,region_code) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $district) . "','" . mysqli_real_escape_string($conn, $region) . "')";
                
            }
        }

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Districts Assigned to region  successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt assign' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getRegionDistricts() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM region_districts_view");

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

    public function setCategory($name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO categories(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Category saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
    }


    public function getCategories() {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM categories");

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

    public function setDescription($name) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO description(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Description saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
    }

    public function getDescription() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM description");

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

    public function getUnAssignedDescription() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_descriptions_view");

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

    public function setCategoryDescription($category,$descriptions) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

       
        if (sizeof($descriptions) > 0) {
            foreach ($descriptions as $desc) {
                 $code = $this->generateuniqueCode(8);
                $query = mysqli_query($conn, "INSERT INTO description_categories(code,description_code,category_code) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $desc) . "','" . mysqli_real_escape_string($conn, $category) . "')");
            }
        }

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Descriptions Assigned to category successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt assign' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getCategoryDescriptions() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM description_categories_view");

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
    
    
    public function getDistrictsBasedOnRegion($regionCode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM region_districts_view WHERE region_code='".$regionCode."'");

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
    
    
      public function getDescriptionsBasedOnCategory($categoryCode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM description_categories_view WHERE category_code='".$categoryCode."'");

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
    
     public function getRegisters() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM registers");

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

?>
