<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='GET') {


    //$email = $_POST['email']; // 쉐어드에 저장한 이메일 값을 가져오기 
   
    require_once 'db.php';

    $sql ="SELECT * FROM feed INNER JOIN user ON feed_user_id = id ORDER BY feed_id DESC";

    //$sql = "SELECT * FROM feed ORDER BY feed_id DESC";
    $sql2 = "SELECT * FROM user";

    $response = mysqli_query($conn, $sql);
    $response2 = mysqli_query($conn, $sql2);

    $result = array();
    $result['feed'] = array();

    $result2 = array();
    $result2['user'] = array();

    
    if (mysqli_num_rows($response)) {
        
        //$row = mysqli_fetch_assoc($response);
      

            

        //for($i=0;$i<mysqli_num_rows($response); $i++){
         while($row = mysqli_fetch_array($response)){

            $index['feed_id'] = $row['feed_id'];
            $index['feed_user_id'] = $row['feed_user_id'];
            $index['feed_contents'] = $row['feed_contents'];
            $index['feed_date'] = $row['add_date'];
            $index['feed_img'] = "http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$row['feed_img'];
            $index['del_status'] = $row['del_status'];

            $index['name'] = $row['name'];
            $index['email'] = $row['email'];
            $index['profile_img'] = "http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$row['profile_img'];
            

            array_push($result['feed'], $index);

            }
        
          
            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);


        }
        elseif(mysqli_num_rows($response2) === 1){
            $row2 = mysqli_fetch_assoc($response2);

            $index['name'] = $row2['name'];
            $index['email'] = $row2['email'];
            $index['profile_img'] = "http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$row2['profile_img'];
            
            array_push($result2['user'], $index);

            $result2['success'] = "1";
            $result2['message'] = "success";
            
            echo json_encode($result2);
            mysqli_close($conn);

        } 
        else {

            $result['success'] = "0";
            $result['message'] = "피드 가져오기 실패";

            echo json_encode($result);
            mysqli_close($conn);

        }

    }

 
?>