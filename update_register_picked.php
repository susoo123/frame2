<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_METHOD']=='POST') {
   
    require_once 'db.php';

    $event_id = $_POST['event_id'];
    //$winner_id = $_POST['winner_id'];
    $cntwinner = $_POST['cntwinner'];

    $winnerList = $_POST['winnerList'];
// echo "이벤트아이디: ".$event_id;
// echo  "cntwinner: ".$cntwinner;
// echo  "winnerList: ".$winnerList;

    $jsonarray = json_decode($winnerList,true);
    //$winnerdata = implode(',',$winnerList);

    //$list[]= $winnerList;

    
    
    for($i = 0; $i < $cntwinner; $i++){
        $winner_id = $jsonarray[$i];
        //echo $winner_id ;
        $sql ="UPDATE event_register SET picked = 'Y' WHERE event_id = '$event_id' AND user_id ='$winner_id' ";
   
        $response = mysqli_query($conn, $sql);
    }
    

    
    //$sql ="UPDATE event_register SET picked = 'Y' WHERE event_id = '$event_id' AND user_id ='$winner_id' ";
   
    // $response = mysqli_query($conn, $sql);
   
  
    $result = array();
    $result['picked'] = array();

    $result['success'] = "1";
    $result['message'] = "success";
    
    echo json_encode($result);
    mysqli_close($conn);

    //  if ( mysqli_num_rows($response) > 0 ) {
    // //    $row = mysqli_fetch_array($response);

    //         while($row = mysqli_fetch_array($response)){

               
    //             $index['title'] = $row['event_title'];
    //             $index['user_id'] = $row['user_id'];
    //             $index['user_name'] = $row['user_name'];
    //             $index['user_email'] = $row['user_email'];

    //             array_push($result['register'], $index);
                
    //         }
            

    //         $result['success'] = "1";
    //         $result['message'] = "success";
            
    //         echo json_encode($result);
    //         mysqli_close($conn);
    //         }

    //     else{

    //     $result['success'] = "0";
    //     $result['message'] = "fail";
    //     echo json_encode($result);
    //     mysqli_close($conn);
    // }


}
       





?>