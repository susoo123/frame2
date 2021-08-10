
<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'db.php';

    $sql = "SELECT * FROM user WHERE email='$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['login'] = array();

    
    if ( mysqli_num_rows($response) === 1 ) {
        
        $row = mysqli_fetch_assoc($response);
        //$check_verify= $row['verify'];

        if ( password_verify($password, $row['password']) ) {

            if($row['verify'] == 'Y'){

            $index['name'] = $row['name'];
            $index['email'] = $row['email'];
            $index['id'] = $row['id'];
            $index['profile_img'] = "http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/".$row['profile_img'];
            $index['role'] = $row['role'];

            array_push($result['login'], $index);

            $result['success'] = "1";
            $result['message'] = "success";
            
            echo json_encode($result);
            mysqli_close($conn);

            }
            elseif($row['verify'] == 'N'){

                $result['success'] = "0";
                $result['message'] = "이메일을 인증해주세요.";//얘가 안가고 
    
                echo json_encode($result);
                mysqli_close($conn);
            }

        } else {

            $result['success'] = "0";
            $result['message'] = "이메일을 인증해주세요.";//이메일 인증 N이면 얘가 안드로이드로 감.. 

            echo json_encode($result);
            mysqli_close($conn);

        }

    }

}

?>






















<?php
// $email=$_POST["email"];
// $pw = $_POST["pw2"];

// //statement 생성 ?가 email의 인자임. execute 시 바인딩을 통해 ?에 값이 들어가고 이후, 구분이 수행됨. 
// $statement = mysqli_prepare($con, "SELECT * FROM user WHERE email= ? AND pw= ? ");

// //statement 바인드
// mysqli_stmt_bind_param($statement, "ss",$email, $pw); //s = string, i = int / String 형식 두개라서 ss

// //쿼리 실행 
// mysqli_stmt_execute($statement);

// //결과 set을 내부 버퍼에 저장 //internel buffer 버퍼는 임시 저장 공간을 의미함.
// mysqli_stmt_store_result($statement);

// //결과 저장을 위해 prepared statement를 바인딩함. 
// mysqli_stmt_bind_result($statement, $email, $pw);

// $response = array(); //결과를 어레이에 담는다.
// $response["success"] = false; //??

// while(mysqli_stmt_fetch($statement)){
//     $response["succcess"] = true; //fetch할 때 true가 되네.. 왜?? 

//     $response["email"] = $email;
//     $response["password"] = $pw;
// }

// echo json_encode($response); //디비에서 받아온 정보들($responese)을 json으로 인코딩함.

?>