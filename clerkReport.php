<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once('connect.php');
require_once('class_getdate.php');
$gd= new getDate;
$beginDate = isset($_GET['startdate']) ? $_GET['startdate'] : '';
$endDate = isset($_GET['enddate']) ? $_GET['enddate'] : '';
$datesReturned=$gd->getDateHandler($beginDate,$endDate);
$startDate = $datesReturned[0];
$stopDate = $datesReturned[1];

$sql = "select t1.pluID, sum(t1.amount) as sales, sum(t1.Tax) as taxAmount, t2.name as itemName  from  transaction as t1,  clerk as t2 where t1.clerkId=t2.id and (date BETWEEN \"$startDate\" AND \"$stopDate\") group  by t1.clerkId";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Problem with query " . $sql . " error message is " . mysql_error();		
}
?>
<!DOCTYPE html> 
<html> 
	<head>

	<title>Virtual Cash Register Clerk Report</title> 
	<? //include_once("meta.inc"); ?>
</head> 
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<!--<div data-role="header" class="header"><h1>Virtual Cash Register</h1></div>-->
<div data-role="content">
<h3><?php echo ORGNAME_DEF ?> Clerk Report</h3>
<h4>For the period starting <?php echo substr($startDate,0,10)?> and ending <?php echo substr($stopDate,0,10) ?> </h4>
<table class="table table-striped table-bordered table-condensed table-hover">
   <thead>
    <tr> 
        <th>Clerk</th>
		<th>Taxable</th>
		<th>Non-Tax</th>
		<th>Tax </th>
        <th>Sales Amount</th>

    </tr>
    </thead>
<? while($row=mysql_fetch_array($result)){
$taxable = $row['taxAmount']==0 ? 0.00 :  $row['taxAmount']/.06;

$notax = $row['sales']-($taxable + $row['taxAmount']);		
$line=  "<tr><td>" .$row[itemName] ."</td><td>" . sprintf('%01.2f',$taxable)."</td><td>" . sprintf('%01.2f',$notax)."</td><td>" . sprintf('%01.2f',$row[taxAmount]);
$line .= "</td><td>" . sprintf('%01.2f',$row[sales]); 	
		$line .= "</td></tr>";
$totalTaxable += $taxable;
$totalNonTax += $notax;			
$totalTax += $row['taxAmount'];
$totalAmount += $row['sales'];		
echo $line; 
}
$line=  "<tr><td>" . "Total" . "</td><td>" . sprintf('%01.2f',$totalTaxable). "</td><td>" . sprintf('%01.2f',$totalNonTax)."</td><td>" . sprintf('%01.2f',$totalTax);
$line .= "</td><td>" . sprintf('%01.2f',$totalAmount); 	
		$line .= "</td></tr>";
echo $line;		
?>
</table>
</div> <!--End of content-->
<!--<div data-role=footer><h1>Virtual Cash Register</h1></div>-->
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>