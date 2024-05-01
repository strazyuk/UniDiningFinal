<?php
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalCost = $_POST['total_cost'];

    $useremail = $_COOKIE['email'];
    $query = "UPDATE student SET tokenCnt = tokenCnt - $totalCost WHERE email = '$useremail'";
    
    if (mysqli_query($conn, $query)) {
      
        $cartRowQuery = "SELECT * FROM cart WHERE email = '$useremail'";
        $cartRowCon = mysqli_query($conn, $cartRowQuery);

        while ($cartRow = mysqli_fetch_assoc($cartRowCon)) {
            $itemID = $cartRow['f_id'];
            
            $sellcountQuery = "UPDATE curMenu SET sellcount = sellcount + 1 WHERE f_id = '$itemID'";
            mysqli_query($conn, $sellcountQuery);
            
            $cartRow = mysqli_fetch_assoc($cartRowCon);
        }

        $query="DELETE FROM cart WHERE email = '$useremail'";

        mysqli_query($conn,$query);

        header("location: orderConfirmed.html");
       

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("location: cart.php");
}
