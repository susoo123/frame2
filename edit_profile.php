<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $birth = $_POST['birth'];
    $phone_num = $_POST['phone_num'];

    require_once 'db.php';

    $sql = "UPDATE user SET name='$name', birth='$birth', phone_num='$phone_num' WHERE email='$email' ";

    if(mysqli_query($conn, $sql)) {

          $result["success"] = "1";
          $result["message"] = "success";

          echo json_encode($result);
          mysqli_close($conn);
      }


}else{

   $result["success"] = "0";
   $result["message"] = "error!";
   echo json_encode($result);

   mysqli_close($conn);
}

?>


