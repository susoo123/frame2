<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


//문의 사항 채팅방 리스트 
if ($_SERVER['REQUEST_METHOD']=='GET') {
   
    require_once 'db.php';

    
    //$sql ="SELECT user_id FROM chat_room group by user_id";
    // $sql ="SELECT * FROM chat_room inner join user where user_id =id ORDER BY room_id DESC";
    // $sql ="SELECT * FROM chat_room inner join user where user_id =id ORDER BY room_id DESC";
    // $sql2 ="SELECT *, Max(room_id) FROM chat_room where user_id";
    // $sql3 = "SELECT a.id, a.rev, a.contents
    // FROM YourTable a
    // INNER JOIN (
    //     SELECT id, MAX(rev) rev
    //     FROM YourTable
    //     GROUP BY id
    // ) b ON a.id = b.id AND a.rev = b.rev";
    //  $sql3 = "SELECT id,name, email, profile_img
    //  FROM user
    //  INNER JOIN (
    //      SELECT user_id, MAX(room_id) room_id
    //      FROM chat_room
    //      GROUP BY user_id
    //  ) chat_room ON id = user_id ";
    //  SELECT a.*
    //  FROM YourTable a
    //  LEFT JOIN YourTable b
    //  ON a.id = b.id AND a.rev < b.rev
    //  WHERE b.id IS NULL;

    //성공!!
    $sql4="SELECT *
    FROM chat_room INNER JOIN user WHERE user_id_chat = id AND chat_id IN ( 
        SELECT MAX(chat_id) FROM chat_room GROUP BY user_id_chat
        )";
// SELECT o.*
// FROM `Persons` o                    # 'o' from 'oldest person in group'
//   LEFT JOIN `Persons` b             # 'b' from 'bigger age'
//       ON o.Group = b.Group AND o.Age < b.Age
// WHERE b.Age is NULL                 # bigger age not found
   
//
//     $sql2 ="SELECT
// 	*
// from(
// 	select
// 		*
// 	from chat_room
// 	where (user_id, chat_date) in (
// 		select user_id, max(chat_date) as chat_date
// 		from chat_room group by user_id
// 	)
// 	order by chat_date desc
// ) 
// ";

    $response = mysqli_query($conn, $sql4);
    //$response2 = mysqli_query($conn, $sql2);
   

    $result = array();
    $result['chatList'] = array();

    $imgArray =array();

    //이미지 경로 
    $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/";
   
  
while($row = mysqli_fetch_array($response)){
 //while($row = mysqli_query($conn, $sql)){

        //채팅방 정보 
        $index['chat_text_latest'] = $row['chat_text'];
        $index['chat_date'] = $row['chat_date'];
        //$index['user_id'] = $row['user_id'];


        //user 정보
        $index['user_id'] = $row['id'];
        $index['name'] = $row['name'];
        $index['email'] = $row['email'];
        $index['profile_img'] = $url.$row['profile_img'];
        
        

        //$index['imageArray'] = explode(',', $row['feed_img']); //디비에 담긴 string 데이터를 , 를 기준으로 배열로 변환
            // $index['feed_img'] = $url.$imgUrl;
            // array_push($imgArray, $index['feed_img']);
            //$index['feed_img'] = $url.$row['feed_img'];

        array_push($result['chatList'], $index);

    }
        
    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);

}

 

 
?>