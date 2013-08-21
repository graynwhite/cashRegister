<?
//Update record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$deptID=$_POST['deptID'];
$unitPrice=$_POST['unitPrice'];
$overide=$_POST['overide'];

$sql="UPDATE PLU set name= \"$name\",
unitPrice=\"$unitPrice\",
deptID=\"$deptID\",
overide=\"$overide\"
where id = \"$id\" ";
$Result=mysql_query($sql);

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>