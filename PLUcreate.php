<?
//Insert record into database
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once('connect.php');
$name=$_POST['name'];
$deptID=$_POST['deptID'];
$unitPrice=$_POST['unitPrice'];
$overide=$_POST['overide'];

$sql="INSERT INTO PLU set name= \"$name\",
unitPrice=\"$unitPrice\",
deptID=\"$deptID\",
overide=\"$overide\" ";
$result1=mysql_query($sql);

 
//Get last inserted record (to return to jTable)
$result = mysql_query("SELECT * FROM PLU WHERE id = LAST_INSERT_ID()");
$row = mysql_fetch_array($result);
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
?>