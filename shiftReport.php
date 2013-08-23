<?php
require_once("connect.php");
$clerkName=$_COOKIE['clerkName'];
$clerkId = $_COOKIE['clerkId'];
//echo $clerkId;
$logintime=$_COOKIE['loginTime'];
$loginDate=date("Y-m-d h:m:s",$logintime);
//echo "<br />Time before deduction " . $loginDate; 

$sql="select * from transaction where date >= \"$loginDate\" && clerkId = \"$clerkId\" order by date";
$result=mysql_query($sql);
if(mysql_error() != ''){
echo mysql_error();
}
$html="<h2>Mini Shift report</h2> <h3>for $clerkName : shift beginning  $loginDate </h3>";

$totalTax=0;
$totalAmount=0;
while($row=mysql_fetch_array($result)){

$html.= "<br /> " . $row['descr'] . " Tax " . number_format($row['tax'], 2, '.', ','). " Amount " . number_format($row['amount'], 2, '.', ',');
$totalTax += $row['tax'];
$totalAmount += $row['amount'];
}
$html .= "<hr /><br /> Total Tax  " . number_format($TotalTax, 2, '.', ',') . "  Total Amount " . number_format($totalAmount, 2, '.', ',');
$html.="<h4>Prepared by the Gray and White Virtual Cash Register";
echo $html;

?>