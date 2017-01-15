<?php

require_once '../classes/BeneficiaryClass.php';
require_once '../classes/ConfigurationClass.php';
require_once '../classes/ActivityClass.php';
require_once '../classes/AccountClass.php';
$response = array();
if (isset($_REQUEST['type'])) {
//echo "Check here";
    $type = $_REQUEST['type'];
    if (!empty($type)) {
        if ($type == 'deleteBeneficiary') {
            $code = $_REQUEST['code'];
            $deleteBeneficiary = new BeneficiaryClass();
            $deleteBeneficiary->deleteBeneficiary($code);
        }else if ($type == 'deleteRegion') {
            $code = $_REQUEST['code'];
           $deleteRegion = new ConfigurationClass();
           $deleteRegion->deleteRegion($code);
        }else if ($type == 'deleteDistrict') {
            $code = $_REQUEST['districtcode'];
           $deleteDistrict = new ConfigurationClass();
           $deleteDistrict->deleteDistrict($code);
        }else if ($type == 'deleteRegionDistrict') {
            $code = $_REQUEST['code'];
           $deleteDistrict = new ConfigurationClass();
           $deleteDistrict->deleteRegionDistricts($code);
        }else if ($type == 'deleteCategory') {
            $code = $_REQUEST['code'];
           $deleteCategory = new ConfigurationClass();
           $deleteCategory->deleteCategory($code);
        }else if ($type == 'deleteDescription') {
            $code = $_REQUEST['code'];
           $deleteDescription = new ConfigurationClass();
           $deleteDescription->deleteDescription($code);
        }else if ($type == 'deleteDescriptionCategory') {
            $code = $_REQUEST['code'];
           $deleteCategoryDescription = new ConfigurationClass();
           $deleteCategoryDescription->deleteCategoryDescriptions($code);
        }else if ($type == 'deleteRegistrar') {
            $code = $_REQUEST['code'];
           $deleteRegistrar = new ConfigurationClass();
           $deleteRegistrar->deleteRegistrar($code);
        }else if ($type == 'deleteActivityType') {
            $code = $_REQUEST['code'];
           
            $deleteType = new ConfigurationClass();
           $deleteType->deleteActivityType($code);
        }else if ($type == 'deleteActivityDescription') {
            $code = $_REQUEST['code'];
           
            $delete = new ConfigurationClass();
           $delete->deleteActivityDesc($code);
        }else if ($type == 'deleteActivityTypeDescription') {
            $code = $_REQUEST['code'];
           
            $delete = new ConfigurationClass();
           $delete->deleteActivityTypeDescription($code);
        }else if ($type == 'deleteCompletionActivity') {
            $code = $_REQUEST['code'];
           
            $delete = new ActivityClass();
           $delete->deleteCompletionActivity($code);
        }else if ($type == 'deleteSale') {
            $code = $_REQUEST['code'];
           
            $delete = new ActivityClass();
           $delete->deleteSale($code);
        }else if ($type == 'deleteFinace') {
            $code = $_REQUEST['code'];
           
            $delete = new ActivityClass();
           $delete->deleteFinance($code);
        }else if ($type == 'deleteBeneficiaryTemp') {
            $code = $_REQUEST['beneficiaryId'];
           
            $delete = new ActivityClass();
           $delete->deleteTempBeneficiary($code);
        }else if ($type == 'deleteUserGroup') {
            $id = $_REQUEST['usergroupid'];
           
            $delete = new AccountClass();
           $delete->deleteUserGroup($id);
        }else if ($type == 'deleteCommodity') {
            $id = $_REQUEST['code'];
           
            $delete = new ConfigurationClass();
           $delete->deleteCommodity($id);
        }else if ($type == 'deleteUser') {
            $id = $_REQUEST['userid'];
           
            $delete = new AccountClass();
           $delete->deleteUser($id);
        }else if ($type == 'deleteEmploymentType') {
            $id = $_REQUEST['code'];  
            $delete = new ConfigurationClass();
           $delete->deleteEmplomentType($id);
        }
    } else {
        echo 'provide type';
    }
}

