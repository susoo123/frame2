

<?php


define('API_ACCESS_KEY','AAAAEkPreGw:APA91bGr3AT6EodvvHGwMMjH4lqKhXbC3RtUDFgX1dc9t725n1eMzCf03nUZa_i3vAhkoucOkQ4_At6Cbdox-RLoVd7OWedRS9uiQKNA-WPOLG7A--SA6ujO01ckWWQi2OQVYpLBwMRx');
 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 //$token= $_POST["Token"]; //해당 Device TokenKey
 //$token = 'fqKsE3TaTNKjon0D4gCwhl:APA91bHu2r7JDu9HXKufcAZ1kLMIgBMoAyqHkRtJkYhabKuJAk7EjLoM7aEwOVQ5afItf1tCpFcLnBvwjtnE1CN_JsF4VooH7IG8vnT0mfiRMsbdV-YfQEoiv11MRjjmIf3ht0UHm26f';
 $receiverData = $_POST['receiver_id'];
 // $receiverData = str_replace('[', '', $receiverData);
 // $receiverData = str_replace(']', '', $receiverData);
 $jsonarray = json_decode($receiverData,true);
 $cntwinner= $_POST['cntwinner'];

    for($i = 0; $i < $cntwinner; $i++){
        $winner_id = $jsonarray[$i];
        //echo $winner_id ;
            $sql = "SELECT * FROM user WHERE id ='$winner_id' ";

            $response2 = mysqli_query($conn, $sql);

            if ( mysqli_num_rows($response2) > 0 ) {

            while($row = mysqli_fetch_array($response2)){
            if($row['id'] == $winner_id){

                    $token = $row['token'];
                   
                    }
                }
            }
    }
    
 
 
 
        $notification = [
            'title' =>'[FRAME 티켓당첨]',
            'body' => '티켓에 당첨되셨습니다.',
            //'icon' =>'myIcon', 
            //'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //mulitple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];
        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;
?>