<?php

error_reporting(E_ALL);
ini_set('display_errors', '1'); //이거 php에러보는 거 확인하고 

    header('content-type: text/html; charset=utf-8'); 
 
    // 데이터베이스 접속 
    $connect = mysqli_connect('localhost', 'soo123', 'ksy9029', 'soo123');


//     mysqli_query("SET NAMES UTF8");

//    // 데이터베이스 선택
//    mysqli_select_db("soo123",$connect);

   // 세션 시작
   session_start();
   $email = $_REQUEST["email"];//얘 따옴표 안에 넣어주니까 됨...!
 
   $sql = "UPDATE user SET verify = 'Y' WHERE email = '$email' ";
 
   $result = mysqli_query($connect,$sql);
 
   if($result)
   {
    echo "[Frame 메일 인증] <br> 메일이 인증되었습니다. Frame어플에서 로그인해주세요.";
   }
   else
   {
    echo mysqli_errno($connect);
   }
   
?>