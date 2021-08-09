<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $photo = $_POST['photo'];

    $path = "profile_image/$id.jpeg";
    $finalPath = "ec2-52-79-204-252.ap-northeast-2.compute.amazonaws.com/var/www/html/".$path;

    require_once 'db.php';

    $sql = "UPDATE users SET photo='$finalPath' WHERE email='$email' ";

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