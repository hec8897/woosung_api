<?php
include("conn/conn.php");
include("inc/file_uploader.php");
$data = json_decode(file_get_contents("php://input"),true);
$mode = $_POST['mode'];

if($mode == 'create'){

    $cate = $_POST['cate'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $fixed = $_POST['fixed'];
    $active = $_POST['active'];

    $file0 = isset($_FILES['file0'])?FileUploader($_FILES['file0']):"";
    $file1 = isset($_FILES['file1'])?",".FileUploader($_FILES['file1']):"";
    $file2 = isset($_FILES['file2'])?",".FileUploader($_FILES['file2']):"";
    $file3 = isset($_FILES['file3'])?",".FileUploader($_FILES['file3']):"";
    $file4 = isset($_FILES['file4'])?",".FileUploader($_FILES['file4']):"";

    $fileName = $file0.$file1.$file2.$file3.$file4;

    $sql = "INSERT INTO `woosung_web`.`tb_support` 
    (`title`, `cate`, `desc`, `date`, `fixed`, `active`,`file`) VALUES 
    ('$title', '$cate', '$desc', '$date', '$fixed','$active','$fileName')";

    $query =  mysqli_query($conn,$sql);
}
else if($mode == 'update'){
    $cate = $_POST['cate'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $fixed = $_POST['fixed'];
    $active = $_POST['active'];
    $fileName = $_POST['fileData'];
    $idx = $_POST['no'];

    $file0 = isset($_FILES['file0'])?FileUploader($_FILES['file0']):"";
    $file1 = isset($_FILES['file1'])?",".FileUploader($_FILES['file1']):"";
    $file2 = isset($_FILES['file2'])?",".FileUploader($_FILES['file2']):"";
    $file3 = isset($_FILES['file3'])?",".FileUploader($_FILES['file3']):"";
    $file4 = isset($_FILES['file4'])?",".FileUploader($_FILES['file4']):"";

    $sql = "UPDATE `woosung_web`.`tb_support` SET `title` = '$title', 
    `cate` = '$cate', `desc` = '$desc', `fixed` = '$fixed', `active` = '$active', 
    `file` = '$fileName' 
    WHERE (`idx` = '$idx')";
    $query =  mysqli_query($conn,$sql);
}
else{
    $mode = $data['mode'];
    if($mode == "delete"){
        $idx = $data['no'];
        $files = $data['files'];
        $fileName = $files[0];

        for($count = 0; $count < count($files); $count++){
            unlink("upload_support/".$files[$count]);
        }

        $sql = "DELETE FROM `woosung_web`.`tb_support` WHERE (`idx` = '$idx')";
        $query =  mysqli_query($conn,$sql);
    }
    else if($mode == 'FileUploader'){
        $fileName = $data['fileName'];
        $result = file_exists("upload_support/".$fileName);

    }
    else if($mode == 'fileDelte'){
        $fileName = $data['FileName'];
        $fileArray = $data['FileArray'];
        $idx = $data['no'];

        unlink("upload_support/".$fileName);

        $sql = "UPDATE `woosung_web`.`tb_support` SET  `file` = '$fileArray' 
        WHERE (`idx` = '$idx')";
        $query =  mysqli_query($conn,$sql);
    }
}


$phpResult = isset($query)?"ok":"no";

$Data = json_encode([
    "phpResult"=>$phpResult,
    "result"=>$result
]);


echo urldecode($Data);
include("conn/header.php");
?>