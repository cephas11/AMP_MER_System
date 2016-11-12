<?php

require_once '../classes/ConfigurationClass.php';
$response = array();
//echo "Check here";
if (isset($_GET['type'])) {
//echo "Check here";
    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'saveRegion') {
            if (isset($_GET['region'])) {
                
                $name = $_GET['region'];
                $new_region = new ConfigurationClass();
                $new_region->setRegion($name);
            }
        } else if ($type == 'retreiveRegion') {
            $getAllregions = new ConfigurationClass();
            $getAllregions->getRegion();
        } else if ($type == 'saveDistrict') {

            if (isset($_GET['district'])) {
                $name = $_GET['district'];

                $new_district = new ConfigurationClass();
                $new_district->setDistrict($name);
            }
        } else if ($type == 'retreiveDistrict') {

            $getdistricts = new ConfigurationClass();
            $alldistricts = $getdistricts->getDistricts();
        } else if ($type == 'retreiveUnAssignedDistricts') {

            $getUnassigneddistricts = new ConfigurationClass();
            $getUnassigneddistricts->getUnAssignedDistricts();
        }  else if ($type == 'retreiveRegionDistricts') {

            $getregiondistricts = new ConfigurationClass();
            $getregiondistricts->getRegionDistricts();
        } else if ($type == 'saveCategory') {
            if (isset($_GET['category'])) {

                $category = $_GET['category'];

                $save_new = new ConfigurationClass();
                $save_new->setCategory($category);
            }
        } else if ($type == 'retreiveCategories') {

            $getcategories = new ConfigurationClass();
            $getcategories->getCategories();
        } else if ($type == 'saveDescription') {
            if (isset($_GET['description'])) {

                $description = $_GET['description'];

                $save_new = new ConfigurationClass();
                $save_new->setDescription($description);
            }
        } else if ($type == 'retreiveDescription') {

            $getdescription = new ConfigurationClass();
            $getdescription->getDescription();
        } else if ($type == 'retreiveUnAssignedDescription') {

            $getUnassigneddescription = new ConfigurationClass();
            $getUnassigneddescription->getUnAssignedDescription();
        }else if ($type == 'retreiveCategoryDescriptions') {
            $getCategoryDescription = new ConfigurationClass();
            $getCategoryDescription->getCategoryDescriptions();
            
        }else if ($type == 'retreiveDistrictsBasedOnRegion') {
              $region_code = $_GET['region_code'];
            $getDistrictsBasedOnRegion = new ConfigurationClass();
            $getDistrictsBasedOnRegion->getDistrictsBasedOnRegion($region_code);
            
        }else if ($type == 'retreiveDescriptionBasedOnCategory') {
              $category_code = $_GET['category_code'];
            $getDescriptionBasedOnCategory = new ConfigurationClass();
            $getDescriptionBasedOnCategory->getDescriptionsBasedOnCategory($category_code);
            
        }
    } else {
        echo 'provide type';
    }
}

