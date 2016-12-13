<?php

require_once '../classes/ActivityClass.php';
require_once '../classes/BeneficiaryClass.php';
$response = array();
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
//echo "Check here";
    $type = $_POST['type'];
    if (!empty($type)) {
        if ($type == 'completionTool') {
            $file_path = "../files/";
            $ext = getExtension(basename($_FILES['file']['name']));
            $file_name = time() . '.' . $ext;
            $file_path = $file_path . $file_name;

            $activity_date = $_POST['activityDate'];
            $type = $_POST['activityType'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $region = $_POST['region'];
            $district = $_POST['district'];
            $community = $_POST['community'];
            $implementer = $_POST['activityImplementer'];
            $male = $_POST['maleParticipants'];
            $female = $_POST['femaleParticipants'];
            $total = $_POST['totalParticipants'];
            $url = $file_name;
            $participants = $_POST['participants'];
            $typeofactivity = 'compleion tool';

            if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {

                $save_new = new ActivityClass();
                $save_new->setCompletionToolActivity($activity_date, $type, $description, $category, $region, $district, $community, $implementer, $male, $female, $total, $url, $participants, $typeofactivity);
            } else {

                $response['message'] = "Unable to upload  attached file";

                $response['success'] = 0;

                echo json_encode($response);
            }
        } else if ($type == "retreiveCompletionToolActivity") {
            $retreiveList = new ActivityClass();
            $retreiveList->getCompletionToolActivityList();
        } else if ($type == "retreiveActivityInfo") {
            $activity_code = $_POST['activity_code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getCompletionToolActivity($activity_code);
        } else if ($type == "retreiveActivityParticipants") {
            $activity_code = $_POST['activity_code'];
            $retreiveList == new ActivityClass();
            $retreiveList->getActivityParticipants($activity_code);
        } else if ($type == "setSalesTracker") {
            //  echo 'here in sales';
            $activity_date = $_POST['activityDate'];
            $beneficiary_code = $_POST['beneficiaryCode'];
            $commodity = $_POST['commodity'];
            $valueUsd = $_POST['salesUSD'];
            $valueTonnes = $_POST['salesTonnes'];
            $setSales = new ActivityClass();
            $setSales->setSalesTracker($activity_date, $beneficiary_code, $commodity, $valueUsd, $valueTonnes);
        } else if ($type == "getBeneficiarySales") {
            $code = $_POST['code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getBeneficiarySales($code);
        } else if ($type == "setFinancialTracker") {
            //  echo 'here in sales';
            $beneficiaryType = $_POST['beneficiaryType'];
            $beneficiary_code = $_POST['beneficiaryCode'];
            $financialType = $_POST['financialType'];
            $purposeLoan = $_POST['loanPurpose'];
            $repaidAmount = $_POST['amountRepaid'];
            $amountOustanding = $_POST['amountOustanding'];
            $grantPurpose = $_POST['grantPurpose'];
            $repaymentDate = $_POST['repaymentDate'];
            if ($financialType == "Loan") {
                $disbursedAmount = $_POST['amountDisbursed'];
                $disbursementDate = $_POST['disbursementDate'];
            } else {
                $disbursedAmount = $_POST['amountDisbursedGrant'];
                $disbursementDate = $_POST['disbursementDateGrant'];
            }


            $new = new ActivityClass();
            $new->setFinancialTracker($beneficiary_code, $beneficiaryType, $financialType, $purposeLoan, $disbursedAmount, $disbursementDate, $repaidAmount, $repaymentDate,$amountOustanding,$grantPurpose);
        } else if ($type == "getBeneficiaryFinances") {
            $code = $_POST['code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getBeneficiaryFinances($code);
        } else if ($type == "getFinanceinfo") {
            $code = $_POST['code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getFinanceInfo($code);
        } else if ($type == "setAdoptionTracker") {
            //  echo 'here in sales';

            $beneficiary_code = $_POST['beneficiaryCode'];
            $applied = $_POST['applied'];
            $techniques = $_POST['techniques'];


            $new = new ActivityClass();
            $new->setAdoptionTracker($beneficiary_code, $applied, $techniques);
        }else if ($type == "getdoptionTracker") {
            $code = $_POST['code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getAdoptionTracker($code);
        }
    } else {
        echo 'provide type';
    }
}

function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return"";
    }$l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}
