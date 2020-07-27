<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);


$faqsql = "SELECT * FROM woosung_web.tb_faq WHERE `active` =  1 ORDER By `idx` DESC LIMIT 5";
$supportsql = "SELECT * FROM tb_support  ORDER by `idx` DESC LIMIT 5";
$qnasql = "SELECT * FROM tb_qna ORDER BY idx DESC LIMIT 5";

$Faq =  mysqli_query($conn,$faqsql);
$Support =  mysqli_query($conn,$supportsql);
$qna =  mysqli_query($conn,$qnasql );

$result = array();
while($row = mysqli_fetch_array($Faq)){
    array_push($result,[
        "idx" => $row['idx'],
        "tit" => $row['tit'],
        "cate" => 'FAQ',
    ]);
}

while($row = mysqli_fetch_array($Support)){
    array_push($result,[
        "idx" => $row['idx'],
        "tit" => $row['title'],
        "cate" => '공지사항',
    ]);
}

while($row = mysqli_fetch_array($Support)){
    array_push($result,[
        "idx" => $row['idx'],
        "tit" => $row['title'],
        "cate" => 'QnA',
    ]);
}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
        ]);

echo urldecode($Data);
include("conn/header.php");
?>