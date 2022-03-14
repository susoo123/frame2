<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD'] =='POST'){
    
 //포스트로 받은 내용들.. 
 $user_id_chat = $_POST['user_id_chat'];
 $img = $_POST['chat_text'];
 $type = $_POST['type'];
 $receiver = $_POST['receiver']; // 유저 프로필 이미지랑 유저 네임 가져오기 
 $chat_date = $_POST['chat_date'];

 //디비 연결 
 require_once 'db.php';

 $filename="IMG".rand().".jpg"; //$email 대신 rand() 함수 쓰면 랜덤이로 파일이름 설정됨.
	  
 file_put_contents("profile_image/".$filename,base64_decode($img));

 $awsURL="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$filename;

  //디비 feed 테이블에 데이터 삽입  // 모든 칼럼에 다 내용 들어가야함. null설정 해둔것 빼고 
 $sql = "INSERT INTO chat_room (user_id_chat, chat_text, chat_date, receiver, type) VALUES ('$user_id_chat','$awsURL','$chat_date','$receiver','$type')";

 mysqli_query($conn, $sql);

 $result['success'] = "1";
$result['message'] = "success";


$sql2 ="SELECT * FROM chat_room INNER JOIN user WHERE user_id_chat = id AND chat_id IN (SELECT MAX(chat_id) FROM chat_room GROUP BY user_id_chat) order by chat_id DESC Limit 1 ";
        
 $response = mysqli_query($conn, $sql2);


 $result = array();
 $result['chat_img'] = array();
 while($row = mysqli_fetch_array($response)){
    $index['user_id_chat'] = $row['user_id_chat'];
    $index['chat_text'] = $row['chat_text'];
    $index['chat_date'] = $row['chat_date'];
    $index['type'] = $row['type'];
    $index['receiver'] = $row['receiver'];
    $index['chat_id'] = $row['chat_id'];

    array_push($result['chat_img'], $index);

    }
 
echo json_encode($result);
mysqli_close($conn);

//  if(mysqli_query($conn, $sql)) {
//             $result['success'] = "1";
//             $result['message'] = "success";
            
//             echo json_encode($result);
//             mysqli_close($conn);

    

//         } else {

//             $result["success"] = "0";
//             $result["message"] = "error";

//             echo json_encode($result);
//             mysqli_close($conn);
            
//         }

}


?>