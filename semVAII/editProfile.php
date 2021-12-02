<?php
session_start();

if ( !isset($_POST['username'], $_POST['password']) ) {
    exit('Please fill both the username and password fields!');
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "dtb456";
$dbName = "dbsemvaii";
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$id = $_SESSION['id'];
$name = $_POST['username'];
$pass = $_POST['password'];

if(strlen($pass) < 4){
    echo "Heslo bolo prilis kratke (menej ako 4 znaky).";
    exit();
}

if($_SESSION['name' != $name])
{
    $sql = "SELECT username FROM Users WHERE username='".$name."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Meno je uz obsadene.";
        exit();
    }
}


$sql = "UPDATE users SET userName = '$name', userPassword= '$pass' WHERE userID = '$id'";
$result=mysqli_query($conn,$sql);

$_SESSION['name'] = $_POST['username'];
$_SESSION['id'] = $id;

header('Location: profile.php');
?>


