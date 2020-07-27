<?php
 $mysql_hostname = '3.35.9.120';
 $mysql_username = 'woosung';
 $mysql_password = 'woosung1!';
 $mysql_database = 'sys';
 $mysql_port = '3306';
 $mysql_charset = 'UTF8';

$connect = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_database, $mysql_port, $mysql_charset);
 
if($connect->connect_errno){
    echo '[연결실패..] : '.$connect->connect_error.'';
}else{
    echo '[연결성공1!]'.'<br>';
}
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>