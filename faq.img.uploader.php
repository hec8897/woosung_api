<?php
$data = json_decode(file_get_contents("php://input"),true);
$mode = $_POST['mode'];
function FileUploader($files){
// File name
  $filename = $files['name'];
  $time = date('YmdHis');

  // Valid file extensions
  $valid_extensions = array("jpg","jpeg","png","gif");

  // File extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

// Check extension
  if(in_array(strtolower($extension),$valid_extensions) ) {
    $newFileName = $time.$filename;
    move_uploaded_file($files['tmp_name'], "upload_faq/".$newFileName);
  }

  return $newFileName;
  }
  $NewfileName = FileUploader($_FILES['image']);
  $fileRoute = isset($_FILES['image'])?"../woosung_api/upload_faq/".$NewfileName:"";

  $Data= json_encode([
            "url"=>$fileRoute,
            "img"=>$NewfileName,
        ]);

echo urldecode($Data);
include("conn/header.php");

?>