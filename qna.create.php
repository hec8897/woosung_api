<?php
//insert x update o delete o
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$mode = $data['mode'];
$idx = $data['no'];
//update , delete
if($mode == 'update'){
    $status = $data['status'];
    $answer = $data['recive'];
    $sql = "UPDATE `woosung_web`.`tb_qna` SET `answer` = '$answer', `status` = '$status' WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}
else if($mode ="insert"){
    $contact = $data['contact'];
    $tit = $data['tit'];
    $write = $data['write'];
    $desc = $data['desc'];
    $private = $data['private'] == ""?0:1;
    $password = $data['password'];

    $cate = $data['cate'];

    $sql = "INSERT INTO `woosung_web`.`tb_qna` 
    (`cate`, `tit`, `writer`, `desc`, `private`, `contact`,`password`,`date`,`status`) 
    VALUES ('$cate', '$tit', '$write', '$desc', '$private', '$contact','$password','$date','답변대기')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'delete'){
    $sql = "DELETE FROM `woosung_web`.`tb_qna` WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
    "phpResult"=>$phpResult,
]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>