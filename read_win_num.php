<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    
    $sql ="SELECT COUNT(*) FROM ticket WHERE receiver_id = {$_POST['user_id']}  ";



    $response = mysqli_query($conn, $sql);
    //$response2 = mysqli_query($conn, $sql2);
    $result = array();

  
    while($row = mysqli_fetch_assoc($response))
    {
        array_push($result, array(
            'win_num' => $row['COUNT(*)']
        ));
    }
    
    echo json_encode($result);
   
    // $result['win_num'] = mysqli_num_rows($response);
    // echo json_encode($result);
    mysqli_close($conn);

}

 

 
?>