<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel='icon' href='assets/images/bake-id.ico'>
	<title>BAKE.ID - Login</title>

    <script>
        function showHide() {
            var x = document.getElementById('pswd');
            const y = document.getElementById('toggle');

            if (x.type === 'password') {
                x.type = 'text';
                y.classList.add('hide');
            } else {
                x.type = 'password';
                y.classList.remove('hide');
            }
        }
    </script>
</head>
<body>
	<div class="container">
		<div class="login-left">
			<h3>WELCOME</h3>
			<h1>BACK!!!</h1>
			<p>A hot bread are waiting for you!</p>
		</div>
		<div class="login-right">
			<img src="assets/images/bake-id.png">
			<h4>Welcome to BAKE.ID</h4>
			<form action="logic/login-process" method="POST">
				<input type="text" name="id" placeholder="Employee ID" maxlength="25" id="id">
				<br>
				<input type="password" name="pass" placeholder="Password" id="pswd">
				<div id="toggle" onclick="showHide();"></div>
				<button type="submit">LOGIN</button>
			</form>
		</div>
	</div>
</body>
</html>