<?php
	//connect to the database server
	$dbcnx = @mysql_connect("localhost","graynwhi_cashRegister", "/PJ7t85e");
   
	if (!$dbcnx) {  
                      echo("<h1>Unable to connect to the database server at this time.</h1></p>");
		      echo("<P>For help, please send mail to the webmaster (webmaster@graynwhite.com), giving this error message and the time and date of the error.</p>"); 	
	           exit();
                      }
       //	 Select the cashRegister  database
      	if (! @mysql_select_db("graynwhi_cashRegister") ) {
      		echo("<p> <h1>Unable to locate   database at this time. Try again later.</h1></p>");
		echo("<P>For help, please send mail to the webmaster (webmaster@graynwhite.com), giving this error message and the time and date of the error.</p>"); 
      		
		exit();
      		}            
?>