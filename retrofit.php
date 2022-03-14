<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db.php';
    $feed_id = $_POST['feed_id'];
    $response = array();

    $sql = "SELECT * FROM feed WHERE feed_id = $feed_id ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($result);

    mysqli_close($conn);
    
    echo json_encode($row);
    
}
?>
