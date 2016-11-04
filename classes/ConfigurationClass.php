<?php

require_once '../MysqliDb.php';
require_once '../config.php';

class ConfigurationClass {

    public $db;
    //put your code here
    var $response = array();

    public function setRegion($name) {
        $this->db = $GLOBALS['db'];

        $code = 'REG' . $this->generateuniqueCode() . time();
        $data = Array(
            'code' => $code,
            'name' => $name
        );

        $id = $this->db->insert('region', $data);
        if ($id) {
            $this->response['success'] = '1';
            $this->response['message'] = 'region saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'insert failed:' .$this->db->getLastError();
               echo json_encode($this->response);
        }
    }

    public function getRegion() {

        $this->db = $GLOBALS['db'];

        $regions = $this->db->JsonBuilder()->get('region');
        return $regions;
    }

    public function setDistrict($name) {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();
        $code = 'DST' . $this->generateuniqueCode() . time();
        $query = mysql_query("INSERT INTO districts(code,name) VALUES ('" . trim($code) . "','" . mysql_real_escape_string($name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'District saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysql_error();
            echo json_encode($this->response);
        }
    }

    public function getDistricts() {
        
    }

    public function getUnAssignedDistricts() {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();

        $query = mysql_query("SELECT * FROM unassigned_districts_view");
        if ($query) {
            if (mysql_num_rows($query) > 0) {
                $feedback = $query;
            }
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt retreive regions' . mysql_error();
            echo json_encode($this->response);
        }

        return $feedback;
    }

    public function setRegionDistricts($region, $districts) {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();
        $code = $this->generateuniqueCode(8) . time();
        if (sizeof($districts) > 0) {
            foreach ($districts as $district) {
                $query = mysql_query("INSERT INTO region_districts(code,districts_code,region_code) VALUES ('" . trim($code) . "','" . mysql_real_escape_string($district) . "','" . mysql_real_escape_string($region) . "')");
            }
        }

        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Districts Assigned to region  successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt assign' . mysql_error();
            echo json_encode($this->response);
        }
    }

    public function getRegionDistricts() {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();

        $query = mysql_query("SELECT * FROM region_districts_view");
        if ($query) {
            if (mysql_num_rows($query) > 0) {
                $feedback = $query;
            }
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt retreive regions' . mysql_error();
            echo json_encode($this->response);
        }

        return $feedback;
    }

    public function setCategory($name) {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();
        $code = $this->generateuniqueCode(6) . time();
        $query = mysql_query("INSERT INTO categories(code,name) VALUES ('" . trim($code) . "','" . mysql_real_escape_string($name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Category saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysql_error();
            echo json_encode($this->response);
        }
    }

    public function getCategories() {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();

        $query = mysql_query("SELECT * FROM categories");
        if ($query) {
            if (mysql_num_rows($query) > 0) {
                $feedback = $query;
            }
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt retreive regions' . mysql_error();
            echo json_encode($this->response);
        }

        return $feedback;
    }

    public function setDescription($name) {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();
        $code = $this->generateuniqueCode(6) . time();
        $query = mysql_query("INSERT INTO description(code,name) VALUES ('" . trim($code) . "','" . mysql_real_escape_string($name) . "')");
        if ($query) {
            $this->response['success'] = '1';
            $this->response['message'] = 'Description saved successfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt save' . mysql_error();
            echo json_encode($this->response);
        }
    }

    public function getDescription() {
        $connection = new databaseConnection(); //i created a new object
        $connection->connectToDatabase(); // connected to the database
        $connection->selectDatabase();

        $query = mysql_query("SELECT * FROM description");
        if ($query) {
            if (mysql_num_rows($query) > 0) {
                $feedback = $query;
            }
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt retreive regions' . mysql_error();
            echo json_encode($this->response);
        }

        return $feedback;
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
