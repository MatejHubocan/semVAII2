<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "dtb456";
$dbName = "dbsemvaii";
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$delname = $_SESSION['name'];
$sql = "DELETE FROM users WHERE username ='$delname'";
$result=mysqli_query($conn,$sql);
header('Location: landing.html');
?>