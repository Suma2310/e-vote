<?php
$host = "sql307.infinityfree.com";
$username = "if0_36330151";
$password = "z0SJqZvjs0K";
$database = "if0_36330151_votingdb";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>