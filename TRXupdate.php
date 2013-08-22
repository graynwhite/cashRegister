<?
//Update record into database
require_once('connect.php');
$id=$_POST['id'];
$id=$_POST['date'];
$type=$_POST['type'];
$clerkId=$_POST['clerkId'];
$deptId=$_POST['deptId'];
$pluId=$_POST['pluId'];
$descr=$_POST['descr'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$tax=$_POST['tax'];
$amount=$_POST['post'];

$sql="UPDATE transaction set name= \"$type\",
clerkId=\"$clerkId\",
deptId=\"$deptId\",
pluId=\"$pluId\"],
description=\"$description\",
quantity=\"$quantity\",
price=\"$price\",
tax=\"$tax\",
amount=\"$amount\"
where id = \"$id\" ";
$Result=mysql_query($sql);

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>