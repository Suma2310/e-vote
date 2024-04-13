<?php
session_start();
include("database.php");
include("admin.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['role'] == 'admin' ) {
    if($_POST['mobile'] == $_SESSION['admin']){
        if($_POST['password'] == $_SESSION['pass']){
            $_SESSION['role'] = 'admin';
            header("Location: admindash.php");
            exit(); 
        }
        else {
            echo "<script>alert('Wrong Password'); window.location.href = 'login.html';</script>";
        }
    }
    else{
        echo "<script>alert('Unauthorized Access'); window.location.href = 'login.html';</script>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['role'] == 'voter') {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role']; 

    $_SESSION['mobile'] = $mobile;
    $_SESSION['password'] = $password;

    $sql = "SELECT * FROM voters WHERE mobile = '$mobile'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] == $password) {
            $_SESSION['role'] = $role; 
            header("Location: voterdash.php"); 
            exit(); 
        } else {
            echo "<script>alert('Wrong Password'); window.location.href = 'login.html';</script>";
        } 
    } else {
        echo "<script>alert('Mobile number is Invalid'); window.location.href = 'login.html';</script>";
    }
}
?>
