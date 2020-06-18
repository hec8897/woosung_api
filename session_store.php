<?php
  //세션 저장
    include('conn/conn.php');
    mysqli_set_charset($conn,"utf8");
    session_start();
    $login = $_SESSION['login'];
    $sesson = [
        "login"=>$_SESSION['login'],
        "name"=>$_SESSION['name'],
        "id"=>$_SESSION['id'],
        "phone"=>$_SESSION['phone'],
        // "authority"=>$_SESSION['authority']
    ];
    
    $Returndata = json_encode(
        ['result'=>$sesson]
    );

echo urldecode($Returndata);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');


/****************************************************
 * 
새로고침할때마다 app.js 에서 session_store.php에게 세션정보를 받아와서 
store에 저장함 

필요기능 session_destroy();

****************************************************/

?>