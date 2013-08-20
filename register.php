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
	var saleamount= 0.0;
	var saletaxAmount = 0.0;
	var salegrossamount= 0.0;
	var itemamount=0.0;
	var itemtaxamount=0.0;
	var itemgrossamount=0.0;
	
	function clearAmounts(){
	 saleamount= 0.0;
	 saletaxAmount = 0.0;
	 salegrossamount= 0.0;
	 itemamount=0.0;
	 itemtaxamount=0.0;
	 itemgrossamount=0.0;
	}
	
	
	$(document).ready(function(){ 
	
	$('#selectPLU').click(function(){
	console.log("PLU selected");
	var pluid = $('#selectPLU').val();
	var pluname ="anything";
	if(pluid > 0){
		
		console.log("plu id is " + pluid);
		$.getJSON('getPluData.php',{
			pluid: pluid,
			pluname: pluname
			},function(data){
				/*console.log("at data");
				console.log("here is the data " + data);
				console.log("description is " + data.name);*/
				$('#itemDescription').val(data.name);
				$('#price').val(data.price);
				$('#deptid').val(data.dptid);
				
				} <!-- end of data function -->
		 )<!-- end of getjson
		 
		}else{console.log("skipped json because id not gt 0");
	} <!-- End of if statement --.	
	
	});<!-- End of selectPLU -->

	$('#enter').click(function(){
	console.log("enter clicked");
	var quantity = $('#quantity').val();
	var price = $('#price').val();
	 itemamount= quantity * price;
	itemtaxamount = 0;
	if($('#deptid').val() == 1){
	itemtaxamount = itemamount * .06;
	}
	 itemgrossamount = itemamount + itemtaxamount;
	$("#itemamount").val(" this item amount is " + itemamount.toFixed(2) + " plus tax of " + itemtaxamount.toFixed(2) + " total " + itemgrossamount.toFixed(2));
	
	
	});
	
	$('#selectDept').click(function(){
	var dptsel = $('#selectDept').val();
		if(dptsel > 0){
		$('#deptid').val(dptsel);
		} 
	});
	
	$('#postitem').click(function(){
	$.get('postitem.php',{
	type: '001',
	clerkId: $.dough("clerkId"),
	deptId:	 $('#deptid').val(),
	pluId:	 $('#selectPLU').val(),
	descr: $('#itemDescription').val(),
	quantity: $('#quantity').val(),
	price:	$('#price').val(),
	tax:	itemtaxamount.toFixed(2),
	amount:	itemgrossamount.toFixed(2)
	}, function(data){
	$('#resultItem').html(data);
	console.log("ready to play the sound");
	var aSound = document.createElement('audio');
     aSound.setAttribute('src', 'cash-register-05-wav');
     aSound.play();
	 console.log("sound should have played");
	 $('#resutItem').html(" ");
	})
	
	});
	
	}); 
	</script>
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Cash Register</h1></div>
<div data-role="content">
<h3> Logged in as <? echo $savedAs ?></h3>

<form name="transaction" action="">
	<input type="hidden" name="hiddenClerkName" value="" id="<? echo $savedAs ?>">
	<input type="hidden" name="clerkId" value="<? echo $clerkId ?>">
	  <label for="quantity">Number of items</label>
  <input type="number" name="quantity" id="quantity" value=1>
    <label for="selectPLU">Price Lookup</label>
    <select name="selctPLU" id="selectPLU">
      <? echo $selectPhrase ?>
	
    </select>
    <label for="selctDept">Department</label>
	<select name="selctDept" id="selectDept">
      <? echo $selectPhrase2 ?>
      
	
    </select>
	<label for="itemDescription">Item description</label>
	<input type="text" id="itemDescription" name="itemDescription" value="">
	
    <label for="price">Price per unit</label>
  <input type="number" name="price" id="price" value="">
  
  <label for="deptid">Department Id Number (Use PLU or Department Button)</label>
  <input type="text" name="deptid" id="deptid" value="">
 
  
      <label for="enter">Enter Item</label>
    <input type="button" name="Enter " value="Enter" id="enter">
	
	<label for="itemamount">Amount for this transaction</label>
  <input type="text" name="itemamount" id="itemamount" value="">
   <input type="button" name="void" value="Void this amount" id="voiditem">
    <input type="button" name="postsale" value="Post this item" id="postitem">
	<div id="resultItem"></div>
    <input type="button" name="subtotal" value="Sub Total this sale" id="subtotal">
	
    <input type="button" name="void" value="Void this sale" id="voidsale">
    
    
    <label for="cashReceived">Cash Received</label>
    <input type="number" name="cashReceived" id="cashReceived">
    <input type="button" name="saletotal" value="Total for this sale" id="saleTotal">
  
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
