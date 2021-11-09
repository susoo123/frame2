
<?php
//피드 수정하기 페이지에 디비에 저장된 내용을 띄움

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='POST') {

    //안드로이드에서 feed_id를 받음 
    $feed_id = $_POST['feed_id'];

    require_once 'db.php';

    $sql = "SELECT * FROM feed WHERE feed_id = '$feed_id' ";
    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['feed_display'] = array();

    
    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  

    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);


            $index['feed_contents'] = $row['feed_contents'];
            $index['feed_id'] = $row['feed_id'];

            //이미지 경로 배열로 만들기 
            $index['imageArray'] = explode(',',$row['feed_img']); 


            array_push($result['feed_display'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);

          

        } else {

            $result['success'] = "0";
            $result['message'] = "피드 읽기 실패";

            echo json_encode($result);
            mysqli_close($conn);

        }







}




?>