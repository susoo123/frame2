<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $feed_id_i = $_POST['feed_id_i'];

    $sql ="SELECT * FROM feed Left Outer JOIN user ON feed_user_id = id 
    
    Left Outer join comments ON feed_id = feed_id
    
     WHERE del_status ='0' AND  feed_id='$feed_id_i' ";
    
    $sql2 ="SELECT * FROM feed INNER JOIN user ON feed_user_id = id  WHERE del_status ='0' AND  feed_id='$feed_id_i' ";
    //$sql2 ="SELECT * FROM comments INNER JOIN feed on feed_id='$feed_id_i' ";
   

   

    $response = mysqli_query($conn, $sql2);
  
   

    $result = array();
    $result['feed_detail'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
    if ( mysqli_num_rows($response) === 1 ) {

        $row = mysqli_fetch_assoc($response);

        if($row['feed_id'] == $feed_id_i){

        $index['feed_id'] = $row['feed_id'];
        $index['feed_user_id'] = $row['feed_user_id'];
        $index['feed_contents'] = $row['feed_contents'];
        $index['feed_date'] = $row['add_date'];


        $index['del_status'] = $row['del_status'];
        $index['feed_uid'] = $row['feed_uid'];

        $index['name'] = $row['name'];
        $index['email'] = $row['email'];
        $index['profile_img'] = $url.$row['profile_img'];
        
       // $index['comment_id'] = $row['comment_id'];
        

        $index['imageArray'] = explode(',', $row['feed_img']); //디비에 담긴 string 데이터를 , 를 기준으로 배열로 변환
            

        array_push($result['feed_detail'], $index);
        
        $result['success'] = "1";
        $result['message'] = "success";
        
        echo json_encode($result);
        mysqli_close($conn);

        }



    }

    
   

}

 

 
?>