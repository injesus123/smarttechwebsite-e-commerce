<?php
session_start();
include("db.php");
//mysqli_report(MYSQLI_REPORT_OFF);
include ("detectlogin.php");
$pagename="checkout"; //Create and populate a variable called $pagename
echo "<link rel=stylesheet type=text/css href=mystylesheet.css>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
//display text
$currentdatetime = date('Y-m-d H:i:s');

$SQLNewOrder =
   "INSERT INTO
Orders 
(userId,orderDateTime,orderStatus,shippingDate)
VALUES
(".$_SESSION["userid"].",'".$currentdatetime."','Placed','".$currentdatetime."')";

if(mysqli_query($conn,$SQLNewOrder) and ISSET($_SESSION['basket']) 
    and count ($_SESSION ['basket'])>0)
{
    echo "<p class='updateInfo'>Order Successful!</p>";
    $maxSQL = "SELECT max(orderNo) AS orderNo
                FROM Orders
                WHERE userId =".$_SESSION['userid'];
    $exemaxSQL = mysqli_query($conn, $maxSQL);
    $arrayordno = mysqli_fetch_array($exemaxSQL);
    $orderno = $arrayordno['orderNo'];
    echo "<p class='updateInfo'><b>Order No: ".$orderno."</b></p>";

    $total=0;

     echo "<p><table id = 'baskettable'>";
    echo "<tr>";
    echo "<th>Product Name</th><th>Product Price</th><th>Nb of items</th><th>Subtotal</th>";
    echo "</tr>";


    foreach ($_SESSION['basket'] as $key => $value) 
    {
        $SQLbasket = "SELECT prodId,prodName,prodPrice
                     FROM Product
                     WHERE prodId = " . $key;
        $exeSQLbasket = mysqli_query($conn, $SQLbasket);
        $arrayb = mysqli_fetch_array($exeSQLbasket);

        $subtotal = $value * $arrayb['prodPrice'];

        $SQLorderline =
            "INSERT INTO
     Order_Line (orderNo,prodId,quantityOrdered,subTotal)
     VALUES (" . $orderno . "," . $Key . "," . $value . "," . $subtotal . ")";

        $exeSQLorderline = mysqli_query($conn, $SQLorderline);
        echo "<tr>";
        echo "</td>" . $arrayb['prodName'] . "</td>";
        echo "<td>&pound" . number_format($arrayb['prodPrice'], 2) . "</td>";
        echo "<td>" . $value . "</td>";
        echo "<td>&pound" . number_format($subtotal, 2) . "</td>";
        echo "</tr>";
        $total = $total + $subtotal;
    }
    
    echo "<tr>";
    echo "<td colspan=3><b>TOTAL</b></td>";
    echo "<td>&pound".number_format($total,2)."</td>";
    echo "</tr>";
    echo "</table>"; 

        $SQLupdateorder
        =" UPDATE Orders
        SET orderTotal = ".$total."
        WHERE orderNo = ".$orderno;
         $exeSQLupdateorder = mysqli_query($conn,$SQLupdateorder);
}
    else 
    {
    echo "<p class='updateInfo'>Order Failed </p>";

    }  
unset($_SESSION['basket']); 

include("footfile.html"); //include head layout
echo "</body>";
?>
