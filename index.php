<?php
require_once("config.inc");

?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Cash Register Simulator</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" href="http://pjnews.mobi/peggyjo4.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="//code.jquery.com/mobile/1.0.1/jquery.mobile-1.0.1.min.js"></script>
	<script>
	$(document).ready(function(){
	
	$('#btnLogin').click(function(){
	console.log("login clicked ");
	var name = $('#clerkName').val();
	var pswd = $('#password').val();
	$.get('validateLogin.php',{
	name: name,
	pswd: pswd
	}, function(data) {
		$('#actionArea').html(data);
		})
	
	});
	
	
	
	
	
	}); 
	</script>
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Cash Register</h1></div>
<div data-role="content">
<h3><? echo $ORGNAME ?></h3>
<div id="actionArea">
<form name="login" action="">
  <label for="clerkName">Name</label>
  <input type="text" name="clerkName" id="clerkName" >
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
	<input type="button" name="btnLogin" id="btnLogin" value="login">
</form> 
</div>  
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
