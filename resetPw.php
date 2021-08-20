<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD'] =='POST'){

 $et_email = $_POST['et_email'];
 $et_code = $_POST['et_code'];
 $et_password =$_POST['et_password'];

 //비밀번호 해시화
 //$et_password = password_hash($et_password, PASSWORD_DEFAULT);

  //디비 연결 
  require_once 'db.php';

  $query = "UPDATE user SET password = '$et_password' WHERE email = '$et_email' ";

  $checkPw = mysqli_query($conn, $query);

  if($result)
   {
    $result["success"] = "1";
    $result["message"] = "success";

    echo json_encode($result);
        mysqli_close($conn);

   }
   else
   {
    $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
   }



}

?>