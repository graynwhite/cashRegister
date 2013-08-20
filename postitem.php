<?
require_once("connect.php");
$type=$_GET['type'];
$clerkId = $_GET['clerkId'];
$deptId = $_GET['deptId'];
$pluId = $_GET['pluId'];
$descr = $_GET['descr'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];
$tax = $_GET['tax'];
$amount = $_GET['amount'];
$sql = "insert into transaction set type=\"$type\",
		clerkId = \"$clerkId\",
		deptId = \"$deptId\",
		pluId = \"$pluId\",
		description = \"$descr\",
		quantity =\"$quantity\",
		price = \"$price\",
		tax = \"$tax\",
		amount = \"$amount\" ";
		
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Problem with query " . $sql . "error message is " . mysql_error();		
}
else { echo "item posted"; }
?>