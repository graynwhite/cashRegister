<?php
$returnHtml = "";
require_once("config.inc");
require_once("connect.php");
$name = $_GET['name'];
$pswd = $_GET['pswd'];
$sql = "select * from clerk where name= \"$name\" and password = \"$pswd\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
$returnHtml = "Login is not valid " . mysql_error() . "<br /> " . $sql;
echo $returnHtml;
}
$row= mysql_fetch_array($result);
$return = array("clerkName" => $row['name'], "id" => $row['id'], "role" => $row['role']);
echo json_encode($return);
?>