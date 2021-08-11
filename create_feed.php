<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD'] =='POST'){
    
 //포스트로 받은 내용들.. 
 $feed_contents = $_POST['contents'];
 $feed_img = $_POST['feed_img'];
 $user_id = $_POST['user_id']; // 유저 프로필 이미지랑 유저 네임 가져오기 

 //디비 연결 
 require_once 'db.php';

 $filename="IMG".rand().".jpg"; //$email 대신 rand() 함수 쓰면 랜덤이로 파일이름 설정됨.
	  
 file_put_contents("profile_image/".$filename,base64_decode($feed_img));



  //디비 feed 테이블에 데이터 삽입  // 모든 칼럼에 다 내용 들어가야함. null설정 해둔것 빼고 
 $sql = "INSERT INTO feed (feed_user_id, feed_contents, feed_img) VALUES ('$user_id', '$feed_contents','$filename')";

//$sql = "INSERT INTO feed (feed_user_id, feed_contents) VALUES ('$user_id', '$feed_contents')";


        if ( mysqli_query($conn, $sql) ) {
            $result["success"] = "1";
            $result["message"] = "success";

            //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
            echo json_encode($result);
            mysqli_close($conn);

        } else {

            $result["success"] = "0";
            $result["message"] = "error";

            echo json_encode($result);
            mysqli_close($conn);
            
        }

}


?>