<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $phone_num = $_POST['phone_num'];
    $img=$_POST['upload'];

    require_once 'db.php';

    $filename="IMG".rand().".jpg"; //$email 대신 rand() 함수 쓰면 랜덤이로 파일이름 설정됨.
	  
	   file_put_contents("profile_image/".$filename,base64_decode($img));


    $sql = "UPDATE user SET name='$name', birth='$birth', phone_num='$phone_num', profile_img ='$filename'  WHERE email='$email' ";
    mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM user WHERE email = '$email' ";

    $response = mysqli_query($conn, $sql2);

    $result = array();
    $result['user_info'] = array();

    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);
            $index['name'] = $row['name'];
            $index['profile_img'] = "http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$row['profile_img'];
            
            array_push($result['user_info'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);


        }


    // if(mysqli_query($conn, $sql)) {

    //       $result["success"] = "1";
    //       $result["message"] = "success";

    //       echo json_encode($result);
    //       mysqli_close($conn);
    //   }


}else{

   $result["success"] = "0";
   $result["message"] = "error!";
   echo json_encode($result);

   mysqli_close($conn);
}

?>


