<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $user_id = $_POST['user_id'];
    $event_id = $_POST['event_id'];

    

    //$sql = "SELECT * FROM user left JOIN event WHERE id = '$user_id' AND event_id = '$event_id' ";
    
    $sql ="SELECT * FROM user WHERE id='$user_id' ";
    $sql2 ="SELECT * FROM event WHERE event_id='$event_id' ";
    //$sql ="SELECT * FROM user WHERE id='$user_id' UNION SELECT * FROM event WHERE id='$event_id' ";
   
    

    $response = mysqli_query($conn, $sql); //select User
    $response2 = mysqli_query($conn, $sql2); // select Event
    
   

    $result = array();
    $result['result'] = array();


    if ( mysqli_num_rows($response) === 1 && mysqli_num_rows($response2) === 1 ) {

        $row = mysqli_fetch_assoc($response);
        $row2 = mysqli_fetch_assoc($response2);

        if($row['id'] == $user_id && $row2['event_id'] == $event_id){

        //user 테이블 
        // $index['email'] = $row['email'];

        // //이벤트 테이블
        // $index['event_end_date'] = $row2['event_end_date'];
        // $index['event_id'] = $event_id;


        $sql3 = "INSERT INTO event_register
        (user_id, user_name, user_email, event_id, event_title, event_date)
        VALUES(
                '{$user_id}',
                '{$row['name']}',
                '{$row['email']}',
                '{$event_id}',
                '{$row2['title']}',
                '{$row2['event_end_date']}'
                )
            
                ";

        mysqli_query($conn, $sql3);//insert

        //array_push($result['result'], $index);

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