<?php

session_start();
$_SESSION['option'] = 1;

include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<script>alert('Password mismatch'); window.location.href = 'register.html';</script>";
        exit();
    }

    $check_query = "SELECT * FROM voters WHERE mobile = '$mobile' OR email = '$email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Mobile Number is already exist'); window.location.href = 'register.html';</script>";
    } else {
        $sql = "INSERT INTO voters (fullname, email, mobile, address, gender, password) VALUES ('$fullname', '$email', '$mobile', '$address', '$gender', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['option'] = 1;
            header("Location: thankyou.php");
        } else {
            echo "<script>alert('Unwanted Error'); window.location.href = 'login.html';</script>";
        }
    }
}
?>
