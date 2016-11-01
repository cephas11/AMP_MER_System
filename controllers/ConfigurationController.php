<?php

require_once '../classes/ConfigurationClass.php';
$response = array();
if (isset($_POST['type'])) {
    $type = $_POST['type'];

    if (!empty($type)) {
        if ($type == 'saveRegion') {
            if (isset($_POST['region'])) {
                $name = $_POST['region'];
                $new_region = new ConfigurationClass();
                echo $new_region->setRegion($name);
            }
        } else if ($type == 'retreiveRegion') {

            $getregion = new ConfigurationClass();
            $allregions = $getregion->getRegion();
            while ($row = mysql_fetch_assoc($allregions)) {
                $response[] = $row;
            }
            echo json_encode($response);
        } else if ($type == 'saveDistrict') {

            if (isset($_POST['district'])) {
                $name = $_POST['district'];
                $new_district = new ConfigurationClass();
                echo $new_district->setDistrict($name);
            }
        } else if ($type == 'retreiveDistrict') {

            $getdistricts = new ConfigurationClass();
            $alldistricts = $getdistricts->getDistricts();
            while ($row = mysql_fetch_assoc($alldistricts)) {
                $response[] = $row;
            }
            echo json_encode($response);
        } else if ($type == 'retreiveUnAssignedDistricts') {

            $getdistricts = new ConfigurationClass();
            $alldistricts = $getdistricts->getUnAssignedDistricts();
            while ($row = mysql_fetch_assoc($alldistricts)) {
                $response[] = $row;
            }
            echo json_encode($response);
        } else if ($type == 'saveRegionDistricts') {

            if (isset($_POST['regiondistrict'])) {

                $region = $_POST['region'];
                $districts = $_POST['districts'];
                $save_new = new ConfigurationClass();
                echo $save_new->setRegionDistricts($region, $districts);
            }
        } else if ($type == 'retreiveRegionDistricts') {

            $getregiondistricts = new ConfigurationClass();
            $allregiondistricts = $getregiondistricts->getRegionDistricts();
            while ($row = mysql_fetch_assoc($allregiondistricts)) {
                $response[] = $row;
            }
            echo json_encode($response);
        } else if ($type == 'saveCategory') {
            if (isset($_POST['category'])) {

                $category = $_POST['category'];
               
                $save_new = new ConfigurationClass();
                echo $save_new->setCategory($category);
            }
        } else if ($type == 'retreiveCategories') {

            $getcategories = new ConfigurationClass();
            $categories = $getcategories->getCategories();
            while ($row = mysql_fetch_assoc($categories)) {
                $response[] = $row;
            }
            echo json_encode($response);
        }
    } else {
        echo 'provide type';
    }
}

    