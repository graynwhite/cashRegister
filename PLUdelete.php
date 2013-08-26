<?
require_once("config.inc");
require_once('connect.php');
//Delete from database
$result = mysql_query("DELETE FROM PLU WHERE id = " . $_POST["id"] . ";");
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>