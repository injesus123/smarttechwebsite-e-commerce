<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'homteq_db'; //or whatevername you give to your database when you create it.
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) ;
if (!$conn) 
{
 die('Could not connect: '. mysqli_error($conn));
}
mysqli_select_db($conn, $dbname);   
?>