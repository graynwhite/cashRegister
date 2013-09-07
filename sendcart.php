 <?php
 require_once('config.inc');
 require_once('connect.php');
  $to = 'cauleyfj64@gmail.com';
  $subject = 'Simple Cart Order';
  $content = $_POST;
 foreach($_POST as $key => $value){
  		echo "<br >" . $key . " " . $value;		
}  
  $body = '';
  for($i=1; $i < $content['itemCount'] + 1; $i++) {
  $name = 'item_name_'.$i;
  $quantity =  'item_quantity_'.$i;
  $price = 'item_price_'.$i;
  $dept='item_options_'.$i;
  $total= 'item_total_'.$i;
  $option_array = explode(',',$_POST['item_options_'.$i]);
  $dept_array = explode(':',$option_array[0]);
  $actualDeptid=$dept_array[1];
  $plu_array = explode(':',$option_array[1]);
  $clerk_array =explode(':',$option_array[2]);
  $qty=$content[$quantity];	
  $decr=$content[$name];
  $amount = $content[$price] * $content[$quantity];
  $pris=$actualDeptid == 1 ? .94 * $content[$price] : $content[$price];
  $tax = $actualDeptid == 1 ? .06 * $amount : 0.00;
  date_default_timezone_set('America/Detroit');
  $timestamp = date('Y-m-d H:i:s');
  $body .= 'item #'.$i.': ';
  $this_line = "name: " .$content[$name]  .', Qty: ' .$content[$quantity]. ', Price: '  .$content[$price]. ", "   . $content[$dept];
  $this_line .= " Actual dept id  " . $actualDeptid . " actualPluid " . $plu_array[1] . "  actual clerk id " . $clerk_array[1];
  $sql = "insert into transaction set type= \"001\", deptId = \"$actualDeptid\", clerkid = \"$clerk_array[1]\",";
  $sql .= " pluId = \"$plu_array[1]\", quantity = \"$qty\", descr = \"$decr\", ";
  $sql .= " price = \"$pris\", tax = \"$tax\", amount = \"$amount\", date =\"$timestamp\"  ";
  $this_line .= "<br /> " .$sql; 
  
  
  	
  
  $body .=$this_line;
  $body .= '<br />';
  $result = mysql_query($sql);
  if(mysql_error() != ''){
  	echo "<br /> Error with query </br />" . $sql . "<br /> " . mysql_error();
	quit;
	}
	if(mysql_affected_rows($result)<1){
	echo "<br /> No rows affected </br />" . $sql . "<br /> " . mysql_error();
	quit;
	}
  }
 
  $headers = 'From: webmaster@example.com' . "\r\n" .
             'Reply-To: webmaster@example.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();
 // mail($to, $subject, $body, $headers);
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Send cart</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<!--<link rel="stylesheet" href="../datepicker/jquery.ui.datepicker.mobile.css" /> -->
	<link rel="stylesheet" href="register.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"> </script>
	<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Send Cart</h1></div>
<div data-role="content">
<? echo $body ?>
</div><!--End of content-->
<div data-role=footer><h1>Send Cart</hi></div>
</div><!-- End of Page -->
<!-- ========================== -->

</body>
</html>