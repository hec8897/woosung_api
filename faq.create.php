<?php
//insert x update o delete o
include("conn/conn.php");
$data = json_decode(file_get_contents("php://input"),true);

$mode = $data['mode'];
$idx = $data['no'];
//update , delete
if($mode == 'update'){
    $tit = $data['tit'];
    $desc = $data['desc'];
    $cate = $data['cate'];
    $midCate = $data['midCate'];
    $active = $data['active'];
    $img = $data['imgs'];
    $DelteImg = $data['delteImg'];


    for($count = 0; $count < count($DelteImg); $count++){
        unlink("upload_faq/".$DelteImg[$count]);
    }

    $sql = "UPDATE `woosung_web`.`tb_faq` SET 
    `tit` = '$tit', `cate` = '$cate', `mid_cate`='$midCate',
    `imgs`= '$img', `active` = '$active', 
    `desc` = '$desc' WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'delete'){
    $Files = $data['Files'];

    for($count = 0; $count < count($Files); $count++){
        unlink("upload_faq/".$Files[$count]);
    }

    $sql = "DELETE FROM `woosung_web`.`tb_faq` WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}

else if($mode == 'insert'){
    $tit = $data['tit'];
    $desc = $data['desc'];
    $cate = $data['cate'];
    $midCate = $data['midCate'];
    $active = $data['active'];
    $img = $data['imgs'];

    $sql = "INSERT INTO `woosung_web`.`tb_faq` 
    (`tit`, `cate`,`mid_cate`,`imgs`, `desc`, `date`, `order_no`, `active`) VALUES 
    ('$tit', '$cate','$midCate','$img' , '$desc', '$date', '0', '$active')";
    $query =  mysqli_query($conn,$sql);

}
else if($mode == 'fileDelte'){
    $Files = $data['files'];
    
    for($count = 0; $count < count($Files); $count++){
        unlink("upload_faq/".$Files[$count]);
    }

}

$phpResult = isset($query)?"ok":"no";

$Data= json_encode([
    "phpResult"=>$phpResult,
    "sql"=>$sql
]);

echo urldecode($Data);
include("conn/header.php");

?>