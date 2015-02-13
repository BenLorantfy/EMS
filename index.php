<?php 
	session_start(); 
	include("php/users.class.php");
	
	$users = new Users();		
?>
<!DOCTYPE html>
<html>
<head>
	<?php 	
		include("includes/head.php"); 
	?>
</head>
<body>
	<section id = "login"<?php if($users->isLogged()){ ?> style="display:none;"<?php } ?>>
		<div class = "verticalCenter"></div>
		<div id = "loginBox" class = "box">
			<div id = "loginHeader">Login</div>
			<input id = "username" type = "text" class = "loginCredential" placeholder="Username"></input>
			<input id = "password" type = "password" class = "loginCredential" placeholder="Password"></input>
		</div>
	</section>
	
	<section id = "search"<?php if(!$users->isLogged()){ ?> style="display:none;"<?php } ?>>
		<div class = "verticalCenter"></div>
		<div id = "searchBox" class = "box">
			hi
		</div>
	</section>
</body>
</html>