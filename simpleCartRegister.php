<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$savedAs = $_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
$sql = "select * from PLU where active = true order by name";
$result = mysql_query($sql);
if(mysql_error() != ""){
	echo "Trouble with mysql request " . mysql_error() . "<br />" . $sql;
	quit;
	}
	$selectPhrase ="<option value=\"0\" > Select an item </option> \n";
	while($row=mysql_fetch_array($result)){
	$selectPhrase .= "<option value=\"" . $row['id'] . "\">" . "Selected: " . $row['name'] . " <br /> select another</option> \n";
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
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<!--<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">-->
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<!--<link rel="stylesheet" href="../datepicker/jquery.ui.datepicker.mobile.css" /> -->
	<link rel="stylesheet" href="register.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link href="dispatchPanel.css" rel="stylesheet" type="text/css" />
	
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js">
	<!--<script src-"http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->	
	<!--<script language="javascript" src="../jsound/jsound/jquery18.js"></script>
	<script language="javascript" src="../jsound/jsound/jsound.js"></script>-->
	<!--<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>-->
	<script src="../datepicker/jQuery.ui.datepicker.js"></script>
  	<script src="../datepicker/jquery.ui.datepicker.mobile.js"></script>
	<script src="../dough/Dough/dough.js"></script>
	<script>
  //reset type=date inputs to text
  $( document ).bind( "mobileinit", function(){
    $.mobile.page.prototype.options.degradeInputs.date = true;
  });	
</script>
	
  
	
	<script src="../simplecart/simpleCart.js"></script>
	<script src="crSimpleCart.js"></script>
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
	 $selectPhrase ="<option value=\"0\" > Select an item </option> \n";
	 
	 itemamount=0.0;
	 itemtaxamount=0.0;
	 itemgrossamount=0.0;
	}
	
	
	$(document).ready(function(){
	console.log("document ready");
	if($.dough("clerkRole") == "adm" || $.dough("clerkRole")=="mgr"){
		$('#managerArea').show();
		}else{
		$('#managerArea').hide();
		} 
	$('#departmentLookup').hide();
	$('#voidItemArea').hide();
	$('#voidSaleArea').hide();
	
	
	$('#selectPLU').click(function(){
	//console.log("PLU selected");
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
				var name = data.name;
				var price = data.price;
				var deptid = data.dptid;
				var pluid = data.id;
				var clerkid = $.dough('clerkId');
				var quantity = 1;
				if(deptid!=3){
				price = 1.06*price;
				}
				var thisitem = simpleCart.add({name: name, price:  price, deptid: deptid, pluid: pluid, clerkid: clerkid, quantity:  quantity});	
				$selectPhrase ="<option value=\"0\" > Select an item </option> \n";
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
	if($('#deptid').val() != 3){
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
	role: $.dough("clerkRole"),
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
	$('#salesubamount').val(" This sale  amount " + saleamount.toFixed(2) + " tax " + saletaxamount.toFixed(2) + "  Total " + 	salegrossamount.toFixed(2)); 
	});
	
	$('#saleTotal').click(function(){
	
	var change = $('#cashReceived').val() - simpleCart.grandTotal();
	$('#change').val(" Change amount $" + change.toFixed(2));
	simpleCart.checkout();
	saleamount=0;
	saletaxamount=0;
	salegrossamount=0;
	simpleCart.empty();
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
<a  href="shiftReport.php"  data-ajax=false ><input type="button" id="btnLogout" value="Logout"></a>
<a href="shiftReport.php" data-ajax=false><input type="button" value="Interim Report"></a></div>
<div data-role="content">
<h3> Logged in as <? echo $savedAs ?></h3>

<form name="transaction" action="">
	<input type="hidden" name="hiddenClerkName" value="" id="<? echo $savedAs ?>">
	<input type="hidden" name="clerkId" value="<? echo $clerkId ?>">
	<p>
	Cart: <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)
	<br />
	<a href="javascript:;" class="simpleCart_empty">empty cart</a>
	<br />
	</p> 
    <label for="selectPLU">Price Lookup (Includes tax where applicable)</label>
	<!--<input type="button" value="Select Item" name="selectPLU" id="selectPLU">-->
    <select name="selctPLU" id="selectPLU">
      <? echo $selectPhrase ?>
	
    </select>
	<div id="managerArea">
	<a href="index.php" data-ajax=false><input type="button" value="Manager Options"></a>
	</div>
	<div class="simpleCart_items" style="font-size:large" ></div>
		
	-----------------------------<br />
	Cart Total: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal" style="font-size:large"></span> <br />
	<!--<a href="javascript:;" class="simpleCart_checkout">checkout</a>	-->		 
	    
    <label for="cashReceived">Cash Received</label>
    <input type="number" name="cashReceived" id="cashReceived">
    <input type="button" name="saletotal" value="Post this sale" id="saleTotal">
  
    <label for="change">Change</label>
    <input type="text" name="change" id="change">
  
</form>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>
</div><!-- End of Page -->
</body>
