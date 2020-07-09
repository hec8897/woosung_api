<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];
$mode = $data['mode'];

$sql = isset($data['idx'])?
"SELECT * FROM tb_qna WHERE `idx` = $idx":
"SELECT * FROM tb_qna ORDER BY idx desc";

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
        "private"=>$row['private'],
        "contact"=>$row['contact'],
        "password"=>$row['password']
    ]
);
}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result
        ]);

echo urldecode($Data);
include("conn/header.php");

?>