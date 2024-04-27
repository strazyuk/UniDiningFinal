<?php
include 'DBConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buyerEmail = $_POST['buyerEmail'];
    $tokenPackage = (int)$_POST['tokenPackage']; // Casting to integer

    // Sanitize inputs (assuming DBConnect.php doesn't already do this)
    $buyerEmail = mysqli_real_escape_string($conn, $buyerEmail);

    // Update student's token count
    $sql = "UPDATE student SET tokenCnt = tokenCnt + $tokenPackage WHERE email = '$buyerEmail'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Transaction successful. Tokens have been added to your account.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
