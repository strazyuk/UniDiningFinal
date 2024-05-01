<?php
include 'DBConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buyerEmail = $_POST['buyerEmail'];
    $tokenPackage = (int)$_POST['tokenPackage']; 


    $sql = "UPDATE student SET tokenCnt = tokenCnt + $tokenPackage WHERE email = '$buyerEmail'";
    
    if ($conn->query($sql) === TRUE) {
        header("location:tokenPerchase.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
