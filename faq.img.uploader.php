<?php
$data = json_decode(file_get_contents("php://input"),true);
$mode = $_POST['mode'];
function FileUploader($files){
// File name
  $filename = $files['name'];

  // Valid file extensions
  $valid_extensions = array("jpg","jpeg","png","pdf","docx","hwp","xls","xlsx","ppt","pptx");

  // File extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

// Check extension
if(in_array(strtolower($extension),$valid_extensions) ) {
 // Upload file
 if(move_uploaded_file($files['tmp_name'], "upload_faq/".$filename)){
 }else{
 }
  }else{
  }
  return $filename;
  }

  $fileRoute = isset($_FILES['image'])?"../woosung_api/upload_faq/".FileUploader($_FILES['image']):"";
  $Data= json_encode([
    "url"=>$fileRoute,
    "test"=>$_POST
]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>