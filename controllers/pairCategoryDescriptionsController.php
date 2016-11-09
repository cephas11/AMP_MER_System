<?php

require_once '../classes/ConfigurationClass.php';
$response = array();

if (isset($_POST['category'])) {
//echo "Check here";
    $type = $_POST['type'];
     if (!empty($type)) {
       if ($type == 'saveCategoryDescriptions') {
            

                $category = $_POST['category'];
                $descriptions = $_POST['descriptions'];

                $save_new = new ConfigurationClass();
                $save_new->setCategoryDescription($category, $descriptions);
            
        }
        
    } else {
       echo 'provide type';
       array_push($response,'provide type');
    }
}


//echo json_encode($response);
