<?php 
session_start();

include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
        
    $candidate_id = $_POST['candidate_id'];

    $sql = "UPDATE candidates SET votes = votes + 1 WHERE id = $candidate_id";

    if (mysqli_query($conn, $sql)) {
        $mobile = $_SESSION['mobile'];
        $update_voted_sql = "UPDATE voters SET voted = 1 WHERE mobile = '$mobile'";
        if (mysqli_query($conn, $update_voted_sql)) {
            $_SESSION['voted'] = true;
            $_SESSION['option'] = 3;
            header("Location: thankyou.php");
        } else {
            echo "Error updating voted status: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>