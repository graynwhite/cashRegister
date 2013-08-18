<?php
require_once("connect.php");
$savedAs = $_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
$sql = "select * from PLU order by name";
$result = mysql_query($sql);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql;
	quit;
	}
	$selectPhrase ="<option value=\"0\" > Not selected </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase .= "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option> \n";
	}
	
$sql2="select * from department order by name";
$result = mysql_query($sql2);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql2;
	quit;
	}
	$selectPhrase2 ="<option value=\"0\" > Not selected </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase2 .= "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option> \n";
	}	
	
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Cash Register Simulator</title> 
	<?php require_once('meta.inc');?>
	<script>
	$(document).ready(function(){ 
	var headerClerkName = $.dough("clerkName");
	console.log("got cookie " + headerClerkName);
	$.get(getLoggedIn.php),{id: $.dough("clerkId")}
		
	$('#headerClerkName').val($.dough("clerkName"));
	
	$('#hiddenClerkName').val(headerClerkName);
	
	
	$('#enter').click(function(){
	console.log("enter clicked");
	var quantity = $('#quantity').val();
	var price = $('#price').val();
	var tranamount= quantity * price;
	console.log("price is " + price);
	console.log("Quantity is " + quantity);
	console.log("transaction amount = " + tranamount);
	
	});
	
	
	
	
	
	}); 
	</script>
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Cash Register</h1></div>
<div data-role="content">
<h3> Looged in as <? echo $savedAs ?></h3>

<form name="transaction" action="">
	<input type="hidden" name="hiddenClerkName" value="" id="<? echo $savedAs ?>">
	<input type="hidden" name="clerkId" value="<? echo $clerkId ?>">
	  <label for="quantity">Number of items</label>
  <input type="number" name="quantity" id="quantity" value=1>
    <label for="plu">Price Lookup</label>
    <select name="plu" id="select">
      <? echo $selectPhrase ?>
	
    </select>
    <label for="dept">Department</label>
	<select name="dept" id="select">
      <? echo $selectPhrase2 ?>
      
	
    </select>
	<label for="itemDescription">Item description</label>
	<input type="text" id="itemDescription">
	
    <label for="price">Price per unit</label>
  <input type="number" name="price" id="price">
 
  
      <label for="enter">Enter Item</label>
    <input type="button" name="Enter " value="Enter" id="enter">
   
    <input type="button" name="subtotal" value="Sub Total" id="subtotal">
    
    
    <input type="button" name="void" value="Void" id="void">
    <label for="cashReceived">Cash Received</label>
    <input type="number" name="cashReceived" id="cashReceived">
    <input type="button" name="total" value="Total">
  
    <label for="change">Change</label>
    <input type="text" name="change" id="change">
  
</form>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
<div data-role=page id="subtotal" data-theme="b"/> 
<div data-role="header" class="header"><h1>Subtotal</h1></div>
<div data-role="content">
<div id="transactionArea"></div>
<input name="totalSoFar" type="text" id="totalSoFar">
<input name="Next item"  id="nextItem" type="button">
</div><!--End of content-->
<div data-role=footer><h1>Subtotal<h1></di>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
