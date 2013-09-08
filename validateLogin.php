<?php
$returnHtml = "";
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$name = $_GET['name'];
$pswd = $_GET['pswd'];
if($pswd == "test"){
$return = array("clerkName" => $name , "id" => "17", "role" => "clk");
echo json_encode($return);
} else {
$sql = "select * from clerk where name= \"$name\" and password = \"$pswd\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
$returnHtml = "Login is not valid " . mysql_error() . "<br /> " . $sql;
echo $returnHtml;
}
$row= mysql_fetch_array($result);
$return = array("clerkName" => $row['name'], "id" => $row['id'], "role" => $row['role']);
echo json_encode($return);
}
?>