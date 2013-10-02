<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");

date_default_timezone_set('America/Detroit');
$dateStamp=date("Y-m-d H:i:s");
if(!isset($_COOKIE['loginTime'])){
setcookie("loginTime",$dateStamp,time()+7200);
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
	console.log("document ready");
	console.log("Cookie value " + $.dough("clerkRole"));
	 if($.dough("clerkRole") == "adm" || $.dough("clerkRole")=="mgr"){
		$('#actionArea').hide();
		$('#managerArea').show();
		$('#tryAgainArea').hide();
		$('#clerkOkArea').hide();
		}else{
		$('#actionArea').show();
		$('#tryAgainArea').hide();
		$('#clerkOkArea').hide();
		$('#managerArea').hide();
		$.dough("clerkName","remove",{ path: "current" });
		$.dough("clerkId","remove",{ path: "current" });
		$.dough("clerkRole","remove",{ path: "current" });
		}
		
		$('#btnLogin').click(function(){
		
		var name = $('#clerkName').val();
		var pswd = $('#password').val();
			
		$.getJSON('validateLogin.php',{
		name: name,
		pswd: pswd
		}, function(data) {
		$('#returnedClerkName').val(data.clerkName);
		$('#returnedClerkId').val(data.id);
		$('#returnedClerkRole').val(data.role);
		var clerkName= data.clerkName;
		var clerkId = data.id;
		var clerkRole = data.role;
		date_default_timezone_set ("Detroit");
		var timelogin=mktime();
		
		
		$.dough("clerkName",clerkName,{ expires: 1 , path: "current" });
		$.dough("clerkId",clerkId,{ expires: 1 , path: "current" });
		$.dough("clerkRole",clerkRole,{ expires: 1 , path: "current" });
		//$.dough("loginTime",timelogin, { expires: 1 , path: "current" });
		
		
			$('#actionArea').hide();
			if(data.role=="mgr"){
				$('#managerArea').show();
				}
			if(data.role=="adm"){
				$('#managerArea').show();
				}	
			if(data.role=="clk"){
				$('#clerkOkArea').show();
				}
			if(data.role=="trn"){
				$('#clerkOkArea').show();
				}	
			if(data.role=="  "){
				$('#tryAgainArea').show();
				}
					
		
		})
	
	});
	
	
	
	
	
	}); 
	</script>
	
</head> 
<body><div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Gray and White Virtual Cash Register</h1></div>
<div data-role="content">
<h3><? echo ORGNAME_DEF ?></h3>

<div id="actionArea">
<form name="login" action="">
	
  <label for="clerkName">Name</label>
  <input type="text" name="clerkName" id="clerkName" value="" placeholder='Your cash register login name here'>
    <label for="password">Cash Register login password</label>
    <input type="password" name="password" id="password"  placeholder="">
	<input type="button" name="btnLogin" id="btnLogin" value="login">
</form> 
</div> <!--End of actionArea -->

<div id="tryAgainArea">
<h2>Your login was not accepted! </h2>
<a href="http://www.graynwhite.com/cashRegister/" target="_self"><input type="button" value="Try again?"></a>
</div> 

<div id="clerkOkArea">
<h2>You are logged In!</h2>
<a href="http://www.graynwhite.com/cashRegister/simpleCartRegister.php"  data-ajax="false" ><input type="button" value="Continue"></a>
</div>

<div id="managerArea">
<h2>You are logged in as a Manager</h2>
	<a href="priceList.php"><input type="button" value="Price List"></a>
	<a href="reportRequest.php"><input type="button" id="btnReport" name="btnReport" value=" Sales Reports"></a>
	<a href="maintainTrans.php" target="_blank"><input type="button" id="btnTrnsMaint" name="btnTrnsMaint" value="Transaction Maintenance"></a>
	<a href="maintainClerk.php" target="_blank"><input type="button" id="btnClerkMaint" name="btnClerkMaint" value="Clerk Maintenance"></a>
	<a href="maintainDept.php" target="_blank"><input type="button" id="btnDeptMaint" name="btnDeptMaint" value="Department Maintenance"></a>
	<a href="maintainPLU.php" target="_blank"><input type="button" id="btnPLUMaint" name="btnPLUMaint" value="PLU Maintenance"></a>
	<a href="maintainTax.php" target="_blank"><input type="button" id="btnTaxMaint" name="btnTaxMaint" value="Tax Maintenance"></a>
	<a href="http://www.graynwhite.com/cashRegister/simpleCartRegister.php" data-ajax="false" target="_blank"><input type="button" value="Cash Register"></a>
	
</div>
</div><!--End of content-->
<div data-role=footer><h1>Gray and White Virtual Cash Register</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
