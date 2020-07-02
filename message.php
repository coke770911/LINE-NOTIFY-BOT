<?php 
session_start();
#echo $_SESSION['Authorization'];

if(isset($_POST["message"])) {
	$ch = curl_init();
	#假裝自己是瀏覽器
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0');
	curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
	curl_setopt($ch, CURLOPT_POST, true);
	#x-www-form-urlencoded 幹 要搭配 http_build_query 才有用 靠北
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/x-www-form-urlencoded',
	'Authorization: Bearer '.$_SESSION['Authorization']
	));
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("message" => $_POST["message"])));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch); 
	curl_close($ch);
	$re = json_decode($result);
	echo $re->message;
} 
?>

<form action="message.php" method="post" enctype="multipart/form-data">
<input type="text" name="message" />
<input type="submit" value="送出" />
</form>