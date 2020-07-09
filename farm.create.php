<?php
//insert x update o delete o
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$mode = $data['mode'];
$idx = $data['no'];
//update , delete
if($mode == 'update'){
    $tit = $data['title'];
    $desc = $data['desc'];
    $link = $data['link'];
    $private = $data['private'];
    $thumnail = $data['img'];

    $sql = "UPDATE `woosung_web`.`farm_data` SET `title` = '$tit', 
    `desc` = '$desc', `link` = '$link', `thumnail` = '$thumnail' , `private`='$private'
    WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'delete'){
    $sql = "DELETE FROM `woosung_web`.`farm_data` WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}

else if($mode == 'insert'){
    $tit = $data['title'];
    $desc = $data['desc'];
    $link = $data['link'];
    $thumnail = $data['img'];
    $private = $data['private'];


    $sql = "INSERT INTO `woosung_web`.`farm_data` 
    (`title`, `desc`, `link`, `thumnail`, `date`,`private`) VALUES 
    ('$tit', '$desc', '$link', '$thumnail', '$date' , '$private')";
    $query =  mysqli_query($conn,$sql);

}


$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
    "phpResult"=>$phpResult,
]);

echo urldecode($Data);
include("conn/header.php");

?>