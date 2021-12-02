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
$stmt = $conn->prepare('SELECT userPassword FROM users WHERE userID = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($userPassword);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
</head>
<body class="loggedin">
<div class="menu">
    <a href="profile.php">Profile</a>
    <a href="logout.php">Logout</a>
    <a href="home.php">Home</a>
</div>
<div class="content">
    <h2>Profile details</h2>
    <div>
        <p>Your account details are below:</p>
        <form action="editProfile.php" method="post">
            <div class="username">
                <label for="username"></label>
                <input type="text" name="username" id="username" placeholder="<?=$_SESSION['name']?>">
            </div>

            <div class="password">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="<?=$userPassword?>">
            </div>

            <input class="button" type="submit" value="EDIT">
        </form>
    </div>
    <button class="button" onclick="location.href='deleteProfile.php'" >
        DELETE ACCOUNT
    </button>
</div>
</body>
</html>
