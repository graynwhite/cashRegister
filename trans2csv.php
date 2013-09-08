<?
require_once($_SERVER['DOCUMENT_ROOT']."../../php/cashRegisterConfig.php");
require_once("connect.php");
$sql = "SELECT *
    INTO OUTFILE 'C:/Data/City.csv'
     FIELDS TERMINATED BY ','
     ENCLOSED BY '\"'
     ESCAPED BY '\\'
     LINES TERMINATED BY '\\n\\r'
     FROM transaction; ";
	 
$result = mysql_query($sql);
if(mysql_error()!=''){
echo "Problem with request  " . $sql . "<br /> " . mysql_error();
} else {
echo "File created";
}


?>




