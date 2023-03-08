<?php
session_start();
include("db.php");
include ("detectlogin.php");
$pagename="smart basket"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//if the value of the product id to be deleted (which was posted through the hidden field) is set
if (isset($_POST['del_prodid']))
{
//capture the posted product id and assign it to a local variable $delprodid
$delprodid=$_POST['del_prodid'];
//unset the cell of the session for this posted product id variable
unset($_SESSION['basket'][$delprodid]);
//display a "1 item removed from the basket" message
echo " <p class='updateInfo'><b>1 item removed</b></p>";

}

//$prodid = $_POST['h_prodid'];
//$prodqu = $_POST['p_quantity'];

//if the posted ID of the new product is set i.e. if the user is adding a new product into the basket
if (isset($_POST['h_prodid']))
{
//capture the ID of selected product using the POST method and the $_POST superglobal variable
//and store it in a new local variable called $newprodid
$prodid=$_POST['h_prodid'];
//capture the required quantity of selected product using the POST method and $_POST superglobal variable
//and store it in a new local variable called $reququantity
$prodqu=$_POST['p_quantity'];
//Display id of selected product
//echo "<p class='updateInfo'>Id of selected product: ".$newprodid."<p>";
//Display quantity of selected product
//echo "<p class='updateInfo'>Quantity of selected product: ".$reququantity."<p>";
//create a new cell in the basket session array. Index this cell with the new product id.
//Inside the cell store the required product quantity
$_SESSION['basket'][$prodid]=$prodqu;
echo "<p class='updateInfo'><b>1 product added</b></p>";
//Display "1 item added to the basket " message
echo "<p class='updateInfo'>Id of selected product:  ".$prodid."</p>";
echo "<p class='updateInfo'>Quantity of selected product:  ".$prodqu."</p>";
} 
//else 
//Display "Current basket unchanged " message
else
{
echo "<p class='updateInfo'><b>Basket unchanged</b></p>";
}
//reading from the basket

$total= 0; 
//Create a variable $total and initialize it to zero
//Create HTML table with header to display the content of the basket: prod name, price, selected quantity and subtotal
echo "<p><table id='baskettable'>";
echo "<tr>";
echo "<th>Product Name</th><th>Price</th><th>Quantity</th><th>Subtotal</th>";
echo "</tr>";
//if the session array $_SESSION['basket'] is set

if (isset($_SESSION['basket'])) {
    foreach ($_SESSION['basket'] as $key => $value) 
    {
        //SQL query to retrieve from Product table details of selected product for which id matches $index
        //execute query and create array of records 

        $SQL = "SELECT prodId,prodName,prodPrice
                     FROM Product
                     WHERE prodId = ".$key;
        $exeSQL = mysqli_query($conn, $SQL);
        echo "<tr>";
        $arrayp = mysqli_fetch_array($exeSQL);

        //display product name & product price using array of records $arraypecho 
        echo "<td>" .$arrayp['prodName']."</td>";
        echo "<td>&pound" .number_format($arrayp['prodPrice'],2)."</td>";
        // display selected quantity of product retrieved from the cell of session array and now in $value
        echo "<td style='text-align:center;'>".$value."</td>";
        //calculate subtotal, store it in a local variable $subtotal and display it
        $subtotal = $arrayp['prodPrice'] * $value;
        echo "<td>&pound" . number_format($subtotal,2)."</td>";
        echo "<td>";
        echo "<form action=basket.php method=post>";
        echo "<td>";
        echo "<input type='submit' value='Remove' id='submitbin'>";
        echo "<td>";
        echo "<input type='hidden' name='del_prodid' value=".$arrayp['prodId'].">";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        //increase total by adding the subtotal to the current total
        $total = $total + $subtotal;
    }
}

//else display empty basket message
else

{


echo " <p class='updateInfo'><b>Empty basket</b></p>";
}
// Display total
echo "<tr>";
echo "<td colspan=3><b>TOTAL</b></td>";
echo "<td><b>&pound".number_format($total,2)."</b></td>";
echo "</tr>";   
echo "</table>";
//echo "<br><p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>";

if (isset($_SESSION['basket']) and count($_SESSION['basket']) > 0) {
    echo "<p class='updateInfo'><a href='clearbasket.php'>CLEAR BASKET</a></p>";

    if (isset($_SESSION['userid']))
     {
        echo "<p class='updateInfo'><a href=checkout.php>CHECKOUT</a></p>";
    } 
    else 
    {
        echo "<p class='updateInfo'>New homteq customers: <a href='signup.php'>Sign up</a></p>";
        echo "<p class='updateInfo'>Returning homteq customers: <a href='login.php'>Login</a></p>";
    }
}
include("footfile.html");                                           //include head layout
echo "</body>";
?>