<?
//Insert record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$taxid1=$_GET['taxid1'];
$taxid2=$_GET['taxid2'];
$taxid3=$_GET['taxid3'];
$taxid4=$_GET['taxid4'];

$sql="INSERT INTO clerk set name= \"$name\",
taxid1 = \"$taxid1\",
taxid2 = \"$taxid2\",
taxid3 = \"$taxid3\",
taxid4 = \"$taxid\"
 where id = \"$id\" ";
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