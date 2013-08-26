<?php
require_once("config.inc");
require_once("connect.php");
$savedAs = $_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
$sql = "select * from PLU order by name";
$result = mysql_query($sql);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql;
	quit;
	}
	$selectPhrase ="<option value=\"0\" > Select an item </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase .= "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option> \n";
	}
	
$sql2="select * from department order by name";
$result = mysql_query($sql2);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql2;
	quit;
	}
	$selectPhrase2 ="<option value=\"0\" > Select Department </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase2 .= "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option> \n";
	}	
	
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Virtual Cash Register</title> 
	<?php require_once('meta.inc');?>
	<script src="mktime.js"></script>
	<script>
	var saleamount= 0.0;
	var saletaxamount = 0.0;
	var salegrossamount= 0.0;
	var itemamount=0.0;
	var itemtaxamount=0.0;
	var itemgrossamount=0.0;
	var shiftamount=0.0;
	var shifttaxamount=0.0;
	var shiftgrossAmount=0.0;
	
	function clearitem(){
	 $('#itemDescription').val("");
	 $('#price').val("");
	 $('#deptid').val("");
	 $('#quantity').val(1);
	 $('#itemamount').val("");
	 $('#departmentLookup').hide();
	 
	 itemamount=0.0;
	 itemtaxamount=0.0;
	 itemgrossamount=0.0;
	}
	
	
	$(document).ready(function(){ 
	$('#departmentLookup').hide();
	$('#voidItemArea').hide();
	$('#voidSaleArea').hide();
	
	
	$('#selectPLU').click(function(){
	console.log("PLU selected");
	var pluid = $('#selectPLU').val();
	var pluname ="anything";
	$('#resultItem').html("");
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
	 itemgrossamount = itemamount * 1.06;
	 }else{
	 itemtaxamount=0;
	 itemgrossamount= itemamount;
	 }
	$("#itemamount").val(" this item amount is " + itemamount.toFixed(2) + " plus tax of " + itemtaxamount.toFixed(2) + " total " + itemgrossamount.toFixed(2));
	
	
	});
	
	$('#selectDept').click(function(){
	var dptsel = $('#selectDept').val();
		if(dptsel > 0){
		$('#deptid').val(dptsel);
		} 
	});
	
	$('#postitem').click(function(){
	saleamount += itemamount;
	saletaxamount += itemtaxamount;
	salegrossamount += itemgrossamount;
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
	clearitem();
	
	
	 $('#resutItem').html(" ");
	})
	
	});
	
	$('#subtotal').click(function(){
	$('#salesubamount').val(" This sale  amount " + saleamount.toFixed(2) + " tax " + saletaxamount.toFixed(2) + "  Total " + salegrossamount.toFixed(2)); 
	});
	
	$('#saleTotal').click(function(){
	var change = $('#cashReceived').val() - salegrossamount;
	$('#change').val(" this is the change amount $" + change.toFixed(2));
	saleamount=0;
	saletaxamount=0;
	salegrossamount=0;
	$('#salesubamount').val(''); 
	});
	
	$('#itemDescription').blur(function(){
	console.log("description changed");
	if($('#deptid').val() == ""){
		$('#departmentLookup').show();
		}
	});
	 
	
	 
	 
	 
	}); 
	</script>
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Virtual Cash Register</h1>
<a href="logout.php"><input type="button" id="btnLogout" value="Logout"></a></div>
<div data-role="content">
<h3> Logged in as <? echo $savedAs ?></h3>

<form name="transaction" action="">
	<input type="hidden" name="hiddenClerkName" value="" id="<? echo $savedAs ?>">
	<input type="hidden" name="clerkId" value="<? echo $clerkId ?>">
	 
    <label for="selectPLU">Price Lookup</label>
    <select name="selctPLU" id="selectPLU">
      <? echo $selectPhrase ?>
	
    </select>
			 
	 <label for="quantity">Number of items</label>
  <input type="number" name="quantity" id="quantity" value=1>
  
	<label for="itemDescription">Item description</label>
	<input type="text" id="itemDescription" name="itemDescription" value="">
	
   
  
  <div id="departmentLookup">
    <label for="selctDept">Department</label>
	<select name="selctDept" id="selectDept">
      <? echo $selectPhrase2 ?>
         </select>
		 </div>

  <label for="deptid">Department Id Number (Use PLU or Department Button)</label>
  <input type="text" name="deptid" id="deptid" value="">
 
   <label for="price">Price per unit</label>
  <input type="number" name="price" id="price" value="">
  
  
      <label for="enter">Enter Item</label>
    <input type="button" name="Enter " value="Calculate this item amount" id="enter">
	
	<label for="itemamount">Amount for this transaction</label>
  <input type="text" name="itemamount" id="itemamount" value="">
  <div id="voidItemArea">
   <input type="button" name="void" value="Void this amount" id="voiditem">
   </div>
   <input type="button" name="postsale" value="Post this item" id="postitem">
	
	
	<div id="resultItem"></div>
	
	<div id="saleSubTotalArea" >
    <input type="button" name="subtotal" value="Sub Total this sale" id="subtotal">
	<label for="salesubamount">Sub Total for this sale</label>
  <input type="text" name="salesubamount" id="salesubamount" value="" >
  </div>
  
  	<div id="voidSaleArea">
    <input type="button" name="void" value="Void this sale" id="voidsale">
    </div>
    
    <label for="cashReceived">Cash Received</label>
    <input type="number" name="cashReceived" id="cashReceived">
    <input type="button" name="saletotal" value="Post this sale" id="saleTotal">
  
    <label for="change">Change</label>
    <input type="text" name="change" id="change">
  
</form>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>
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
