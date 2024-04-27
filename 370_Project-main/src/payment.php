<?php
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalCost = $_POST['total_cost'];

    $useremail = $_COOKIE['email'];
    $query = "UPDATE student SET tokenCnt = tokenCnt - $totalCost WHERE email = '$useremail'";
    
    if (mysqli_query($conn, $query)) {
        $query="DELETE FROM cart WHERE email = '$useremail'";

        $delete=mysqli_query($conn,$query);

        header("location: orderConfirmed.html");
       

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("location: cart.php");
}
