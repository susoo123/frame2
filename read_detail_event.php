<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $event_id = $_POST['event_id'];

    
    $sql ="SELECT * FROM event WHERE event_id='$event_id' ";
   

    $response = mysqli_query($conn, $sql);
   

    $result = array();
    $result['event'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
    if ( mysqli_num_rows($response) === 1 ) {

        $row = mysqli_fetch_assoc($response);

        if($row['event_id'] == $event_id){

        $index['title'] = $row['title'];
        $index['event_start_date'] = $row['event_start_date'];
        $index['event_end_date'] = $row['event_end_date'];
        $index['num_people'] = $row['num_people'];
        $index['event_id'] = $row['event_id'];
        $index['contents'] = $row['contents'];
        $index['img'] = $row['img'];

        array_push($result['event'], $index);

    
        $result['success'] = "1";
        $result['message'] = "success";
        
        echo json_encode($result);
        mysqli_close($conn);
        }


    }else{

        $result['success'] = "0";
        $result['message'] = "fail";
        echo json_encode($result);
        mysqli_close($conn);

    }
}

 


?>