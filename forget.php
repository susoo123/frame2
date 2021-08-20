<?php


//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD'] =='POST'){

    include 'sendmail.php';
  
    //포스트로 받은 내용들.. 
    $email = $_POST['email'];
   


    //디비 연결 
    require_once 'db.php';

    //디비 user 테이블에 데이터 가져오기
    $sql = "SELECT * FROM user WHERE email = '$email' ";

   

    $random_string = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);

    $mail->addAddress($email, 'User');
    $mail->Subject = 'Frame Changing Password Mail';
   // $mail->Body = 'http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/verify.php?email='.$email;
    $mail->Body = 'Code: '.$random_string;

    $check = mysqli_query($conn, $sql);
    


    if ($check) {
        $result["success"] = "1";
        $result["message"] = "success";
        $result["authCode"] = "$random_string";

        //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
        echo json_encode($result);
        mysqli_close($conn);
        $mail->send();

    } else {

        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
        
    }


    // if ($checkPw) {
    //     $result["success"] = "1";
    //     $result["message"] = "success";
    //     $result["authCode"] = "$random_string";

    //     //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
    //     echo json_encode($result);
    //     mysqli_close($conn);
    

    // } else {

    //     $result["success"] = "0";
    //     $result["message"] = "error";

    //     echo json_encode($result);
    //     mysqli_close($conn);
        
    // }




}

?>

