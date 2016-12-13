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
        $category = '"' . implode('","', $catcode) . '"';

        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE region_code='" . $regcode . "' AND  category_code IN (" . $category . ") AND active=0 ");
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

//       public function getBeneficiaries($regcode, $catcode) {
//        $connection = new databaseConnection(); //i created a new object
//        $conn = $connection->connectToDatabase(); // connected to the database
//        $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE region_code='" . $regcode . "' AND  category_code='" . $catcode . "' AND active=0 ");
//
//        $response["data"] = array();
//
//        $i = 0;
//
//        if (mysqli_num_rows($query) > 0) {
//            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
//                $sample = array();
//                $sample[0] = $row['beneficiary_id'];
//                $sample[1] = $row['code'];
//                $sample[2] = $row['name'];
//                $sample[3] = $row['gender'];
//                $sample[4] = $row['email'];
//                $sample[5] = $row['contactno'];
//                $sample[6] = $row['district_name'];
//                $response["data"][$i] = $sample;
//
//                $i = $i + 1;
//            }
//            echo json_encode($response);
//        } else {
//
//            echo $feedback = json_encode($this->response);
//        }
//
//
//        $connection->closeConnection($conn);
//    }
//    
    public function getUnAssignedBeneficiaries($regcode, $catcode) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM unassigned_beneficiaries_view WHERE region_code='" . $regcode . "' AND  category_code='" . $catcode . "'");

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

    public function setSalesTracker($fiscalYear,$activity_date, $beneficiary_code, $commodity, $valueUsd, $valueTonnes) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdby = 'admin';
        $code = 'ACT' . $this->generateuniqueCode(10);



        $query = mysqli_query($conn, "INSERT INTO sales_tracker(code,fiscalYear,salesdate,beneficiary_code,commodity,value_usd,value_tonnes,createdby)"
                . " VALUES "
                . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $fiscalYear) . "','" . mysqli_real_escape_string($conn, $activity_date) . "','" . mysqli_real_escape_string($conn, $beneficiary_code) . "',"
                . "'" . mysqli_real_escape_string($conn, $commodity) . "','" . mysqli_real_escape_string($conn, $valueUsd) . "','" . mysqli_real_escape_string($conn, $valueTonnes) . "','" . mysqli_real_escape_string($conn, $createdby) . "')");


        if ($query) {

            $this->response['success'] = '1';
            $this->response['message'] = 'New Sales Tracker  Added';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt add' . mysqli_error($conn);
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

    public function getCompletionToolActivityList() {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM activity_completion_tool_view WHERE status=0");
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

    public function getCompletionToolActivity($activity_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM activity_completion_tool_view WHERE code='" . $activity_code . "'");
        //print("Hello here");
        if (mysqli_num_rows($query) > 0) {

            $feedback = json_encode(mysqli_fetch_assoc($query));
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function getActivityParticipants($activity_code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM activity_participants_view WHERE activity_code='" . $activity_code . "'");



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

    public function getBeneficiarySales($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM sales_tracker WHERE beneficiary_code='" . $code . "'");
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

    public function setFinancialTracker($beneficiary_code, $beneficiaryType, $financialType, $purposeLoan, $disbursedAmount, $disbursementDate, $repaidAmount, $repaymentDate, $amountOustanding, $grantPurpose) {


        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdby = 'admin';
        $code = 'FIN' . $this->generateuniqueCode(10);

        if ($financialType == "Loan") {
            $query = mysqli_query($conn, "INSERT INTO financial_services_tracker(code,beneficiary_code,beneficiary_type,financial_type,loan_purpose,amount_disbursed,disbursement_date,amount_paid,amount_outstanding,repayment_date,createdby)"
                    . " VALUES "
                    . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $beneficiary_code) . "','" . mysqli_real_escape_string($conn, $beneficiaryType) . "',"
                    . "'" . mysqli_real_escape_string($conn, $financialType) . "','" . mysqli_real_escape_string($conn, $purposeLoan) . "','" . mysqli_real_escape_string($conn, $disbursedAmount) . "','" . mysqli_real_escape_string($conn, $disbursementDate) . "',"
                    . "'" . mysqli_real_escape_string($conn, $repaidAmount) . "','" . mysqli_real_escape_string($conn, $amountOustanding) . "','" . mysqli_real_escape_string($conn, $repaymentDate) . "','" . mysqli_real_escape_string($conn, $createdby) . "')");
        } else {
            $query = mysqli_query($conn, "INSERT INTO financial_services_tracker(code,beneficiary_code,beneficiary_type,financial_type,grant_purpose,amount_disbursed,disbursement_date,createdby)"
                    . " VALUES "
                    . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $beneficiary_code) . "','" . mysqli_real_escape_string($conn, $beneficiaryType) . "',"
                    . "'" . mysqli_real_escape_string($conn, $financialType) . "','" . mysqli_real_escape_string($conn, $grantPurpose) . "','" . mysqli_real_escape_string($conn, $disbursedAmount) . "','" . mysqli_real_escape_string($conn, $disbursementDate) . "',"
                    . "'" . mysqli_real_escape_string($conn, $createdby) . "')");
        }


        if ($query) {

            $this->response['success'] = '1';
            $this->response['message'] = ' Saved Sucessfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt add' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getBeneficiaryFinances($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM financial_services_tracker WHERE beneficiary_code='" . $code . "'");
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

    public function deleteSale($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "DELETE FROM sales_tracker  WHERE code='" . $code . "'");

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

    public function deleteFinance($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "DELETE FROM financial_services_tracker  WHERE code='" . $code . "'");

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

    public function deleteTempBeneficiary($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "DELETE FROM temp_beneficiaries  WHERE beneficiary_id='" . $code . "'");

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

    public function getFinanceInfo($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM financial_services_tracker WHERE code='" . $code . "'");

        if (mysqli_num_rows($query) > 0) {

            $feedback = json_encode(mysqli_fetch_assoc($query));
            //  $query->close();
        } else {

            $feedback = json_encode($this->response);
        }

        echo $feedback;
        $connection->closeConnection($conn);
    }

    public function deleteCompletionActivity($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        //  $query = mysqli_query($conn, "UPDATE region_districts SET active = 1 WHERE code='" . $code . "'");
        $query = mysqli_query($conn, "UPDATE completion_tool_activity SET status = 1 WHERE code='" . $code . "'");

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

    public function setAdoptionTracker($beneficiary_code, $applied, $technique) {

        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $createdby = 'admin';
        $code = 'ADP' . $this->generateuniqueCode(10);

        $techniques = implode(', ', $technique);
        $query = mysqli_query($conn, "INSERT INTO adoption_tracker(code,beneficiary_code,applied,technique,createdby)"
                . " VALUES "
                . "('" . trim($code) . "','" . mysqli_real_escape_string($conn, $beneficiary_code) . "','" . mysqli_real_escape_string($conn, $applied) . "',"
                . "'" . mysqli_real_escape_string($conn, $techniques) . "','" . mysqli_real_escape_string($conn, $createdby) . "')");



        if ($query) {

            $this->response['success'] = '1';
            $this->response['message'] = ' Saved Sucessfully';
            echo json_encode($this->response);
        } else {
            $this->response['success'] = '0';
            $this->response['message'] = 'couldnt add' . mysqli_error($conn);
            echo json_encode($this->response);
        }
        $connection->closeConnection($conn);
    }

    public function getAdoptionTracker($code) {
        $connection = new databaseConnection(); //i created a new object
        $conn = $connection->connectToDatabase(); // connected to the database
        $query = mysqli_query($conn, "SELECT * FROM adoption_tracker WHERE beneficiary_code='" . $code . "'");

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

    public function buildSqlInClauseFromCsv($csv) {
        return "in ('" . str_replace(",", "','", $csv) . "') ";
    }

}
