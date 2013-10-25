<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
date_default_timezone_set('America/Detroit');
$dateStamp=date("Y-m-d H:i:s");
if(!isset($_COOKIE['loginTime'])){
setcookie("loginTime",$dateStamp,time()+10800);
}
$sql = "select * from clerk where active = 1 order by name";
$result = mysql_query($sql);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql;
	quit;
	}
	$selectPhrase ="<option value=\"0\" > Select a clerk </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase .= "<option value=\"" . $row['id'] . "\">" .  $row['name'] . "</option> \n";
	}
?>

<!DOCTYPE html> 
<html> 
	<head>

	<title>Virtual Cash Register</title> 
	<?php require_once('meta.inc');?>
	<script src="mktime.js"></script>
	<script src="timezonelist.js"></script>
	<script src="setTimezone.js"></script>
	<script>
	
	$(document).ready(function(){
	
	$('#submitButton').click(function(){
	console.log("At submit button");
	var itemgrossamount = $('#totalAmount').val();
	console.log('gross amount ' + itemgrossamount);
	var itemtaxamount = $('#tax').val();
	console.log("tax amount " + itemtaxamount);
	var  dateId = $('#entryDate').val();
	console.log('entry date ' + dateId);
	$.get('postitem.php',{
	date: dateId,
	type: '003',
	clerkId: $('#clerkSelect').val(),
	role: "prx",
	deptId:	 "10",
	pluId:	 "64",
	descr: "Proxy entry",
	quantity: "0",
	price:	'0.00',
	tax:	itemtaxamount,
	amount:	itemgrossamount
	}, function(data){
	$('#resultItem').html(data);
	})
	});

	});
	</script>
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Virtual Cash Register</h1></div>
<div data-role="content">
<h3><? echo ORGNAME_DEF ?> Proxy Entry</h3>
<form>

<label for="entryDate">Entry Date</label>
<input type="date" name="entryDate" id="entryDate">

<br/>
</fieldset>
<fieldset>
<legend>Select Clerk</legend>
<select name="clerkSelect" id="clerkSelect"> 
<? echo $selectPhrase ?>
</select>
</fieldset>
<fieldset>
<legend>Sales amounts</legend>
<label for="taxable">Taxable Sales</label>
<input type="number" name="taxable" id="taxable" />
<label for="non_tax">Non taxable sales</label>
<input type="number" name="non_tax" id="non_tax"/>
<label for="tax"> Sales tax</label>
<input type="text" name="tax" id="tax" />
<label for="totalAmount">Sales amount</label>
<input type="text" name="totalAmount" id="totalAmount" />
<input type="button" id="submitButton" value="Submit" />
</form>
<div id="resultItem"></div>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
