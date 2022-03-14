<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    
    $sql ="SELECT * FROM ticket INNER JOIN event ON event_id = event_id_ticket AND receiver_id={$_POST['user_id']} ORDER BY id DESC";
   

    //$sql = "SELECT * FROM feed ORDER BY feed_id DESC";
    // $sql2 = "SELECT * FROM user";

    $response = mysqli_query($conn, $sql);
    //$response2 = mysqli_query($conn, $sql2);
   

    $result = array();
    $result['ticket'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
    if ( mysqli_num_rows($response) > 0 ) {
        
        while($row = mysqli_fetch_array($response)){
            if($row['receiver_id'] == $_POST['user_id']){

            $index['event_id'] = $row['event_id'];
            $index['event_start_date'] = $row['event_start_date'];
            $index['event_end_date'] = $row['event_end_date'];
            $index['title'] = $row['title'];


            $index['imageArray'] = explode(',', $row['ticket_img']); //디비에 담긴 string 데이터를 , 를 기준으로 배열로 변환
                
            array_push($result['ticket'], $index);
            }
        }
        
    }
        
    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);

}

 

 
?>