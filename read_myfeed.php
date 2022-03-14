<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';
    $user_id = $_POST['user_id'];

    
    $sql ="SELECT * FROM feed INNER JOIN user ON feed_user_id = id WHERE feed_user_id = $user_id AND del_status ='0' ORDER BY feed_id DESC";
   

   

    $response = mysqli_query($conn, $sql);
    

    $result = array();
    $result['myfeed'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
    while($row = mysqli_fetch_array($response)){
        $index['feed_id'] = $row['feed_id'];
        $index['feed_user_id'] = $row['feed_user_id'];
        $index['feed_contents'] = $row['feed_contents'];
        $index['feed_date'] = $row['add_date'];


        $index['del_status'] = $row['del_status'];
        $index['feed_uid'] = $row['feed_uid'];

        $index['name'] = $row['name'];
        $index['email'] = $row['email'];
        $index['profile_img'] = $url.$row['profile_img'];
        
        

        $index['imageArray'] = explode(',', $row['feed_img']); //디비에 담긴 string 데이터를 , 를 기준으로 배열로 변환
            // $index['feed_img'] = $url.$imgUrl;
            // array_push($imgArray, $index['feed_img']);
            //$index['feed_img'] = $url.$row['feed_img'];

        array_push($result['myfeed'], $index);

    }
        
    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);

}

 

 
?>