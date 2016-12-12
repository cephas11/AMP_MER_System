<?php
require_once 'AppointmentClass.php';

if (isset($_GET['type'])) {

    $type = $_GET['type'];
    if (!empty($type)) {
    
        if ($type == 'retreiveAppointments') {
        //echo 'here is ';
           $getData = new AppointmentClass();
           $getData->getAppointmentList();
    
     }else  if ($type == 'retreiveAppointments') {
       
            $code = $_GET['code'];
            $status = $_GET['status'];

            $getData = new AppointmentClass();
            $getData->updateStatus($code,$status);
    
     }
    } else {
        echo 'provide type';
    }
    }
?>