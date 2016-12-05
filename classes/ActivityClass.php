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

    public function getBeneficiaries($regcode, $catcode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE region_code='" . $regcode . "' AND  category_code='" . $catcode . "' ");

        $response["data"] = array();

        $i = 0;

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $sample = array();
                $sample[0] = $row['beneficiary_id'];
                $sample[1] = $row['code'];
                $sample[2] = $row['name'];
                $sample[3] = $row['gender'];
                $sample[4] = $row['email'];
                $sample[5] = $row['contactno'];
                $sample[6] = $row['district_name'];
                $response["data"][$i] = $sample;

                $i = $i + 1;
            }
            echo json_encode($response);
        } else {

            echo $feedback = json_encode($this->response);
        }


        $connection->closeConnection($conn);
    }

    public function setCompletionToolActivity($activity_date, $type, $description, $category, $region, $district, $community, $implementer, $male, $female, $total, $url, $participants, $typeofactivity) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdby = 'admin';
        $code = 'ACT' . $this->generateuniqueCode(10);

        // $participants;
        $beneficiaries = array_values($participants)[0];
        $beneficiaries = preg_replace('/\.$/', '', $beneficiaries); //Remove dot at end if exists
        $array = explode(',', $beneficiaries); //split string into array seperated by ', '

       
        $query = mysqli_query($conn, "INSERT INTO completion_tool_activity(code,activity_date,type,description,category,region,district,community,implementer,male,female,total,url,createdby)"
                . " VALUES "
                . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $activity_date) . "','" . mysqli_real_escape_string($conn, $type) . "',"
                . "'" . mysqli_real_escape_string($conn, $description) . "','" . mysqli_real_escape_string($conn, $category) . "','" . mysqli_real_escape_string($conn, $region) . "',"
                . "'" . mysqli_real_escape_string($conn, $district) . "','" . mysqli_real_escape_string($conn, $community) . "','" . mysqli_real_escape_string($conn, $implementer) . "','" . mysqli_real_escape_string($conn, $male) . "',"
                . "'" . mysqli_real_escape_string($conn, $female) . "','" . mysqli_real_escape_string($conn, $total) . "','" . mysqli_real_escape_string($conn, $url) . "','" . mysqli_real_escape_string($conn, $createdby) . "')");


        if ($query) {
            $activity_code = $code;
            foreach ($array as $value) { //loop over values
                $this->setActivityParticipants($activity_code, $typeofactivity, $value);
            }
            $this->response['success'] = '1';
            $this->response['message'] = 'New Activity  Added';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt add' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function setActivityParticipants($activity_code, $activity_type, $particpant_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database

        $code = $this->generateuniqueCode(10);
        mysqli_query($conn, "INSERT INTO activity_participants(code,activity_code,activity_type,participant_code)"
                . " VALUES "
                . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $activity_code) . "','" . mysqli_real_escape_string($conn, $activity_type) . "','" . mysqli_real_escape_string($conn, $particpant_code) . "')");

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
