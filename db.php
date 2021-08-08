<?php

$conn = mysqli_connect("localhost","soo123","ksy9029","soo123"); //아이피, phpmyadmin아이디&비밀번호, 그 안의 데이터 베이스 이름 
mysqli_query($conn,'SET NAMES utf8'); // set names utf8 = 한글 깨짐 현상 방지 

if(mysqli_connect_errno($conn)){
    echo "연결 실패 ".mysqli_connect_error();
}

?>
