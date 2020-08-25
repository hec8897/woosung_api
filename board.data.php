<?php
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);


$faqsql = "SELECT * FROM woosung_web.tb_faq WHERE `active` =  1 ORDER By `idx` DESC LIMIT 6";
$supportsql = "SELECT * FROM tb_support  ORDER by `idx` DESC LIMIT 6";
$qnasql = "SELECT * FROM tb_qna ORDER BY idx DESC LIMIT 6";

$Faq =  mysqli_query($conn,$faqsql);
$Support =  mysqli_query($conn,$supportsql);
$qna =  mysqli_query($conn,$qnasql );

$result = array();
while($row = mysqli_fetch_array($Faq)){
    array_push($result,[
        "idx" => $row['idx'],
        "tit" => $row['tit'],
        "cate" => 'FAQ',
        "link"=>"http://ec2-13-124-19-117.ap-northeast-2.compute.amazonaws.com/board/#/manual/zoom/".$row['idx']
    ]);
}

while($row = mysqli_fetch_array($Support)){
    array_push($result,[
        "idx" => $row['idx'],
        "tit" => $row['title'],
        "cate" => '공지사항',
        "link"=>"http://ec2-13-124-19-117.ap-northeast-2.compute.amazonaws.com/board/#/home/zoom/".$row['idx']

    ]);
}

// while($row = mysqli_fetch_array($qna)){
//     array_push($result,[
//         "idx" => $row['idx'],
//         "tit" => $row['title'],
//         "cate" => 'QnA',
//         "link"=>"http://www.wssw.kr/#/board/zoom/".$row['idx']

//     ]);
// }

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
            "phpResult"=>$phpResult,
            "result"=>$result,
        ]);

echo urldecode($Data);
include("conn/header.php");
?>