<!DOCTYPE html> 
<html> 
	<head>
	<? require_once('meta.inc'); ?>
	<script>
	$(document).ready(function(){
	$('#clearButtonArea').hide();
	 $( document ).bind( "mobileinit", function(){
    $.mobile.page.prototype.options.degradeInputs.date = true;
  });	
	
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
		var startdate=$('#startdate').val();
		var enddate=$('#enddate').val();
		$.get(program,{
		startdate: startdate,
		enddate: enddate
		},function(data){
		
			$('#clearButtonArea').show();
			$('#returnArea').html(data)
			})
			
			});
		
		$('#btnClear').click(function(){
		console.log("clear button clicked");
   			window.location.reload();
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
  <fieldset>
  <legend>Select a period (Optional defaults to today)</legend>
  <label for='startdate'>Start Date</label>
  <input type="date" id='startdate'  />
  <label for='enddate'>End Date</label>
  <input type="date" id="enddate" />
  </fieldset>
  <input type="button" value="Go" id="btnGo"/>
  
  
  <div id="returnArea"></div>
  <div id="clearButtonArea">
  <input type="button" id="btnClear" value="clear"/>
  </div>
  
</form>
</div><!--End of content-->
<div data-role=footer><h1>Virtual Cash Register Report Request</h1></div>
<
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>