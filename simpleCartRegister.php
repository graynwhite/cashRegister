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
	$selectPhrase .= "<option value=\"" . $row['id'] . "\">" .  $row['name'] . "</option> \n";
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
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
	<link href="dispatchPanel.css" rel="stylesheet" type="text/css" />
	
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js">
	<script src="http://www.graynwhite.com/taxi/jqueryPopUp.js"></script>
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
	$('#unlistedItemsArea').hide();
	
	
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
				if(pluid !='48'){
				var thisitem = simpleCart.add({name: name, price:  price, deptid: deptid, pluid: pluid, clerkid: clerkid, quantity:  quantity});	
				$selectPhrase ="<option value=\"0\" > Select an item </option> \n";
				}else{
				$('#unlistedItemsArea').show();
				}
				} <!-- end of data function -->
		 )<!-- end of getjson
		 
		}else{console.log("skipped json because id not gt 0");
	} <!-- End of if statement --.	
	
	});<!-- End of selectPLU -->
	$('#unlistedSubmit').click(function(){
	var name = $('#unlistedName').val();
	var price = $('#unlistedPrice').val();
	var deptid = 3;
	var pluid = 48;
	var clerkid = $.dough('clerkId');
	var quantity = 1;
	deptid = $('#unlistTax').prop('checked') ? 1 : deptid;
	deptid = $('#unlistDonate').prop('checked') ? 2 : deptid;
	console.log("value of deptid " + deptid);
	price = deptid != 3 ?price * 1.06  :price;
	console.log("price is " + price);	
	var thisitem = simpleCart.add({name: name, price:  price, deptid: deptid, pluid: pluid, clerkid: clerkid, quantity:  quantity});	
	$('#unlistedItemsArea').hide();
	});	
	
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
    <style type="text/css">
<!--
.item_decrement{
	width: 40px
	}
.simpleCart_decrement {
	background-color: #FF0000;
	width: 40px;
	color: #FFFFFF;
	height: auto;
	padding-right: 9px;
	padding-left: 9px;
	font-size: 24px;
	text-decoration:none;
	
}
.simpleCart_grandTotal {
	border-top-style: ridge;
	border-right-style: ridge;
	border-bottom-style: ridge;
	border-left-style: ridge;
	border-top-color: #000000;
	border-right-color: #000000;
	border-bottom-color: #000000;
	border-left-color: #000000;
	padding: 2px;
}
.simpleCart_increment {
	background-color: #00FF00;
	width: 32px;
	color: #FFFFFF;
	height: auto;
	padding-right: 8px;
	padding-left: 8px;
	font-size: 24px;
	text-decoration:none;
	
}

-->
    </style>
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
      <? echo   $selectPhrase  ?>
	
    </select>
	<div id="managerArea">
	<a href="index.php" data-ajax=false><input type="button" value="Manager Options"></a>
	</div>
	<div id="unlistedItemsArea" class="example4demo">
	<h3>Unlisted Item Input</h3>
	<form id="unlistedForm">
	<label for="unlistedName">Name of item</label>
	<input type="text" id="unlistedName">
	<label for unlistedPrice>Price</label>
	<input type="text" id="unlistedPrice">
	<fieldset data-role="controlgroup" data-type="horizontal">
		<input type="radio" name="rcaction" id="unlistTax" value="Taxable" /><label for="unlistTax">Taxable</label>
	<input type="radio" name="rcaction" id="unlistDonate" value="Donated" /><label for="unlistDonate">Donated</label>
	<input type="radio" name="rcaction" id="unlistFood"  value="Food" checked="checked"/><label for="unlistFood">Food</label>
	</fieldset>
	<input type="button" id="unlistedSubmit" value="Submit unlisted item data">
	
	</form>
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
