<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../classes/MapXmlClass.php';
require_once '../classes/MapBenRegLocations.php';


$response = array();

//echo "Check here";
if (isset($_GET['type'])) {

    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'getBeneficiariesLocations') {

            $getData = new MapXmlClass();
            echo $getData->getBeneficiariesLocation();
        } if ($type == 'getBeneficiariesLocationsByRegion') {

            $regcode = $_GET['region'];
          echo  getBeneficiariesLocationByRegion($regcode);
        }
    } else {
        echo 'provide type';
    }
}