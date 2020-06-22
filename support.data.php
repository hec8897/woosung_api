<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];

$sql = isset($data['idx'])?
"SELECT * FROM tb_support WHERE `idx` = $idx":
"SELECT * FROM tb_support";

$query =  mysqli_query($conn,$sql);

$result = array();
while($row = mysqli_fetch_array($query)){
    array_push($result,
    [
        "no" => $row['idx'],
        "cate" => $row['cate'],
        "tit" => $row['title'],
        "desc" => $row['desc'],
        "files" =>$row['file'],
        "fixed" => $row['fixed'],
        "active" => $row['active'],
        
        "join" => $row['join'],
        "date" => $row['date']
    ]
);
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