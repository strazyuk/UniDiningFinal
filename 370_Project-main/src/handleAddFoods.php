<?php
require_once('DBconnect.php');
if (isset($_POST['itemName']) && isset($_POST['tokenCount'])  && isset($_POST['itemType']) && isset($_POST['itemImage']) && isset($_POST['itemTiming'])){
    $itemName = $_POST['itemName'];
    $tokenCount = $_POST['tokenCount'];
    $itemType = $_POST['itemType'];
    $itemImage = $_POST['itemImage'];
    $itemTiming=$_POST['itemTiming'];
    $sellcount = 0;
    $publishdate = date("Y-m-d");
    $status = "pending";
    $query = "INSERT INTO curMenu (name, img, token , sellcount, type ,time, status) VALUES ('$itemName', '$itemImage', '$tokenCount', '$sellcount', '$itemType','$itemTiming', '$status')";
    $result = mysqli_query($conn, $query);
    if ($result){
        header("Location: addfoods.php");
    } else {
        echo "failed";
    }
} 
?>