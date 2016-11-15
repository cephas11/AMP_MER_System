<?php

require_once '../classes/BeneficiaryClass.php';
$response = array();
echo 'flk';
if (isset($_POST['type'])) {
//echo "Check here";
    $type = $_POST['type'];
    if (!empty($type)) {
        if ($type == 'saveBeneficiary') {
            echo 'gooof';
        }
    } else {
        echo 'provide type';
    }
}

