<?php 
	session_start(); 
	include("php/users.class.php");
	
	$users = new Users();	
	$isLogged = $users->isLogged();	
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("includes/head.php"); ?>
</head>
<body>
	<div id = "cover"></div>
	
	<?php include("includes/login.php"); ?>
	<?php include("includes/search.php"); ?>

</body>
</html>