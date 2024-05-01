<?php
require_once('DBconnect.php');
if(isset($_POST['itemID']) && isset($_POST['itemStatus']) && isset($_POST['action'])){
    $productid = $_POST['itemID'];
    $productstatus = $_POST['itemStatus'];
    $action = $_POST['action'];
    if($action == 'approve'){
        $query = "UPDATE curMenu SET status = 'published' WHERE f_id = '$productid'"; 
        // this part not working as intended
        $result = mysqli_query($conn, $query);
        if($result){
            echo header("location: pendingItems.php");
        }
    }else if($action == 'reject'){
        $query = "UPDATE curMenu SET status = 'pending' WHERE f_id = '$productid'";
        $result = mysqli_query($conn, $query);
        if($result){
            echo header("location: pendingItems.php");
        }
    }
}
?>