<?php
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
//Get records from database
$result = mysql_query("SELECT * FROM department order by name;");
 
//Add all records to an array
$rows = array();
while($row = mysql_fetch_array($result))
{
    $rows[] = $row;
}
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
$jTableResult['Records'] = $rows;
print json_encode($jTableResult);
?>
