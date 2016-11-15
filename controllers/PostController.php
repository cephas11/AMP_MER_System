<?php

require_once '../classes/BeneficiaryClass.php';
$response = array();
if (isset($_POST['type'])) {
//echo "Check here";
    $type = $_POST['type'];
    if (!empty($type)) {
        if ($type == 'saveBeneficiary') {
            
            $saveBeneficiary = new BeneficiaryClass();
            $saveBeneficiary->setBeneficiary($_POST);
        }else if ($type == 'saveRegistrar') {
          //  print_r($_POST);
            $saveRegistrar = new BeneficiaryClass();
            $saveRegistrar->setRegistrar($_POST);
        }
    } else {
        echo 'provide type';
    }
}

