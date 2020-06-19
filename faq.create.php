<?php
//insert x update o delete o
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$mode = $data['mode'];
$idx = $data['no'];
//update , delete
if($mode == 'update'){
    $tit = $data['tit'];
    $desc = $data['desc'];
    $cate = $data['cate'];
    $active = $data['active'];

    $sql = "UPDATE `woosung_web`.`tb_faq` SET `tit` = '$tit', `cate` = '$cate', `active` = '$active', `desc` = '$desc' WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'delete'){
    $sql = "DELETE FROM `woosung_web`.`tb_faq` WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}

else if($mode == 'insert'){
    $tit = $data['tit'];
    $desc = $data['desc'];
    $cate = $data['cate'];
    $active = $data['active'];

    $sql = "INSERT INTO `woosung_web`.`tb_faq` 
    (`tit`, `cate`, `desc`, `date`, `order_no`, `active`) VALUES 
    ('$tit', '$cate', '$desc', '$date', '0', '$active')";
    $query =  mysqli_query($conn,$sql);

}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
    "phpResult"=>$phpResult,
    "test"=>$sql
]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>