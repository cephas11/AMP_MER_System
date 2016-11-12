
<?php

require_once '../classes/BeneficiaryClass.php';
if (isset($_POST)) {
$data = stripcslashes($_POST['pTableData']);
// Decode the JSON array
$tableData = json_decode($data,TRUE);
//print_r($tableData);

$saveData = new BeneficiaryClass();
$saveData->setBeneficiaryBulkData($tableData);

}
        
    

