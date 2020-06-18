<?php
include("conn/conn.php");

if($conn){
    echo "연결됨";
}
else{
    echo "연결안뎀";
}
?>