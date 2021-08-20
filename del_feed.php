<?php

error_reporting(E_ALL);
ini_set('display_errors', '1'); //이거 php에러보는 거 확인하고 


header('content-type: text/html; charset=utf-8'); 
 
// 데이터베이스 접속 
$connect = mysqli_connect('localhost', 'soo123', 'ksy9029', 'soo123');


$feed_uid = $_POST['feed_uid'];
$sql = "UPDATE feed SET del_status = '1' WHERE feed_uid = '$feed_uid' ";
 
// $result = mysqli_query($connect,$sql);
 

if ( mysqli_query($connect, $sql) ) {
    $result["success"] = "1";
    $result["message"] = "success";

    //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
    echo json_encode($result);
    mysqli_close($conn);

} else {

    $result["success"] = "0";
    $result["message"] = "error";

    echo json_encode($result);
    mysqli_close($conn);
    
}

   
?>