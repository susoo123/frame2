<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='GET') {
   
    require_once 'db.php';

    
    $sql ="SELECT * FROM event ORDER BY event_id DESC";
   

    //$sql = "SELECT * FROM feed ORDER BY feed_id DESC";
    // $sql2 = "SELECT * FROM user";

    $response = mysqli_query($conn, $sql);
    //$response2 = mysqli_query($conn, $sql2);
   

    $result = array();
    $result['event'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
    while($row = mysqli_fetch_array($response)){
        $index['title'] = $row['title'];
        $index['event_start_date'] = $row['event_start_date'];
        $index['event_end_date'] = $row['event_end_date'];
        $index['num_people'] = $row['num_people'];
        $index['event_id'] = $row['event_id'];
        $index['contents'] = $row['contents'];
        $index['img'] = $row['img'];

        
        

       // $index['imageArray'] = explode(',', $row['feed_img']); //디비에 담긴 string 데이터를 , 를 기준으로 배열로 변환
            // $index['feed_img'] = $url.$imgUrl;
            // array_push($imgArray, $index['feed_img']);
            //$index['feed_img'] = $url.$row['feed_img'];

        array_push($result['event'], $index);

    }
        
    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);


}else{

    $result['success'] = "0";
    $result['message'] = "fail";
    echo json_encode($result);
    mysqli_close($conn);

}

 








?>