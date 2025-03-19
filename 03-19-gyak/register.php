<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Regisztráció - 03. 19.</title>
</head>
<body>
<form action="register.php" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Register</button>
</body>
</html>

<?php

$servername = "10.0.0.46";
$username = "test";
$password = "test";
$dbname = "school";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
if (isset($_POST['name']) && isset($_POST['username']) && isset($_POST['password'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO Teachers (name, username, h_password) VALUES ('$name', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {

        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

