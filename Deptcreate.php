<?
//Insert record into database
require_once('connect.php');
$name=$_POST['name'];
$taxid1=$_POST['taxid1'];
$taxid2=$_POST['taxid2'];
$taxid3=$_POST['taxid3'];
$taxid4=$_POST['taxid4'];



$sql="INSERT INTO department set name= \"$name\",
taxid1=\"$taxid1\",
taxid2=\"$taxid2\",
taxid3=\"$taxid3\",
taxid4=\"$taxid4\" ";

$result1=mysql_query($sql);

 
//Get last inserted record (to return to jTable)
$result = mysql_query("SELECT * FROM department WHERE id = LAST_INSERT_ID()");
$row = mysql_fetch_array($result);
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Record'] = $row;
print json_encode($jTableResult);
?>