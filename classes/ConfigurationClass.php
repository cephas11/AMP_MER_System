<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';




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
        $query = mysqli_query($conn, "SELECT * FROM region WHERE active=0");

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

    public function deleteRegion($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE region SET active = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Region deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
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
        $query = mysqli_query($conn, " SELECT * FROM districts WHERE active=0");
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

    public function deleteDistrict($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE districts SET active = 1 WHERE code='" . $code . "'");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'District nbbn deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getUnAssignedDistricts() {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_districts_view WHERE active=0");

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
        $query = mysqli_query($conn, "SELECT * FROM region_districts_view WHERE active=0");

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

    public function deleteRegionDistricts($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "DELETE FROM region_districts  WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = ' Deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
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
        $query = mysqli_query($conn, "SELECT * FROM categories WHERE active=0");

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

    public function deleteCategory($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE categories SET active = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Category deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
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
        $query = mysqli_query($conn, "SELECT * FROM description WHERE active=0");

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

    public function deleteDescription($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE description SET active = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Description deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getUnAssignedDescription() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_descriptions_view WHERE active=0");

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

    public function setCategoryDescription($category, $descriptions) {
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

    public function deleteCategoryDescriptions($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE description_categories SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "DELETE FROM description_categories  WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = ' Deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getDistrictsBasedOnRegion($regionCode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM region_districts_view WHERE region_code='" . $regionCode . "'");

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
        $query = mysqli_query($conn, "SELECT * FROM description_categories_view WHERE category_code='" . $categoryCode . "'");

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
        $query = mysqli_query($conn, "SELECT * FROM registers WHERE active=0");

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

    public function deleteRegistrar($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE registers SET active=1  WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = ' Register deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
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

    public function setActivityType($type) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO activity_types(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $type) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Activity Type saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
    }

    public function getActivityTypes() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM activity_types WHERE status=0");

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

    public function deleteActivityType($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE activity_types SET status = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = ' Activity Type deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function setActivityDescription($type) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = $this->generateuniqueCode(8);
        $query = mysqli_query($conn, "INSERT INTO activity_description(code,name) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $type) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Activity Description saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
    }

    public function getActivityDescriptions() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM activity_description WHERE status=0");

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

    public function deleteActivityDesc($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE activity_description SET status = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = ' Activity Description deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getUnAssignedActivityDescriptionType() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_activity_descriptions_view WHERE status=0");

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

    public function setActivityTpeDescription($type, $description) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database


        if (sizeof($description) > 0) {
            foreach ($description as $desc) {
                $code = $this->generateuniqueCode(8);
                $query = mysqli_query($conn, "INSERT INTO activity_description_types(code,description_code,type_code) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $desc) . "','" . mysqli_real_escape_string($conn, $type) . "')");

                //  echo  "INSERT INTO region_districts(code,districts_code,region_code) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $district) . "','" . mysqli_real_escape_string($conn, $region) . "')";
            }
        }

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Activity Types to description  successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt assign' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getActivityDescriptionTypes() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM   description_types_activity_view WHERE status=0");

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

    public function deleteActivityTypeDescription($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE activity_description_types SET status = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Deleted successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getActivityDescriptionBasedOnType($type_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM   description_types_activity_view WHERE type_code='" . $type_code . "' AND status=0");

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

    public function updateFunction($info) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE " . $info['tablename'] . " SET name = '" . mysqli_real_escape_string($conn, $info['name']) . "' WHERE code='" . $info['code'] . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Information Updated successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt update' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function updateRegistrarsInfo($info) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE registers SET name = '" . mysqli_real_escape_string($conn, $info['name']) . "',email = '" . mysqli_real_escape_string($conn, $info['email']) . "',contactno = '" . mysqli_real_escape_string($conn, $info['contactno']) . "' WHERE code='" . $info['code'] . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = $info['name'] . ' Information Updated successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt update' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function setCommodity($name) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = 'COM' . $this->generateuniqueCode(8);
        
        $query = mysqli_query($conn, "INSERT INTO commodites(code,name,createdby) VALUES ('" . trim($code) . "','" . mysqli_real_escape_string($conn, $name) . "','".$_SESSION['meruserid']."')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Commodity saved successfully';
            echo json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getCommodities() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM commodites WHERE active=0");

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

    
     public function deleteCommodity($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "UPDATE commodites SET active = 1 WHERE code='" . $code . "'");

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Commodity deleted successfully';
            $feedback= json_encode($this->response);
            //   $query->close();
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt delete' . mysqli_error($conn);
            $feedback = json_encode($this->response);
        }
        echo $feedback;
        $connection->closeConnection($conn);
    }
}

?>
