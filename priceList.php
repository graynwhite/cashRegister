<?php
require_once("config.inc");
require_once('connect.php');
$sql = "select * from PLU order by  name";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Problem with query " . $sql . "error message is " . mysql_error();
quit;		
}
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Virtual Cash Register Price List</title> 
	<? include_once("meta.inc"); ?>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Virtual Cash Register</h1></div>
<div data-role="content">
<h3><?php echo ORGNAME_DEF ?> Price List</h3>
<? while($row=mysql_fetch_array($result)){
$line=  $row[name] . "...." . sprintf('%01.2f',$row[unitPrice]);
	if($row[deptID]==1){
		$line.= " plus tax of " . sprintf('%01.2f',round($row[unitPrice] * .06));
		} 
echo $line . "<br />"; 
}
?>
</div> <!--End of content-->
<div data-role=footer><h1>Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>
?>