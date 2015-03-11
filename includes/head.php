<!-- META -->
<meta charset="UTF-8">
<meta name="description" content="Employee Management System">
<meta name="keywords" content="EMS,Employee,Management,System">
<meta name="author" content="Ben Lorantfy, Grigoriy Kozyrev, Michael Dasilva, Kevin Li">
<?php if(isset($isLogged) && $isLogged){ ?>
<meta name="isLogged" content="true"/>	
<?php } ?>


<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/styles.css"/>

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

<!-- JS -->
<!-- frameworks -->
<script src = "js/frameworks/jquery.js"></script>
<script src = "js/frameworks/jqease.js"></script> 		<!-- Easing for jquery's animate function -->
<script src = "js/frameworks/msgbox.js"></script> 		<!-- Used to show quick messages to the user (i.e. saved succesfully ) -->
<script src = "js/frameworks/postcall.js"></script> 	<!-- Used to call php functions from js more easily -->
<script src = "js/frameworks/customEvent.js"></script> 	<!-- Used to create custom events and event handlers -->

<!-- JS Entry Point -->
<script src = "js/section.class.js"></script>
<script src = "js/loginbox.class.js"></script>
<script src = "js/searchbox.class.js"></script>
<script src = "js/main.js"></script>