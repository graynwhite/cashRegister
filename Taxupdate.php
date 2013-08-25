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
if(mysql_error() != ''){
$Result = "Not Ok";
$message = "<br />Problem with the query <br />" . $sql . "<br /> " . mysql_error();
}else{
$Result = "OK";
}

 

 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = $result;
$jTableResult['Message']= $message;
print json_encode($jTableResult);
?>