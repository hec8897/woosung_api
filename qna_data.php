<?php
include("conn/conn.php");
$date = date("Y-m-d");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];
$sql= isset($data['idx'])?
"SELECT * FROM tb_qna WHERE `idx` = $idx":
"SELECT * FROM tb_qna";

$query =  mysqli_query($conn,$sql);

$result = array();
while($row = mysqli_fetch_array($query)){
    array_push($result,
    [
        "no"=>$row['idx'],
        "cate"=>$row['cate'],
        "writer"=>$row['writer'],
        "title"=>$row['tit'],
        "date"=>$row['date'],
        "recive"=>$row['answer'],
        "desc"=>$row['desc'],
        "status"=>$row['status'],
    ]
);
}

$phpResult = isset($query)?"ok":"no";

$Login_info = json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
            "test"=>$test,
            'test2'=>$sql,
        ]);

echo urldecode($Login_info);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>