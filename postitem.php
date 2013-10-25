<?
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$dateStamp=$_GET['dateId'];
$type=$_GET['type'];
$role=$_GET['role'];
$clerkId = $_GET['clerkId'];
$deptId = $_GET['deptId'];
$pluId = $_GET['pluId'];
$descr = $_GET['descr'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];
$tax = $_GET['tax'];
$amount = $_GET['amount'];
date_default_timezone_set('America/Detroit');
$dateStamp=date("Y-m-d H:i:s");
if($role=='trn')
{
echo "Item not posted --Training";
}
if($role != 'trn')
{
	$sql = "insert into transaction set type=\"$type\",
			clerkId = \"$clerkId\",
			date=\"$dateStamp\",
			deptId = \"$deptId\",
			pluId = \"$pluId\",
			descr = \"$descr\",
			quantity =\"$quantity\",
			price = \"$price\",
			tax = \"$tax\",
			amount = \"$amount\" ";
			
	$result = mysql_query($sql);
	if(mysql_error() != ""){
	echo "Problem with query " . $sql . "error message is " . mysql_error();		
	}
	else { echo "item posted"; }
}	
?>