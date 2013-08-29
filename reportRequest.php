<!DOCTYPE html> 
<html> 
	<head>
	<? require_once('meta.inc'); ?>
	<script>
	$(document).ready(function(){
		$('#btnGo').click(function(){
		console.log("go button clicked");
		var program="unknown";
		if($('#radio1').prop('checked')){
			program='salesReport.php';
			}
		if($('#radio2').prop('checked')){
			program='clerkReport.php';
			}
		if($('#radio3').prop('checked')){
			program='deptReport.php';
			}		
		console.log("Program  is " + program);
		$.get(program,function(data){
			$('#returnArea').html(data)})	
		});
	}); <!--End of document ready -->
	</script>
	<title>Report Request</title> 
	<?php require_once("meta.inc") ?>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Virtual Cash Register Report Request</h1></div>
<div data-role="content">
<form>
  <div id="reportType">
  <fieldset data-role='controlgroup' >
   <legend>Type of Report</legend>
    <input type="radio" id="radio1" name="radio" /><label for="radio1">Product</label>
    <input type="radio" id="radio2" name="radio" checked="checked" /><label for="radio2">Clerk</label>
    <input type="radio" id="radio3" name="radio" /><label for="radio3">Department</label>
	</fieldset>
  </div>
  
  <div id="reportPeriod">
  
	<fieldset data-role='controlgroup' >
	<legend>Select Period</legend>  
	<input type="radio" id="radio8" name="radio2" checked="checked"/><label for="radio8">Today</label>
	<input type="radio" id="radio9" name="radio2" /><label for="radio9">Yesterday</label>  
    <input type="radio" id="radio4" name="radio2" /><label for="radio4">Current Week</label>
    <input type="radio" id="radio5" name="radio2"  /><label for="radio5">Last Week</label>
    <input type="radio" id="radio6" name="radio2" /><label for="radio6">Current Month</label>
	<input type="radio" id="radio7" name="radio2" /><label for="radio7">Last Month</label>
	</fieldset>
  </div>
  <input type="button" value="Go" id="btnGo"/>
  <div id="returnArea"></div>
</form>
</div><!--End of content-->
<div data-role=footer><h1>Virtual Cash Register Report Request</h1></div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>