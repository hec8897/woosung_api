<?php
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
   if(move_uploaded_file($files['tmp_name'], "upload_support/".$filename)){
      echo 1;
   }else{
      echo 0;
   }
    }else{
    echo 0;
    }
    return $filename;
    }
?>