<?php
require_once("connect.php");
$name = $_GET['name'];
$pswd = $_GET['pswd'];
$sql = "select * from clerk where name= \"$name\" and password = \"$pswd\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
echo "Login is not valid " . mysql_error() . "<br /> " . $sql;
}
$row= mysql_fetch_array($result);
switch ($row['role']){
	case "clk":
	echo "This is a clerk";
	break;
	case "mgr" :
	echo "This is a manager";
	break;
	case "adm" :
	echo "This is an administrator";
	break;
	default:
	echo "This is an invalid login";
	
	}





?>