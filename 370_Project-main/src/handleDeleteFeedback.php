<?php
require_once('DBconnect.php');
if (isset($_POST['email']) && isset($_POST['feedID'])){
    $useremail = $_POST['email'];
    $feedID=$_POST['feedID'];
    $sql = "DELETE FROM feedback WHERE email = '$useremail' and feedback_id= '$feedID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        header("Location: admin_feedback.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
}
?>