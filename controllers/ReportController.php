<?php

require_once '../classes/ReportClass.php';
$response = array();
if (isset($_GET['type'])) {
//echo "Check here";
    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'beneficiariesreport') {
            $get = new ReportClass();
            $get->getBeneficiaries($_GET['query']);
        } else if ($type == 'generateActivityReport') {
            $get = new ReportClass();
            $get->getActivityReport();
        } else if ($type == 'generateFinancialReport') {
            $get = new ReportClass();
            $get->getFinancialReport();
        } else if ($type == 'generateSalesReport') {
            $get = new ReportClass();
            $get->getSalesReport();
        } 
    } else {
        echo 'provide type';
    }
}

