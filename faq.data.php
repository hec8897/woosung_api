<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];
$mode = $data['mode'];


if(isset($data['idx'])){
  $sql = "SELECT * FROM tb_faq WHERE `idx` = $idx";
}
else{
    if($mode == 'page'){
        $sql = "SELECT * FROM woosung_web.tb_faq WHERE `active` =  1 ORDER By `idx` DESC";
    }
    else{
        $sql = "SELECT * FROM woosung_web.tb_faq ORDER BY `idx`"; 
    }
}

$query =  mysqli_query($conn,$sql);

$result = array();
while($row = mysqli_fetch_array($query)){
    array_push($result,[
        "no" => $row['idx'],
        "tit" => $row['tit'],
        "desc" => $row['desc'],
        "imgs"=>$row['imgs'],
        "cate" => $row['cate'],
        "date" => $row['date'],
        "active" => $row['active']
    ]);
}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
        ]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>