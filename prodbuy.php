<?php
session_start();
include("db.php");
include ("detectlogin.php");
$pagename="a smart buy for a smart home"; 
                        //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>";   //Call in stylesheet
echo "<title>".$pagename."</title>";                                //display name of the page as window title
echo "<body>";
include ("headfile.html");                                          //include header layout file
echo "<h4>".$pagename."</h4>";                                      //display name of the page on the web page
//retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
//applied to the query string u_prod_id
//store the value in a local variable called $prodid
$prodid = $_GET['u_prod_id'];
//display the value of the product id, for debugging purposes
//echo "<p>Selected product Id: ".$prodid."</p>";
$SQL= "SELECT prodId, prodName, prodPicNameLarge, prodDescripLong, prodPrice,prodQuantity 
FROM Product
WHERE prodId=".$prodid;                                             //run SQL query for connected DB or exit and display error message 
$exeSQL = mysqli_query($conn, $SQL);
echo "<table style='border: 0px'>";                                 //create an array of records (2 dimensional variable) called $arrayp. 
                                                                    //populate it with the records retrieved by the SQL query previously executed. 
                                                                    //Iterate through the array i.e while the end of the array has not been reached, run through it
 $arrayp=mysqli_fetch_array($exeSQL); 
    echo "<tr>"; 
    echo "<td style='border: 0px'>";                                 //display the small image whose name is contained in the array 
                                                                    //make the image into an anchor to prodbuy.php and pass the product id by URL (the id from the array)
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
    echo "<img src=images/".$arrayp['prodPicNameLarge']." height=350 width=350>";
    echo "</a>";                                                    //close the anchor
    echo "</td>"; 
    echo "<td style='border: 0px'>"; 
    echo "<p><b></b><h5>".$arrayp['prodName']."</h5></b></p>";         //display product name as contained in the array 
    echo "<br><p>".$arrayp['prodDescripLong']."</p>";
    echo "<br><p><b>&pound".$arrayp['prodPrice']."</b></p>";
    echo "<br><p><b>Number left in stock: ".$arrayp['prodQuantity'] ."</b></p>";
    echo "<br><p>Number to be purchased: ";
                                                                    //create a form made of one drop-down menu and one button for user to enter quantity
                                                                    //the value entered in the form will be posted to the basket.php to be processed
    echo "<form action='basket.php' method='post'>";
    echo "<select name='p_quantity'>";
    for ($i=1; $i<=$arrayp['prodQuantity']; $i++)
{
    echo "<option value=".$i.">".$i."</option>";
}
    echo "</select>";
    
                                                            
            //pass the product id to the next page basket.php as a hidden value
    echo "<input type='hidden' name='h_prodid' value=".$arrayp['prodId'].">";
    echo "<input type='submit' name='submitbtn' value='Buy' id='submitbtn'>";
    echo "</form> </p>";
    echo "</td>"; 
    echo "</tr>"; 
    echo "</table>";                                                   //retrieve the product id passed from previous page using the GET method and the $_GET superglobal variable
                                                                     //applied to the query string u_prod_id
                                                                  //store the value in a local variable called $prodid
//$prodid=$_GET['u_prod_id'];
                                                                    //display the value of the product id, for debugging purposes
    //echo "<p>Selected product Id: ".$prodid."</p>";

include("footfile.html");                                           //include head layout
echo "</body>";
?>
