<?
//Insert record into database
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once('connect.php');
$name=$_POST['name'];
$percent=$_POST['percent'];




$sql="INSERT INTO tax set name= \"$name\",
percent=\"$percent\" ";


$result1=mysql_query($sql);

 
//Get last inserted record (to return to jTable)
$result = mysql_query("SELECT * FROM tax WHERE id = LAST_INSERT_ID()");
$row = mysql_fetch_array($result);
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
?>