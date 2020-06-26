<?php
include("conn/conn.php");
include("inc/file_uploader.php");
$data = json_decode(file_get_contents("php://input"),true);
$mode = $data['mode'];
$idx = $data['no'];

$title = $data['title'];
$desc = $data['desc'];
$cate = $data['cate'];
$private = $data['private'];
$youtubeId = $data['youtubeId'];

if($mode == 'insert'){
    $sql = "INSERT INTO `woosung_web`.`youtube_data` 
    (`title`, `cate`, `desc`, `date`, `private`, `youtubeId`) VALUES 
    ('$title', '$cate', '$desc', '$date', '$private','$youtubeId')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'update'){
    $sql = "UPDATE `woosung_web`.`youtube_data` SET `title` = '$title', 
    `cate` = '$cate', `desc` = '$desc', `private` = '$private', `youtubeId` = '$youtubeId'
    WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'delete'){
    $sql = "DELETE FROM `woosung_web`.`youtube_data` WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}

$phpResult = isset($query)?"ok":"no";

$Data = json_encode([
    "phpResult"=>$phpResult,
]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');
?>