<?
//Insert record into database
require_once("config.inc");
require_once('connect.php');
$type=$_POST['type'];
$clerkId=$_POST['clerkId'];
$deptId=$_POST['deptId'];
$pluId=$_POST['pluId'];
$description=$_POST['description'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$tax=$_POST['tax'];
$amount=$_POST['post'];

$sql="INSERT INTO transactiom set type= \"$type\",
clerkId=\"$clerkId\",
deptId=\"$deptId\",
pluId=\"$pluId\"],
description=\"$description\",
quantity=\"$quantity\",
price=\"$price\",
tax=\"$tax\",
amount=\"$amount\" ";

$result1=mysql_query($sql);

 
//Get last inserted record (to return to jTable)
$result = mysql_query("SELECT * FROM transaction WHERE id = LAST_INSERT_ID()");
$row = mysql_fetch_array($result);
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
?>