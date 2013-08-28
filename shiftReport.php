<?php
require_once("config.inc");
require_once("connect.php");
$clerkName=$_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
//echo $clerkId;
$logintime=$_COOKIE['loginTime'];
$loginDate=date("Y-m-d h:m:s",$logintime);
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
<html> 
	<head>

	<title>Virtual Cash Register Sales Report</title> 
	<? include_once("meta.inc"); ?>
	
	
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Virtual Cash Register</h1></div>
<div data-role="content">
<h3><?php echo ORGNAME_DEF ?> Shift Report</h3>
<? echo $html ?>
<a href="register.php" data-ajax="false"><input type="button" value="Go back to the Virtual Cash Register"</a>
<a href="logout.php"  data-ajax="false"><input type="button" value="Continue Logout and send this report to the manager"</a>
</div> <!--End of content-->
<div data-role=footer><h1>Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>
?>