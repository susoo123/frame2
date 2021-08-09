<?php
include 'db';

//php 에러 확인 코드 
error_reporting(E_ALL);
ini_set('display_errors', '1'); 


$ch = curl_init();
$url = 'http://www.culture.go.kr/openapi/rest/publicperformancedisplays/realm'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=WLT%2BoeODHTTqLXKHimPxENXZnLeOacqbt2d5ndqcmw6yFIZUqCYmuhaCtxMnzuKYC%2FtfXBoKdPyY1VVR0dqRNw%3D%3D'; /*Service Key*/
//$queryParams = '?' . urlencode('ServiceKey') . '=ZoOVgdxeLX35DdZVFqlhUhcYooLtWQg2fAh3ywZD7%2F2ejv0cIBeunJ61aOK7TQM6jPXjxBx%2F18JBBbjKNth9VQ%3D%3D'; /*Service Key*/
// $queryParams .= '&' . urlencode('keyword') . '=' . urlencode(''); /**/
// $queryParams .= '&' . urlencode('sortStdr') . '=' . urlencode('2'); /**/
// $queryParams .= '&' . urlencode('ComMsgHeader') . '=' . urlencode(''); /**/
// $queryParams .= '&' . urlencode('RequestTime') . '=' . urlencode('20100810:23003422'); /**/
// $queryParams .= '&' . urlencode('CallBackURI') . '=' . urlencode(''); /**/
$queryParams .= '&' . urlencode('realmCode') . '=' . urlencode('D000');
$queryParams .= '&' . urlencode('MsgBody') . '=' . urlencode(''); /**/
// $queryParams .= '&' . urlencode('from') . '=' . urlencode('20100101'); /**/
// $queryParams .= '&' . urlencode('to') . '=' . urlencode('20101201'); /**/
// $queryParams .= '&' . urlencode('cPage') . '=' . urlencode('1'); /**/
$queryParams .= '&' . urlencode('rows') . '=' . urlencode('100'); /**/
// $queryParams .= '&' . urlencode('sortStdr') . '=' . urlencode('2'); /**/
// $queryParams .= '&' . urlencode('place') . '=' . urlencode('1'); /**/
// $queryParams .= '&' . urlencode('gpsxfrom') . '=' . urlencode('129.101'); /**/
// $queryParams .= '&' . urlencode('gpsyfrom') . '=' . urlencode('35.142'); /**/
// $queryParams .= '&' . urlencode('gpsxto') . '=' . urlencode('129.101'); /**/
// $queryParams .= '&' . urlencode('gpsyto') . '=' . urlencode('35.142'); /**/

curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);



$xml = simplexml_load_string($response); //XML을 STRING으로 변환 
$items = $xml->msgBody->perforList;
//var_dump($xml);

$list= array();
// $list['api'] = array();


//foreach ($items as $perforList) {
//for($i=0;$i<sizeof($items); $i++){


   


    // $xml = simplexml_load_file($response);
    // foreach($xml->msgBody as $xml->msgBody->$perforList){
    //     $msgBody[]= array('perforList' => $items->title); 

    // }
    // echo json_encode($msgBody);
    
  

//     foreach($items as $perforList=>$value)
// {
//     $msgBody[]= array('perforList' => $items->title); 
// }       
//echo json_encode($msgBody);


//for($i=0;$i<sizeof($items); $i++){
for($i=0;$i<2; $i++){
//$title = $xml->msgBody->perforList[$i]->title;

//$data = $xml->msgBody;
$data = $xml->msgBody->perforList[$i];

array_push($list,$data);

}


//성공하면 list를 제이슨으로 인코딩해서 안드로이드로 보냄. 
echo json_encode($list);
    
?>