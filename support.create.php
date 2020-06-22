<?php
include("conn/conn.php");
include("inc/file_uploader.php");
$data = json_decode(file_get_contents("php://input"),true);

$cate = $_POST['cate'];
$title = $_POST['title'];
$desc = $_POST['desc'];
$fixed = $_POST['fixed'];
$active = $_POST['active'];


$file0 = FileUploader($_FILES['file0']);
$file1 = FileUploader($_FILES['file1']);
$file2 = FileUploader($_FILES['file2']);
$file3 = FileUploader($_FILES['file3']);
$file4 = FileUploader($_FILES['file4']);



$Data= json_encode([
    "phpResult"=>$_POST,
    "test"=>$_FILES['file0']
]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');
?>