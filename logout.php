<!DOCTYPE html> 
<html> 
	<head>

	<title>Logout from Virtual Cash Register</title> 
	<? require_once("meta.inc") ?>
	
	
	<script>
	$(document).ready(function(){
	
	
	$('#sendMailButton').click(function(){
	$.post("sendMail.php",{
	<!--email: "allie807@comcast.net",-->
	email: "cauleyfj64@gmail.com",
	subject: "Shift Report",
	message: $('#logoutReportArea').html()
	},function(data){
	$('#mailReturnMessage').html(data);
	$.dough("clerkName","remove",{ path: "current" });
	$.dough("clerkId","remove",{ path: "current" });
	$.dough("clerkRole","remove",{ path: "current" });
	})
	});
	
	
	});
	</script>
	
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Virtual Cash Register</h1></div>
<div data-role="content">

<p>Thank you <? echo $clerkName ?> for using the Gray and White Computing Virtual Cash Register.</p>

<div id="logoutReportArea"></div>

<p> A copy of the above report of your activity will be emailed to your manager when you click on the send button.</p>
<input type="button" id="sendMailButton" value="send the report">
<div id="mailReturnMessage"></div>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>

</div><!-- End of Page -->
<!-- ========================== -->

</body>
</html>