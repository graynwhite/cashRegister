<?
require_once('connect.php');
//Delete from database
$result = mysql_query("DELETE FROM transaction WHERE id = " . $_POST['id'] . ";");
 
//Return result to jTable
$jTableResult = array();
$jTableResult['Result'] = "OK";
print json_encode($jTableResult);
?>