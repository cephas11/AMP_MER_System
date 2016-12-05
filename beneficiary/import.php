<?php
require_once '../classes/BeneficiaryClass.php';

if (isset($_POST["Import"])) {


    $filename = $_FILES["file"]["tmp_name"];

//
    if ($_FILES["file"]["size"] > 0) {
 
        $bulkUpload = new BeneficiaryClass();
        $bulkUpload->bulkbeneficiaryUpload($filename);
     
    }else{
        echo 'Please upload a file';
    }

    
    
            }
?>		