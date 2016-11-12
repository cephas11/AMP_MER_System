<?php

require_once '../classes/ConfigurationClass.php';
$response = array();

if (isset($_POST['region'])) {
//echo "Check here";
    $type = $_POST['type'];
     if (!empty($type)) {
        if ($type == 'saveRegionDistricts') {
                $region =  $_POST['region'];
                $districts = $_POST['districts'];
                $save_new = new ConfigurationClass();
                $save_new->setRegionDistricts($region, $districts);
            }
        
    } else {
       echo 'provide type';
       array_push($response,'provide type');
    }
}


//echo json_encode($response);
