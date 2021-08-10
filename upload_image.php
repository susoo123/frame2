<?php
//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $photo = $_POST['photo'];

    $path = "profile_image/$id.jpeg";
    //$finalPath = "ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/var/www/html/".$path;

    require_once 'db.php';

    $sql = "UPDATE user SET photo='$path' WHERE email='$email' ";

    if (mysqli_query($conn, $sql)) {
        
        if ( file_put_contents( $path, base64_decode($photo) ) ) {
            
            $result['success'] = "1";
            $result['message'] = "success";

            echo json_encode($result);
            mysqli_close($conn);

        }

    }

}

?>

<?php


//이 코드를 이용하면 이미지가 중복해서 저장됨

// if ($_SERVER['REQUEST_METHOD'] =='POST'){

// 	//php 에러 확인 코드 
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// include 'db.php';

// 	//    $name=$_POST['t1'];
// 	//    $design=$_POST['t2'];	   
// 	   $img=$_POST['upload'];

//        $filename="IMG".rand().".jpg";
// 	   var_dump($filename);
// 	   file_put_contents("profile_image/".$filename,base64_decode($img));

// 			$qry="UPDATE user SET profile_img = '$filename' ";


// 			$res=mysqli_query($conn,$qry);
			
// 			if($res==true)
// 			 echo "이미지 파일 업로드 성공!";
// 			else
// 			 echo "이미지 파일 업로드 실패...";


// }

?>
