<?php
require_once("connect.php");
$sql = "select * from clerk where name= \"Joe\" and password = \"1234\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Login is not valid " . mysql_error() . "<br /> " . $sql;
}
$row= mysql_fetch_array($result);
if($row['role']=='clk'){
echo "clerk";
}else{
echo "don't know";
}


?>