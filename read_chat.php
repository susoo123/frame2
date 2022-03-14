<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';
    $user_id = $_POST['user_id'];

    
    $sql ="SELECT * FROM chat_room inner join user on user_id_chat = id WHERE user_id_chat = $user_id OR receiver = $user_id ";
   
    $response = mysqli_query($conn, $sql);
    
    $result = array();
    $result['chat'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
    while($row = mysqli_fetch_array($response)){
        $index['chat_id'] = $row['chat_id'];
        $index['user_id_chat'] = $row['user_id_chat'];
        $index['chat_text'] = $row['chat_text'];
        $index['chat_date'] = $row['chat_date'];


        $index['name'] = $row['name'];
        $index['receiver'] = $row['receiver'];

        $index['type'] = $row['type'];
       
        array_push($result['chat'], $index);

    }
        
    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);

}

 

 
?>