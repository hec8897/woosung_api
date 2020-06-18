<?php
 include('conn/conn.php');
 $date = date("Y-m-d");
 $data = json_decode(file_get_contents("php://input"),true);
 $getId = $data['id'];
 $getPw = $data['pw'];

 $sql = "SELECT * FROM administor WHERE admin_id = '$getId'";
 $query =  mysqli_query($conn,$sql);

 $row = mysqli_fetch_assoc($query);

 $password = $row['admin_pw'];

 $check_DB =  count($row);
 if($check_DB == 0){
    $check = 'noresult';
 }
 else{
    // if (password_verify($mempw, $password)) {
        if($getPw == $password ){
           $check = 'success';
           $result = $row;

           session_start();
           $_SESSION["login"] = true;
           $_SESSION['id'] = $row['admin_id'];
           $_SESSION['phone'] = $row['admin_phone'];
           $_SESSION['name'] = $row['admin_name'];
        //    $_SESSION['authority'] = $row['authority'];

        }
        else{
           $check = 'nopw';
        }
    }


$Login_info = json_encode(
    ['result'=>$result,'phpResult'=>$check]
);

echo urldecode($Login_info);
header('Content-Type: application/json');
header('Content-Type: text/html; charset=utf-8');

/****************************************************

로그인로직
phpResult=> (
    noresult : ID 결과없음 
    nopw : 패스워드 틀림
    success : 성공 => session_store 저장(로그인, 세션 유지 분리)
)

새로고침할때마다 app.js 에서 session_store.php에게 세션정보를 받아옴

메모
password_verify 해야함

*****************************************************/

?>




