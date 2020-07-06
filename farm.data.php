<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];
$mode = $data['mode'];

if($mode == "main"){
    $sql = "SELECT * FROM farm_data WHERE `private`='1' ORDER BY `idx` DESC";

}
else{
    $sql = isset($data['idx'])?
    "SELECT * FROM farm_data WHERE `idx` = $idx":
    "SELECT * FROM farm_data ORDER By `idx` DESC";
}

$query =  mysqli_query($conn,$sql);

$result = array();
while($row = mysqli_fetch_array($query)){
    array_push($result,
    [   
        "no"=>$row['idx'],
        "title"=>$row['title'],
        "desc"=>$row['desc'],
        "link"=>$row['link'],
        "img"=>$row['thumnail'],
        "date"=>$row['date'],
        "private"=>$row['private']
    ]
);
}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
            'test'=>$sql,
            'mode'=>$mode
        ]);

echo urldecode($Data);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

?>