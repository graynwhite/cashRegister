<?php
$clerkName=$_COOKIE['clerkName'];
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Logout from Virtual Cash Register</title> 
	<? require_once("meta.inc") ?>
	<script src="mktime.js"></script>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Virtual Cash Register</h1></div>
<div data-role="content">
</div><!--End of content-->
<p>Thank you <? echo $clerkName ?> for using the Gray and White Computing Virtual Cash Register. A Report of your activity is being emailed to your manager.</p>
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->

</body>
</html>