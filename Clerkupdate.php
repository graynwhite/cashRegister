<?
//Insert record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$password=$_POST['password'];
$role=$_POST['role'];
$phone=$_POST['phone'];
$sql="INSERT INTO clerk set name= \"$name\",
password = \"$password\",
role = \"$role\",
phone = \"$phone\"
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