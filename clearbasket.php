<?php
session_start();
include ("detectlogin.php");
include ("db.php"); //include db.php file to connect to DB
$pagename="clear smart basket"; //create and populate variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";
echo "<title>".$pagename."</title>";
echo "<body>";
include ("headfile.html");
echo "<h4>".$pagename."</h4>";
unset($_SESSION['basket']);
echo "<p class='updateInfo'><b>Your basket has been cleared!</b></p>";
include ("footfile.html");
echo "</body>";
?>