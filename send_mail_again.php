
<?php

//가입 인증 메일 다시 보내기 

if ($_SERVER['REQUEST_METHOD'] =='POST'){
  

    include 'sendmail.php';
  

    //포스트로 받은 내용들.. 
   
    $email = $_POST['email'];
   

    //디비 연결 
    require_once 'db.php';

    $sql = "SELECT * FROM user WHERE email='$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['login'] = array();

  
    
    $mail->Subject = 'Frame 인증 메일입니다.';
    
    $mail->addAddress($email, 'User');
    $mail->Body = '링크를 클릭하시면 메일이 인증됩니다.
http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/verify.php?email='.$email;
    // $to="$email"; 
    // $from="Master";
    // $subject="인증메일입니다.";
    // $body="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/verify.php?email=$email";
    // $cc_mail="";
    // $bcc_mail="";
    

    if ( mysqli_query($conn, $sql) ) {
        $result["success"] = "1";
        $result["message"] = "success";

        //성공하면 result를 제이슨으로 인코딩해서 안드로이드로 보냄. 
        echo json_encode($result);
        
        mysqli_close($conn);
        $mail->send();

    } else {

        $result["success"] = "0";
        $result["message"] = "error";

        echo json_encode($result);
        mysqli_close($conn);
        
    }
}

?>





<?php
//include "db.php";

// $res = mysqli_query($con,"SELECT * FROM user");
// $result = array();
// while($row = mysqli_fetch_array($res)){
//     array_push($result, array('email' =>$row[0],'password'=> $row[1]));
// }

// echo json_encode(array("result"=>$result));
?>


<?php
// $email = $_POST["email"]; //이메일과 비밀번호를 post로 받겠다.
// $pw = $_POST["pw"];



// //mysqli_prepare = statement 생성  //?를 입력할 개수만큼 쓴다. 
// $statement = mysqli_prepare($con, "INSERT INTO user VALUES(?,?)");  // user DB에 삽입 서버에 이 값들을 각 칼럼에 넣겠다라는 의미 



// //파라미터 바인드
// //두번째 = 파라미터 타입 입력, 셋,넷= 파라미터 입력 
// mysqli_stmt_bind_param($statement,"ss"",$email, $pw); //s = string, i = int / String 형식 두개라서 ss

// //쿼리 실행 
// mysqli_stmt_execute($statement);


// $response = array();
// $response["success"] = true; //"success"를 안드로이드로 

// echo json_encode($response);

?>