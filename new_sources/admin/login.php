<?php
session_start();
if(isset($_SESSION['login_user'])){
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Istrobot Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="assets/bootstrap.min.css">
	<link rel="stylesheet" href="assets/dist/semantic.min.css">
	<script src="assets/jquery-2.1.1.min.js"></script>
	<script src="assets/dist/semantic.min.js"></script>
	<style>
		body {
			background-image: url("assets/new_year_background.png");
		}
	</style>
</head>
<body>
	<div class="container" style="position: relative; top: 50%; transform: translateY(-50%);">
		<div class="row">
			<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-4 col-md-3 col-md-offset-5" style="position:relative;">
				<div class="wrap" id="login">
					
					<form name="form1" method="post" action="checklogin.php">
						<div class="ui left icon input" style="min-width:100%; margin-bottom:5px;">
							<input type="text" placeholder="Prihlasovacie meno" name="username" id="username">
							<i class="users icon"></i>
						</div><br>
						<div class="ui left icon input" style="min-width:100%; margin-bottom:5px;">
							<input type="password" placeholder="Heslo" name="password" id="password">
							<i class="lock icon"></i>
						</div><br>
						<!-- test -->
						<input name="Submit" type="submit" value="Prihlásiť" class="fluid ui button" id="login_button">
					</form>	
				</div>
				
			</div>

		</div>

	</div>
	<script>
		$('#login_button').click(function()
		{
			var user=$("#username").val();
			var pass=$("#password").val();
			$.ajax({
				type: "POST",
				url: "checklogin.php",
				username: user,
				password: pass,
				cache: false,
				success: function(data){

					if(data=="return")
					{
						window.location.replace("index.php");
					}
				}
			});
		});
	</script>
</body>
</html>