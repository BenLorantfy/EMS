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
	<div id = "cover" style="opacity: 0;"></div>
	
	<?php include("includes/login.php"); ?>
	<?php include("includes/search.php"); ?>
	<?php include("includes/reports.php"); ?>

</body>
</html>