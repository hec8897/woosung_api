<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$idx = $data['idx'];
$mode = $data['mode'];

if(isset($data['idx'])){
    $sql = "SELECT * FROM tb_support WHERE `idx` = $idx";
}
else{
    if($mode == 'main'){
        $sql = "SELECT * FROM tb_support WHERE `active` = '1' AND `fixed` = '1' ORDER by `idx` DESC";
        //홈페이지 메인공지사항 표시
    }
    else if($mode == 'list'){
        $sql = "SELECT * FROM tb_support WHERE `active` = '1' ORDER by `idx` DESC";
    }
    else{
        $sql = "SELECT * FROM tb_support  ORDER by `idx` DESC";
    }
}

if(isset($data['join'])){
    $updateJoin = "UPDATE tb_support set `join` = `join`+ 1 where `idx` = $idx";
}

$query =  mysqli_query($conn,$sql);
$Updatequery =  mysqli_query($conn,$updateJoin);

$result = array();
while($row = mysqli_fetch_array($query)){
    $files = $row['file']==""?null:$row['file'];
    array_push($result,[
        "no" => $row['idx'],
        "cate" => $row['cate'],
        "title" => $row['title'],
        "desc" => $row['desc'],
        "files" =>$files,
        "fixed" => $row['fixed'],
        "active" => $row['active'],
        "join" => $row['join'],
        "date" => $row['date']
    ]);
}


$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
            "test"=>$sql
        ]);

echo urldecode($Data);
include("conn/header.php");

?>