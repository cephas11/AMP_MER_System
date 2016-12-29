<?php

if (isset($_GET['file'])) {
//$file = $_GET['file'];// Always sanitize your submitted data!!!!!!
//$file = filter_input(INPUT_GET, 'file', FILTER_SANITIZE_ENCODED);//works also
$file = filter_input(INPUT_GET, 'file', FILTER_SANITIZE_SPECIAL_CHARS);
$fileType = pathinfo($file);
$returnType ;
if (file_exists($file) && is_readable($file)) { 

switch ($fileType['extension']) {
case "pdf" :
$returnType = "header('Content-type: application/pdf')";
break;
case "txt":
$returnType ="header('Content-type: text/plain')";
break;
case "html":
$returnType ="header('Content-Type: text/html; charset=utf-8')";
break;
case "htm":
$returnType ="header('Content-Type: text/html; charset=utf-8')";
break;
case "exe":
$returnType ="header('Content-Type: application/octet-stream')";
break;	
case "zip":
$returnType = "header('Content-Type: application/zip') ";	
break;
case "jpg":
$returnType ="header('Content-Type: image/jpeg')";
break;
case "jpeg":
$returnType ="header('Content-Type: image/jpeg')";
break;
case "gif":
$returnType ="header('Content-Type: image/gif')";
break;
case "png":
$returnType ="header('Content-Type: image/png')";
break;	
case "ppt":
$returnType ="header('Content-Type: application/vnd.ms-powerpoint')";
break;
case "xls":
$returnType ="header('Content-Type: application/vnd.ms-excel')";
break;
case "xml":
$returnType = "header('Content-Type: application/vnd.ms-xml') ";		
break;
case "mpeg":
$returnType ="header('Content-Type: audio/mpeg')";
break;
case "swf":
$returnType ="header('Content-Type: text/html; application/x-shockwave-flash')";
break;		
}
echo $returnType ; 
header('Content-Description: File Transfer');
echo $returnType ; 
header("Content-Type: application/force-download");// some browsers need this
header("Content-Disposition: attachment; filename=\"$file\"");
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
exit;
}else {
header("HTTP/1.0 404 Not Found");
echo "<h3>Error 404: File Not Found : <br /><em>$file</em></h3>";
header('Refresh: 5; url=./index.html');
print '<i style="color:red">You will be redirected in 5 seconds</i>';
}
}else {
header('Refresh: 5; url=./index.html');
print '<h1 style="text-align:center">You you shouldn\'t be here ......</h1><br> <p style="color:red"><b>redirection in 5 seconds</b></p>'; 
}




?>