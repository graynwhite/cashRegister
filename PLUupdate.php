<?

//Update record into database
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once('connect.php');
$id=$_POST['id'];
$name=$_POST['name'];
$deptID=$_POST['deptID'];
$unitPrice=$_POST['unitPrice'];
$active=$_POST['active'];
$overide=$_POST['overide'];

$sql="UPDATE PLU set name= \"$name\",
unitPrice=\"$unitPrice\",
deptID=\"$deptID\",
active=\"$active\",
overide=\"$overide\"
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