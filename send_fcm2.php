<?php 
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

function send_notification ($tokens, $message)
{
    $url = 'https://fcm.googleapis.com/fcm/send';

    $notification = [
        'title' =>'[FRAME 티켓당첨]',
        'body' => '티켓에 당첨되셨습니다.',
        //'icon' =>'myIcon', 
        //'sound' => 'mySound'
    ];

    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
   

    $fields = array(
         'registration_ids' => $tokens,
         'notification' => $notification,
         'data' => $extraNotificationData
         //'data' => $message
        );

    $headers = array(
        'Authorization:key = AAAAEkPreGw:APA91bGr3AT6EodvvHGwMMjH4lqKhXbC3RtUDFgX1dc9t725n1eMzCf03nUZa_i3vAhkoucOkQ4_At6Cbdox-RLoVd7OWedRS9uiQKNA-WPOLG7A--SA6ujO01ckWWQi2OQVYpLBwMRx',
        'Content-Type: application/json' //헤더에 전달할 값들 설정 
        );

   // fcm 서버와 통신 
   $ch = curl_init(); //컬 초기화 
   curl_setopt($ch, CURLOPT_URL, $url); // url 지정 
   curl_setopt($ch, CURLOPT_POST, true);  //true 시 post 전송
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // 헤더 처리 // 헤더는 서버에서 보낸 것만 얻을 수 있음.
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//요청 결과 문자열로 반환
   curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //원격 서버의 인증서가 유효한지 검사 안함
   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields)); // post data 
   $result = curl_exec($ch);           
   if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
   }
   curl_close($ch);
   return $result;
}

include "db.php";

//$user_id = $_GET['user_id'];

 $receiverData = $_POST['receiver_id']; //당첨자 user_id 들   
 $jsonarray = json_decode($receiverData,true); // 당첨자 id를 jsonArray로 변환
 $cntwinner= $_POST['cntwinner']; // 당첨자 수 

 for($i = 0; $i < $cntwinner; $i++){
    $winner_id = $jsonarray[$i];

    $sql = " SELECT token From user where id ='$winner_id' ";
    $result = mysqli_query($conn,$sql);
    $tokens = array(); //당첨자들 토큰 들어갈 array

    if(mysqli_num_rows($result) > 0 ){

        while ($row = mysqli_fetch_assoc($result)) {
            $tokens[] = $row["token"];
        }

    }
    //mysqli_close($conn);

    $message = array("message" => " FCM PUSH NOTIFICATION TEST MESSAGE");
    $message_status = send_notification($tokens, $message);
    echo $message_status;
 }

// $sql = " SELECT token From user where id ='$user_id' ";
// $sql = " SELECT token From user ";

// $result = mysqli_query($conn,$sql);
// $tokens = array();

// if(mysqli_num_rows($result) > 0 ){

//     while ($row = mysqli_fetch_assoc($result)) {
//         $tokens[] = $row["token"];
//     }
// }

// mysqli_close($conn);

// $message = array("message" => " FCM PUSH NOTIFICATION TEST MESSAGE");
// $message_status = send_notification($tokens, $message);
// echo $message_status;

?>