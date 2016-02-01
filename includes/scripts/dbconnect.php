<?php
  $host = "localhost"; 
  $user = "root"; 
  $pass = "root"; 
  $database = "dms"; 

  //connect to the database. 
  $db = mysql_connect($host, $user, $pass); 
  mysql_select_db ($database); 

?>
