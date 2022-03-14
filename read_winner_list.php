<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $event_id = $_POST['event_id'];

    //$sql ="SELECT * FROM event_register WHERE event_id = '$event_id' AND picked = 'Y' ";
   
    $sql ="SELECT * FROM event_register  WHERE event_id = '$event_id' AND picked = 'Y'  ";
   

    $response = mysqli_query($conn, $sql);
  
    $result = array();
    $result['winner'] = array();

     if ( mysqli_num_rows($response) > 0 ) {
    //    $row = mysqli_fetch_array($response);

            while($row = mysqli_fetch_array($response)){

               
                $index['title'] = $row['event_title'];
                $index['user_id'] = $row['user_id'];
                $index['user_name'] = $row['user_name'];
                $index['user_email'] = $row['user_email'];
                $index['send_check'] = $row['send_check'];

                array_push($result['winner'], $index);
                
            }
            

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);
            }

        else{

        $result['success'] = "0";
        $result['message'] = "fail";
        echo json_encode($result);
        mysqli_close($conn);
    }
}
    






?>