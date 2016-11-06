<?php

require_once '../classes/BeneficiaryClass.php';
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
        }
    } else {
        echo 'provide type';
    }
}

