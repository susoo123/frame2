<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


header("Content-Type:application/json");

$arr = array();

include "db.php";

//생성 신청한 그룹 이름으로 된 폴더가 없으면 생성합니다.
$path = "./profile_image/";


//이미지 경로 
$url ='http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/';
    
        $sql = "INSERT INTO comments
        (user_id, feed_id, comments)
        VALUES(
                '{$_POST['user_id']}',
                '{$_POST['feed_id_i']}',
                '{$_POST['comment_text']}'
                )
            
                ";


        mysqli_query($conn, $sql);
        //$arr['upload'] = "1";
       
        // echo json_encode($arr);//업로드 결과 json으로 만들기 (upload, count)
        // mysqli_close($conn); 
        

        //$sql2 ="SELECT * FROM comments INNER JOIN user on user_id = id WHERE feed_id='{$_POST['feed_id_i']}'  ";
        $sql3 ="SELECT * FROM comments INNER JOIN user WHERE user_id = id AND feed_id IN (SELECT MAX(feed_id) FROM comments GROUP BY feed_id) order by comment_id DESC Limit 1 ";

        //이미지 경로 
        $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
       
      
        $response = mysqli_query($conn, $sql3);
        $result = array();
        $result['comment2'] = array();
    
       // if ( mysqli_num_rows($response) > 0 ) {
        while($row = mysqli_fetch_assoc($response)){
          
    
            if($row['feed_id'] == $_POST['feed_id_i']){
    
            $index['feed_id'] = $row['feed_id'];
            $index['comment_id'] = $row['comment_id'];
            $index['comments'] = $row['comments'];
            $index['comment_date'] = $row['comment_date'];
            $index['comment_name'] = $row['name'];
            $index['comment_img'] = $url.$row['profile_img'];
    
    
            array_push($result['comment2'], $index);
            
            $result['success'] = "1";
            $result['message'] = "success";
            
           
    
            }
    
            
    
        }
    
        echo json_encode($result);
        mysqli_close($conn);
            
       
    


   





?>

