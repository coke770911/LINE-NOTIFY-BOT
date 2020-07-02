<html>
<head>
    <title></title>
	<meta charset="utf-8" />
    <script>
        function Auth() {
            var URL = 'https://notify-bot.line.me/oauth/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=CLFu85UZenRAKRHrbdZrsn';
            URL += '&redirect_uri=http://localhost/respon.php';
            URL += '&scope=notify';
            URL += '&state=abcde';
            window.location.href = URL;
        }
    </script>
</head>
<body>
    <button onclick="Auth();">點選這裡連結到LineNotify</button>
</body>
</html>



