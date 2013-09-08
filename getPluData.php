<?php
$returnHtml = "";
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$id = $_GET['pluid'];

$sql = "select * from PLU where id= \"$id\" ";
$result = mysql_query($sql);
if(mysql_error() != ""){
$err = mysql_error(); 
$returnHtml = array("returnMessage" => "Problem with sql " , "errormessage" =>  $err, "sql" =>  $sql);
echo json_encode($returnHtml);
quit;

}
$row= mysql_fetch_array($result);
$return = array("dptid" => $row['deptID'], "id" => $row['id'], "price" => $row['unitPrice'], "name" => $row['name'], "overide" => $row['overide']);
echo json_encode($return);
?>