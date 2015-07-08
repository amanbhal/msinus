<?php
/**
 * These are the database login details
 */
   
define("dbhost", "localhost");     // The host you want to connect to.
define("dbuser", "root");    // The database username. 
define("dbpwd", "");    // The database password. 
define("db", "univ_detail");    // The database name.
define("dberror","Could not connect to database!");
/*
define("dbhost", "mysql9.000webhost.com");     // The host you want to connect to.
define("dbuser", "a5665721_aman");    // The database username. 
define("dbpwd", "NationDie@123");    // The database password. 
define("db", "a5665721_m");    // The database name.
define("dberror","Could not connect to database!");
*/
 

$conn = mysqli_connect(dbhost,dbuser,dbpwd,db)	 or die(dberror);
?>