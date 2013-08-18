<?php

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
<h3>Logged in as <script>$.dough("clerkName")</script> </h3>

<form name="transaction" action="">
	<input type="hidden" name="hiddenClerkName" value="" id="hiddenClerkName">
	<input type="hidden" name="clerkId" value="<? echo $clerkId ?>">
	  <label for="quantity">Number of items</label>
  <input type="number" name="quantity" id="quantity" value=1>
    <label for="plu">Price Lookup</label>
    <select name="plu" id="select">
      <option value="food">Food</option>
      <option value="donated">Donated</option>
      <option value="merchandise">Merchandise</option>
	
    </select>
    <label for="dept">Department</label>
	<select name="dept" id="select">
      <option value="notax">Non Taxable</option>
      <option value="tax">Taxable</option>
      
	
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
