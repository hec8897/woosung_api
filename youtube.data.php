<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);
$idx = $data['idx'];
$mode = $data['mode'];
if($mode == 'page'){
    $sql = "SELECT * FROM youtube_data WHERE `private`='1' ORDER BY `idx` DESC";
}
else{
    $sql = isset($data['idx'])?
    "SELECT * FROM youtube_data WHERE `idx` = $idx":
    "SELECT * FROM youtube_data ORDER BY idx DESC";
}

$query =  mysqli_query($conn,$sql);


$result = array();
while($row = mysqli_fetch_array($query)){
    array_push($result,[
        "no"=>$row['idx'],
        "youtubeId"=>$row['youtubeId'],
        "title"=>$row['title'],
        "cate"=>$row['cate'],
        "desc"=>$row['desc'],
        "date"=>$row['date'],
        "private"=>$row['private']
    ]);
}

$phpResult = isset($query)?"ok":"no";

$Data = json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result
            ]);

echo urldecode($Data);
include("conn/header.php");
?>