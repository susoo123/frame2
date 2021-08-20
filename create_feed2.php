<?php 
    include "connect_db.php"; // db 연결 파일
    
    // $post = $_POST["post"];
    // $email = $_POST["email"];
    $contents = $_POST["contents"];
    $user_id = $_POST["user_id"];

    $urlList = $_POST["url"]; // json을 문자열로 받음
    $cntImage = $_POST["cntImage"]; // 첨부된 사진 개수
    $cntImage = (int)$cntImage;
    // 첨부된 사진 파일 받기
    $image = array();
    for($i=0; $i<$cntImage; $i=$i+1) {
        $image[] = $_FILES['image'.$i];
    }
    
    // 클라이언트로 보낼 응답 배열
    $result = array();

    // 20자 랜덤 문자열 생성하는 메소드
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $charactersLength = strlen($characters); 
        $randomString = ''; 
        for($i = 0; $i < $length; $i++) { 
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)]; 
        } 
        return $randomString;
    }
    
    // 중복되지 않는 20자리 문자열을 postId로 설정
    $postId;
    $num = 1;
    while ($num > 0) {
        $postId = generateRandomString(20);
        // 중복되는 id인지 확인
        $sql = "select postId from post_tbl where postId = '$postId'";
        $res = mysqli_query($connect, $sql);
        $num = mysqli_num_rows($res);
    }
    
    // 서버에 저장된 사진의 uri 리스트
    $uriList = array();
    if(count($image) > 0) {
    	// 첨부된 사진이 있을 때
    	$server = 'http://ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/';
        $uploadDir = 'profile_image'; // 서버에서 사진을 저장할 디렉토리 path
        for($i=0; $i<count($image); $i=$i+1) {
            $tmp_name = $image[$i]["tmp_name"];
            $oldName = $image[$i]["name"]; //ex) example.jpg
            $type = $image[$i]["type"]; // application/octet-stream
            $oldName_array = explode(".", $oldName);
            $type = $oldName_array[(count($oldName_array)-1)]; //ex) jpg
            $name = $postId.'_'.$i.'.'.$type; //ex) 1ccBMk7aYsIJqmX23ZNq_1.jpg
            $path = "$uploadDir/$name";
            // 임시 경로에 저장된 사진을 $path로 옮김
            move_uploaded_file($tmp_name, $path);
            $uriList[] = $server.$path;
        }
    }

    // jsonArray를 문자열로 변환
    $uriList = json_encode($uriList);

    // db에 포스트 저장하기
    $sql = "insert into feed (postId, post, imageList, urlList, publisher, uploadDate)";
    $sql.= " values ('$postId', '$post', '$uriList', '$urlList', '$email', now())";
    $res = mysqli_query($connect, $sql);
    if($res) {
        // 포스트 저장 완료
        $result["success"] = true;

    } else {
        // 리뷰 저장 실패
        $result["success"] = false;
    }

    mysqli_close($connect);

    // 배열을 json 문자열로 변환하여 클라이언트에 전달
    echo json_encode($result);

?>