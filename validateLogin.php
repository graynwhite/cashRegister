<?php
require_once("connect.php");
$sql = "select * from clerk where name= \"Frank C\" and password = \"/PJ7t85e\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Login is not valid " . mysql_error() . "<br /> " . $sql;
}
$row= mysql_fetch_array($result);
switch ($row['role']){
	case "clk":
	echo "this is a clerk";
	break;
	case "mgr" :
	echo "this is a manager";
	break;
	case "adm" :
	echo "this is an administrator";
	}





?>