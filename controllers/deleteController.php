<?php

require_once '../classes/BeneficiaryClass.php';
require_once '../classes/ConfigurationClass.php';

$response = array();
if (isset($_REQUEST['type'])) {
//echo "Check here";
    $type = $_REQUEST['type'];
    if (!empty($type)) {
        if ($type == 'deleteBeneficiary') {
            $code = $_REQUEST['code'];
            $deleteBeneficiary = new BeneficiaryClass();
            $deleteBeneficiary->deleteBeneficiary($code);
        }else if ($type == 'deleteRegion') {
            $code = $_REQUEST['code'];
           $deleteRegion = new ConfigurationClass();
           $deleteRegion->deleteRegion($code);
        }
    } else {
        echo 'provide type';
    }
}

