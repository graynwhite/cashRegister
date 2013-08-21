<?
//Insert record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$taxid1=$_POST['taxid1'];
$taxid2=$_POST['taxid2'];
$taxid3=$_POST['taxid3'];
$taxid4=$_POST['taxid4'];

$sql="Update department set name= \"$name\",
taxid1=\"$taxid1\",
taxid2=\"$taxid2\",
taxid3=\"$taxid3\",
taxid4=\"$taxid4\"
 where id = \"$id\" ";
$result=mysql_query($sql);

 

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>