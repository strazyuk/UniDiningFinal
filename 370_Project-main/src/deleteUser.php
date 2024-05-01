<?php
require_once('DBconnect.php');
if (isset($_POST['email'])){
    $useremail = $_POST['email'];
    $sql = "DELETE FROM user WHERE email = '$useremail' and role = 'student'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        header("Location: admins.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
}
?>