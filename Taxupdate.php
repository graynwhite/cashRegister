<?
//Insert record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$percent=$_POST['percent'];


$sql="Update tax set name= \"$name\",
percent=\"$percent\"
 where id = \"$id\" ";
$result=mysql_query($sql);

 

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>