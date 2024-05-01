<?php



require_once('DBconnect.php');


if (isset($_POST['itemName']) && isset($_POST['itemPrice']) && isset($_POST['useremail']) && isset($_POST['itemID'])) {
    
    $useremail = $_POST['useremail'];
    $itemID = $_POST['itemID'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];

  
    $sqlCheck = "SELECT COUNT(*) AS count FROM cart WHERE email = '$useremail' AND f_id = '$itemID'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    if ($resultCheck) {
        $row = mysqli_fetch_assoc($resultCheck);
        $count = $row['count'];

        
        if ($count == 0) {
            
            $sqlInsert = "INSERT INTO cart (email, f_id, name, token) VALUES ('$useremail', '$itemID', '$itemName', '$itemPrice')";
            $resultInsert = mysqli_query($conn, $sqlInsert);

            if ($resultInsert) {
                header("Location: menu.php");
            } else {
                // Handle error during insertion
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            // Handle case where the item is already in the cart
            header("Location: duplicate_error.html");
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
