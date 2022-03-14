<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $feed_id_i = $_POST['feed_id_ii'];
    
  //  var_dump($feed_id_i);
     $sql ="SELECT * FROM comments INNER JOIN user on user_id = id WHERE feed_id='$feed_id_i'  ";
    // $sql ="SELECT * FROM comments WHERE feed_id='$feed_id_i' ";
    //$sql2 ="SELECT * FROM comments INNER JOIN feed on feed_id='$feed_id_i' ";
   

    $response = mysqli_query($conn, $sql);
  

    $result = array();
    $result['comment'] = array();

   

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  

   // if ( mysqli_num_rows($response) > 0 ) {
    while($row = mysqli_fetch_assoc($response)){
       // $row = mysqli_fetch_assoc($response);

        if($row['feed_id'] == $feed_id_i){

        $index['feed_id'] = $row['feed_id'];
        $index['comment_id'] = $row['comment_id'];
        $index['comments'] = $row['comments'];
        $index['comment_date'] = $row['comment_date'];
        $index['comment_name'] = $row['name'];
        $index['comment_img'] = $url.$row['profile_img'];


        array_push($result['comment'], $index);
        
        // $result['success'] = "1";
        // $result['message'] = "success";
        
       

        }

        

    }

    echo json_encode($result);
    mysqli_close($conn);
        
   

}

 

 
?>