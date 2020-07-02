<?php 
session_start();
#取得LINE 連結碼
$data = array(
	'grant_type' => 'authorization_code',
	'code' => $_GET["code"],
	'redirect_uri' => 'http://localhost/respon.php',
	'client_id' => '',
	'client_secret' => ''
);

$ch = curl_init();
#假裝自己是瀏覽器
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');
curl_setopt($ch, CURLOPT_URL, "https://notify-bot.line.me/oauth/token");
curl_setopt($ch, CURLOPT_POST, true);
#x-www-form-urlencoded 幹 要搭配 http_build_query 才有用 靠北
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch); 
curl_close($ch);

$re = json_decode($result);

if($re->status == 200 ) {
	$_SESSION['Authorization'] = $re->access_token;
	header('Location: message.php');
    exit();
} else {
	echo $re->message;
}
 