<?php

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

header("Content-Type:application/json");
include "db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$feed_contents = $_POST['contents'];
$feed_id = $_POST['feed_id'];

$arr = array();

//생성 신청한 그룹 이름으로 된 폴더가 없으면 생성합니다.
$path = "./profile_image/";

//받은 이미지 파일들의 개수
$cntImage = $_POST['cntImage'];

$imgdata1 = $_POST['imgDataArray']; //이미 디비에 저장되어 있던 이미지 데이터 경로 

$imgdata2 = $_POST['urlStrArrayList'];


$imgArray = array();
$imgArray2 = array();

array_push($imgArray2,$imgdata2);

 //이미지 경로 
 $url ="http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/";







  //처음부터 안드로이드에서 A(http: 포함된) 배열과 B(새롭게 추가된이미지) 배열을 따로 만든다. 
  //나중에 A에 서버주소넣은 B를 push해준다. 





 //안드로이드에서 보낸 이미지 file을 받기 위해 만든 array

        for($i = 0; $i < $cntImage; $i++){

            //$imgArray[] = $_FILES['image'.$i];

            $srcName = $_FILES['image'.$i]['name'];
            $tmpName = $_FILES['image'.$i]['tmp_name'];

            if(is_null($srcName)){
                $uploads_dir = NULL;
            }else{
                $uploads_dir = 'profile_image/' . date('Ymd_his') . $srcName;   
            }

          
            array_push($imgArray, $uploads_dir);

            $result = move_uploaded_file($tmpName, $uploads_dir);//서버에 저장되는 부분 여기까지는 확실히됨!! 

            $uriList[] = $url.$uploads_dir;
            
        }

        $uriListStr = implode(',',$uriList); 
        array_push($imgArray2,$uriListStr);
 

        //이미지 파일 업로드 
        if($result){
        

            //$imgdata = implode(',',$uriList); //imgArray를 string으로 변환 
            $imgdata = implode(',',$imgArray2);
            

            $arr['upload'] = "1";


            $sql = "UPDATE feed SET feed_contents='$feed_contents', feed_img ='$imgdata' WHERE feed_id = '$feed_id' ";
            
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


    }


?>