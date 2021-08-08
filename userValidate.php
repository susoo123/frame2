<?php
//이메일 중복 확인을 위한 코드 
    $con = mysqli_connect('localhost', 'soo123', 'ksy9029', 'soo123');

    $UserEmail = $_POST["email"];
    $UserPwd = $_POST["pw"];

    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE email = ?");

    mysqli_stmt_bind_param($statement, "s", $UserEmail);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $userID);

    $response = array();
    $response["success"] = true;

    while(mysqli_stmt_fetch($statement)){
      $response["success"] = false;
      $response["UserEmail"] = $UserEmail;
    }

    echo json_encode($response);
?>