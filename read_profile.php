<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {


    $email = $_POST['email']; // 쉐어드에 저장한 이메일 값을 가져오기 
   
    require_once 'db.php';

    $sql = "SELECT * FROM user WHERE email = '$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['profile'] = array();

    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);


            $index['name'] = $row['name'];
            $index['email'] = $row['email'];
            $index['birth'] = $row['birth'];
            $index['phone_num'] = $row['phone_num'];
            

            array_push($result['profile'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);

          

        } else {

            $result['success'] = "0";
            $result['message'] = "프로필 읽기 실패";

            echo json_encode($result);
            mysqli_close($conn);

        }

    }

 
?>