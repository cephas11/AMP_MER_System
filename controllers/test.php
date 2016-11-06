<?php

require_once '../classes/ConfigurationClass.php';
$response = array();

if (isset($_POST['type'])) {
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
    }
}

