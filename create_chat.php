<?php
// //php 에러 확인 코드 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');


// if ($_SERVER['REQUEST_METHOD'] =='POST'){
    
//  //포스트로 받은 내용들.. 
//  $sendmsg = $_POST['sendmsg'];
//  $user_id2 = $_POST['user_id2'];

//  //디비 연결 
//  require_once 'db.php';

//  $arr = array();
//   //디비 feed 테이블에 데이터 삽입  // 모든 칼럼에 다 내용 들어가야함. null설정 해둔것 빼고 
//  $sql = "INSERT INTO chat_room (user_id, chat_text) VALUES ('{$_POST['user_id2']}', '{$_POST['sendmsg']}')";

// //$sql = "INSERT INTO feed (feed_user_id, feed_contents) VALUES ('$user_id', '$feed_contents')";


//         if ( mysqli_query($conn, $sql) ) {
//             $arr['chat'] = "1";

//             //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
//             echo json_encode($arr);//업로드 결과 json으로 만들기 (upload, count)
//             mysqli_close($conn); 

//         } else {
//             $arr['chat'] = "0";
//             // $result["success"] = "0";
//             // $result["message"] = "error";

//             echo json_encode($arr);//업로드 결과 json으로 만들기 (upload, count)
//             mysqli_close($conn); 
            
//         }

// }


?>

<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


    //header("Content-Type:application/json");


    $arr = array();
    $result = array();
    


    include "db.php";
    // $sendmsg  = 'good';
    // $user_id2  ='1';

    if ($_SERVER['REQUEST_METHOD'] =='POST'){

        $user_id2 ="";
        $sendmsg  ="";

        $user_id2 = $_POST["user_id2"];
        //echo $user_id2;
    
        $sendmsg = $_POST["sendmsg"];
   


    $sql = "INSERT INTO chat_room
    (user_id_chat,chat_text )
    VALUES(
            
            '{$_POST['user_id2']}',
            '{$_POST['sendmsg']}'
            )
        
            ";
           
            // mysqli_query($conn, $sql);
            // mysqli_close($conn); 

            $sql2 = "INSERT INTO chat_room
    (user_id_chat,chat_text )
    VALUES(
            '{$_POST['user_id2']}',
            '{$_POST['sendmsg']}'
            )
        
            ";
    $res = mysqli_query($conn, $sql2);
    if($res) {
        // 포스트 저장 완료
        $result["success"] = true;

    } else {
        // 리뷰 저장 실패
        $result["success"] = false;
    }

   // mysqli_close($conn);

    // 배열을 json 문자열로 변환하여 클라이언트에 전달
    echo json_encode($result);
            
            
    


        }
   

?>

