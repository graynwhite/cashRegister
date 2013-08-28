<?
require_once("config.inc");
require_once("connect.php");
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
if($role=='trn')
{
echo "Item not posted --Training";
}
if($role != 'trn')
{
	$sql = "insert into transaction set type=\"$type\",
			clerkId = \"$clerkId\",
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