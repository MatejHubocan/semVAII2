<!DOCTYPE html>
<html lang="sk">

<head>
    <title>register page</title>
</head>

<body>
<center>
    <h1>Registracne udaje</h1>

    <form action="register.php" method="post">
        <p>
            <label for="name">user name:</label>
            <input type="text" name="userName" id="name" required maxlength="20">
        </p>

        <p>
            <label for="pass">user password:</label>
            <input type="text" name="userPassword" id="pass" required minlength="4">
        </p>

        <input type="submit" name="submit" value="Submit">

    </form>
</center>
</body>

</html>
<?php
$name = $pass = "";

if (isset($_POST['submit'])) {
    $name =  $_REQUEST['userName'];
    $pass = $_REQUEST['userPassword'];

    if(strlen($pass) < 4){
        echo "Heslo bolo prilis kratke (menej ako 4 znaky).";
        exit();
    }

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "dtb456";
    $dbName = "dbsemvaii";
    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if($conn === false){
        die("ERROR: Could not connect. ". mysqli_connect_error());
    }

    $sql = "SELECT username FROM Users WHERE username='".$name."'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Meno je uz obsadene.";
        exit();
    }

    try {
        $sql = "SELECT MAX(userID) as maximum FROM users;";
        if ($result=mysqli_query($conn,$sql)) {
            $newID=mysqli_fetch_array($result);
        }
        $conn = new PDO("mysql:host=$servername;dbname=$dbName", $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (userID, userName, userPassword) VALUES ('$newID[0]'+1,'$name', '$pass')";
        $conn->exec($sql);
        header('Location: login.html');
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
    mysqli_close($conn);
}
?>