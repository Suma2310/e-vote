<?php
session_start();
include("database.php");

if(isset($_POST['download'])) {
    $sql = "SELECT fullname, mobile , email FROM voters";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="voters_list.csv"');
        
        $output = fopen('php://output', 'w');

        fputcsv($output, array('Mobile', 'Name', 'Email'));

        while($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, array($row['mobile'], $row['fullname'], $row['email']));
        }
        fclose($output);
        exit();
    } else {
        echo "No voters found.";
    }
}
?>
