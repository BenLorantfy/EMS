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
		if($users->isLogged()){
	?>
		<meta name="isLogged" content="true"/>
	<?php } ?>
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id = "cover"></div>
	
	<section id = "login" style="display:none;">
		<div class = "verticalCenter"></div>
		<div id = "loginBox" class = "box">
			<div id = "loginHeader">Login</div>
			<input id = "username" type = "text" class = "loginCredential" placeholder="Username"></input>
			<input id = "password" type = "password" class = "loginCredential" placeholder="Password"></input>
			<input id = "loginButton" type = "button" value="Log In"></input>
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