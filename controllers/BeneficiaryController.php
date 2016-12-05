<?php

require_once '../classes/BeneficiaryClass.php';
require_once '../classes/ActivityClass.php';
$response = array();

if (isset($_GET['type'])) {
//echo "Check here";
    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'retreiveDescriptionBasedOnCategory') {
            if (isset($_GET['category_code'])) {
                $category_code = $_GET['category_code'];
                $getDescriptionBasedOnCategory = new BeneficiaryClass();
                $getDescriptionBasedOnCategory->getDescriptionBasedOnCategory($category_code);
            }
        } else if ($type == 'retreiveDistrictsBasedOnRegion') {
            if (isset($_GET['district_code'])) {
                $district_code = $_GET['district_code'];
                $getDistrictsBasedOnRegion = new BeneficiaryClass();
                $getDistrictsBasedOnRegion->getDistrictsBasedOnRegion($district_code);
            }
        } else if ($type == 'retreiveBeneficiaryTempData') {

            $getTempData = new BeneficiaryClass();
            $getTempData->getBeneficiaryFileContents();
        } else if ($type == 'retreiveBeneficiariesList') {

            $getTempData = new BeneficiaryClass();
            $getTempData->getBeneficiaresList();
        } else if ($type == 'clearTempData') {
            $clearData = new BeneficiaryClass();
            $clearData->emptyBenficiaryTempTable();
            echo '1';
        } else if ($type == 'getBeneficiaries') {
            $regcode = $_GET['regcode'];
            $catcode = $_GET['catcode'];
            $getBeneficiary = new ActivityClass();
            $getBeneficiary->getBeneficiaries($regcode, $catcode);
        }
    } else {
        echo 'provide type';
    }
}
