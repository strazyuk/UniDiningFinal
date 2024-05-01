<?php
// Connect to the database
require_once('DBconnect.php');

if (isset($_POST['userEmail']) && isset($_POST['tokenCount'])) {
    $userEmail = $_POST['userEmail'];
    $tokenCount = intval($_POST['tokenCount']); // Convert to integer and sanitize input

    // Validate the token count
    if ($tokenCount <= 0) {
        echo "Invalid token count.";
        exit();
    }

    $senderEmail = $_COOKIE['email'];
    
    // Retrieve the sender's balance
    $querySenderBalance = "SELECT tokenCnt FROM student WHERE email = '$senderEmail'";
    $resultSenderBalance = mysqli_query($conn, $querySenderBalance);
    
    if ($resultSenderBalance && mysqli_num_rows($resultSenderBalance) > 0) {
        $senderRow = mysqli_fetch_assoc($resultSenderBalance);
        $senderBalance = $senderRow['tokenCnt'];
    } else {
        echo "Error retrieving sender balance.";
        exit();
    }

    // Check if the sender has enough balance to transfer the tokens
    if ($senderBalance < $tokenCount) {
        header("location:tokenTransferWarning.html");
        exit();
    }

    // Retrieve the receiver's balance
    $queryReceiverBalance = "SELECT tokenCnt FROM student WHERE email = '$userEmail'";
    $resultReceiverBalance = mysqli_query($conn, $queryReceiverBalance);
    
    if ($resultReceiverBalance && mysqli_num_rows($resultReceiverBalance) > 0) {
        $receiverRow = mysqli_fetch_assoc($resultReceiverBalance);
        $receiverBalance = $receiverRow['tokenCnt'];
    } else {
        echo "Error retrieving receiver balance.";
        exit();
    }

    // Start a transaction
    mysqli_begin_transaction($conn);

    try {
        // Deduct tokens from sender's balance
        $newSenderBalance = $senderBalance - $tokenCount;
        $updateSenderBalance = "UPDATE student SET tokenCnt = $newSenderBalance WHERE email = '$senderEmail'";
        mysqli_query($conn, $updateSenderBalance);

        $newReceiverBalance = $receiverBalance + $tokenCount;
        $updateReceiverBalance = "UPDATE student SET tokenCnt = $newReceiverBalance WHERE email = '$userEmail'";
        mysqli_query($conn, $updateReceiverBalance);

        mysqli_commit($conn);

        header('Location: tranferTokensLatest.php');
        exit();
    } catch (Exception $e) {
        mysqli_rollback($conn);
        header("location:tokenTransferWarning.html");

        
        exit();
    }

} else {
    // If the required form data is not set
    echo "Invalid form submission.";
}

// Close the database connection
mysqli_close($conn);
?>
