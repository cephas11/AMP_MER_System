<?php

if (session_status() == PHP_SESSION_NONE) {
    ob_start();
    session_start();
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = $_SERVER['DOCUMENT_ROOT'] . "/AMP_MER_System";
require_once $path . '/databaseConnectionClass.php';
require_once $path . '/classes/AuditClass.php';

header("Content-type: text/xml");

// Start XML file, echo parent node





function getBeneficiariesLocationByRegion($regcode) {

    $connection = new databaseConnection(); //i created a new object
    $conn = $connection->connectToDatabase(); // connected to the database

    $query = mysqli_query($conn, "SELECT * FROM beneficiaries_view WHERE active = 0 AND region_code='" . $regcode . "'");



    if (mysqli_num_rows($query) > 0) {
        echo '<markers>';
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            echo '<marker ';
            echo 'name="' . parseToXML($row['name']) . '" ';
            echo 'address="' . parseToXML($row['address']) . '" ';
            echo 'lat="' . $row['latitude'] . '" ';
            echo 'lng="' . $row['longitude'] . '" ';
            echo 'region="' . $row['region_name'] . '" ';
            echo 'district="' . $row['district_name'] . '" ';
            echo 'description="' . $row['description_name'] . '" ';
            echo 'category="' . $row['category_name'] . '" ';

            echo '/>';
        }
        echo '</markers>';
    }
}

function parseToXML($htmlStr) {
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}
