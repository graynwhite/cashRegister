<?
//Update record into database
require_once('connect.php');
$id=$_POST['id'];
$date=$_POST['date'];
$type=$_POST['type'];
$clerkId=$_POST['clerkId'];
$deptId=$_POST['deptId'];
$pluId=$_POST['pluId'];
$descr=$_POST['descr'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$tax=$_POST['tax'];
$amount=$_POST['amount'];
$message ="";
$sql="UPDATE transaction set type= \"$type\",
clerkId=\"$clerkId\",
deptId=\"$deptId\",
pluId=\"$pluId\",
descr=\"$descr\",
quantity=\"$quantity\",
price=\"$price\",
tax=\"$tax\",
amount=\"$amount\"
where id = \"$id\" ";
$result=mysql_query($sql);
if(mysql_error() != ''){
$Result = "Not Ok";
$message = "<br />Problem with the query <br />" . $sql . "<br /> " . mysql_error();
}else{
$Result = "OK";
}

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = $Result;
$jTableResult['Message']= $message;
print json_encode($jTableResult);
?>