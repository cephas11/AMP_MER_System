<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../classes/DashboardClass.php';

$response = array();

//echo "Check here";
if (isset($_GET['type'])) {

    $type = $_GET['type'];
    if (!empty($type)) {
        if ($type == 'getTotalBeneficiaries') {

            $getData = new DashboardClass();
            $getData->getTotalBeneficiaries();
        } else if ($type == 'getTotalActivitiesCompleted') {

            $getData = new DashboardClass();
            $getData->getTotalActivitiesCompleted();
        }else if ($type == 'getLoanGivenOut') {

            $getData = new DashboardClass();
            $getData->getLoanGivenOut();
        }else if ($type == 'getGrantGivenOut') {

            $getData = new DashboardClass();
            $getData->getGrantGivenOut();
        }else if ($type == 'getRegions') {

            $getData = new DashboardClass();
            $getData->getRegions();
        } else if ($type == 'getBeneficiaryPerRegion') {

            $getData = new DashboardClass();
            $getData->getBeneficiaryPerRegion();
        }else {
            echo 'provide type';
        }
    }
}