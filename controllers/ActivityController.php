<?php

require_once '../classes/ActivityClass.php';

$response = array();
if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
//echo "Check here";
    $type = $_POST['type'];
    if (!empty($type)) {
        if ($type == 'completionTool') {
            $file_path = "../files/";
            $ext = getExtension(basename($_FILES['file']['name']));
            $file_name = time() . '.' . $ext;
            $file_path = $file_path . $file_name;

            $activity_date = $_POST['activityDate'];
            $type = $_POST['activityType'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $region = $_POST['region'];
            $district = $_POST['district'];
            $community = $_POST['community'];
            $implementer = $_POST['activityImplementer'];
            $male = $_POST['maleParticipants'];
            $female = $_POST['femaleParticipants'];
            $total = $_POST['totalParticipants'];
            $url = $file_name;
            $participants = $_POST['participants'];
            $typeofactivity = 'compleion tool';

            if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {

                $save_new = new ActivityClass();
                $save_new->setCompletionToolActivity($activity_date, $type, $description, $category, $region, $district, $community, $implementer, $male, $female, $total, $url, $participants, $typeofactivity);
            } else {

                $response['message'] = "Unable to upload  attached file";

                $response['success'] = 0;

                echo json_encode($response);
            }
        } else if ($type = "retreiveCompletionToolActivity") {
            $retreiveList = new ActivityClass();
            $retreiveList->getCompletionToolActivityList();
        }else if ($type = "retreiveActivityInfo") {
            $activity_code = $_POST['activity_code'];
            $retreiveList = new ActivityClass();
            $retreiveList->getCompletionToolActivity($activity_code);
        }
    } else {
        echo 'provide type';
    }
}

function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return"";
    }$l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}
