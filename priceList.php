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
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Virtual Cash Register</h1></div>
<div data-role="content">
<h3><?php echo ORGNAME_DEF ?> Price List</h3>
<table class="table table-striped table-bordered table-condensed table-hover">
   <thead>
    <tr> 
        <th>Item</th>
        <th>Price</th>

    </tr>
    </thead>
<? while($row=mysql_fetch_array($result)){
	$tax=$row[unitPrice]* .06;
$line=  "<tr><td>" .$row[name] . "</td><td>" . sprintf('%01.2f',$row[unitPrice]);
	if($row[deptID]==1){
		
		$line.= " plus tax of " . sprintf('%01.2f',$tax);
		} 
		$line .= "</td></tr>";
echo $line; 
}
?>
</table>
</div> <!--End of content-->
<div data-role=footer><h1>Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>
?>