<?
//Insert record into database
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$password=$_POST['password'];
$role=$_POST['role'];
$phone=$_POST['phone'];

$sql="UPDATE clerk set name= \"$name\",
password=\"$password\",
role=\"$role\",
phone=\"$phone\"
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