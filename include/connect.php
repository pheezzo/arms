<?php

define("Db_server","localhost");
define("Db_user","root");
define("Db_pass","odekunle1");
define("Db_name","article_manager");

// Create connection
$connection = mysqli_connect(Db_server,Db_user,Db_pass, Db_name);
 if(!$connection){
 die("Database collection faileds".mysqli_connect_error());
 }
 //select database to use
 $select_db = mysqli_select_db($connection, Db_name); 
 if(!$select_db){
 die("Database collection failedhhh".mysqli_connect_error());
 }
?>
