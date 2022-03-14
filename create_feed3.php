<?php

//얘가 어플에서 실제로 쓰이는 코드 

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');


    header("Content-Type:application/json");

    $arr = array();

    include "db.php";

    //생성 신청한 그룹 이름으로 된 폴더가 없으면 생성합니다.
    $path = "./profile_image/";

    //받은 이미지 파일들의 개수
    $cntImage = $_POST['cntImage'];

  
 //이미지 경로 
 $url ='http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/';


    
    $imgArray = array(); //안드로이드에서 보낸 이미지 file을 받기 위해 만든 array

    for($i = 0; $i < $cntImage; $i++){

        //$imgArray[] = $_FILES['image'.$i];

        $srcName = $_FILES['image'.$i]['name'];
        $tmpName = $_FILES['image'.$i]['tmp_name'];

        if(is_null($srcName)){
            $uploads_dir = NULL;
        }else{
            $uploads_dir = 'profile_image/' . date('Ymd_his') . $srcName; 
            //$uploads_dir = 'http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/profile_image/' . date('Ymd_his') . $srcName;  
           
        }

        array_push($imgArray, $uploads_dir);

        $result = move_uploaded_file($tmpName, $uploads_dir);//서버에 저장되는 부분
        $uriList[] = $url.$uploads_dir;
   }
     
   // 내용1 a.jpg
   //내용1 b.jpg

        //이미지 파일 업로드 실패시 알려줍니다.
        if($result){
           
    
            $imgdata = implode(',',$uriList); //imgArray를 string으로 변환 
            // $imgdata = implode(',',$imgArray); //imgArray를 string으로 변환 
         
           
        
           
            //[a,b,c]
            //a,b,c

            // Array,a,Array,b

            $arr['upload'] = "1";

            $sql = "INSERT INTO feed
            (feed_user_id, feed_contents, feed_img, feed_uid)
            VALUES(
                    '{$_POST['user_id']}',
                    '{$_POST['contents']}',
                    '{$imgdata}',
                    '{$_POST['feed_uid']}'
                    )
                
                    ";

            mysqli_query($conn, $sql);
            
    
        }else{
    
            //업로드 실패시 
            $arr['upload'] = "-1";
    
            }



    $count = count($imgArray);
    //이미지 파일 개수 확인
    $arr['count'] = $count;

    echo json_encode($arr);//업로드 결과 json으로 만들기 (upload, count)
    mysqli_close($conn); 

?>

