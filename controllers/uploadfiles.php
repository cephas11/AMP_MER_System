<?php

$data = array();
echo 'welcome';

//echo json_encode($data);
if (isset($_POST)) {

    // $id =$_POST['id'];
    //

 $file_path = "../files/";

    $ext = getExtension($name);
    $file_name = time() . '.' . $ext;
    // $file_path = $file_path . time() . basename($_FILES['file']['name']);
    $file_path = $file_path . $file_name;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {

        $response['message'] = "  save image";

        $response['success'] = 0;

        echo json_encode($response);
    } else {

        $response['message'] = "Unable to save image";

        $response['success'] = 0;

        echo json_encode($response);
    }
} else {

    $response['message'] = "Provide all parameters image";

    $response['success'] = 0;

    echo json_encode($response);
}

function getExtension($str) {
    $i = strrpos($str, ".");
    if (!$i) {
        return"";
    }$l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
}
