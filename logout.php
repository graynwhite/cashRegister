<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$clerkName=$_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
//echo $clerkId;
$loginDate=$_COOKIE['loginTime'];
//$loginDate=date("Y-m-d H:m:s",$logintime);
//echo "<br />Time before deduction " . $loginDate; 

$sql="select * from transaction where date >= \"$loginDate\" && clerkId = \"$clerkId\" order by date";
$result=mysql_query($sql);
if(mysql_error() != ''){
echo mysql_error();
}
$html="<h3>for $clerkName : shift beginning  $loginDate </h3>";

$totalTax=0;
$totalAmount=0;
$html .=" <table class=\"table table-striped table-bordered table-condensed table-hover\">
   <thead>
    <tr> 
        <th>Item Name</th>
		<th>Tax Amount</th>
        <th>Sales Amount</th>

    </tr>
    </thead>";
while($row=mysql_fetch_array($result)){

$html.= "<tr><td>" . $row['descr'] . "</td><td>" . number_format($row['tax'], 2, '.', ','). "</td><td>" . number_format($row['amount'], 2, '.', ','). "</td></tr>";
$totalTax += $row['tax'];
$totalAmount += $row['amount'];
}


$html .= "<tr><td> Total  </td><td> " . number_format($totalTax, 2, '.', ',') . "</td><td>" . number_format($totalAmount, 2, '.', ','). "</td></tr></table>";

?>




<!DOCTYPE html> 
<html> 
	<head>

	<title>Logout from Virtual Cash Register</title> 
	<? require_once("meta.inc") ?>
	
	
	<script>
	$(document).ready(function(){
	
	
	$('#sendMailButton').click(function(){
	$.post("sendMail.php",{
	email: "allie807@comcast.net",
	<!--email: "cauleyfj64@gmail.com",-->
	subject: "Shift Report",
	message: $("#shiftReportArea").html()
	},function(data){
	$('#mailReturnMessage').html(data);
	$.dough("clerkName","remove",{ path: "current" });
	$.dough("clerkId","remove",{ path: "current" });
	$.dough("clerkRole","remove");
	$.dough("loginTime","remove");
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

<div id="shiftReportArea"> <?php echo $html ?></div>

<p> A copy of the above report of your activity will be emailed to your manager when you click on the send button.</p>
<input type="button" id="sendMailButton" value="send the report">
<div id="mailReturnMessage"></div>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>

</div><!-- End of Page -->
<!-- ========================== -->

</body>
</html>