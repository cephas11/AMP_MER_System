<?php

require_once '../classes/ActivityClass.php';
$response = array();
if (isset($_GET['type'])) {
//echo "Check here";
    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'getBeneficiaries') {
            $regcode = $_GET['regcode'];
            $catcode = $_GET['catcode'];
            $getBeneficiary = new ActivityClass();
            $getBeneficiary->getBeneficiaries($regcode,$catcode);
        }
    } else {
        echo 'provide type';
    }
}

