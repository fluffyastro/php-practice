<!DOCTYPE html>
<html lang="hu-HU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Főoldal - 03. 19.</title>
</head>
<body>
<h1>Üdvözöljük!</h1>
<form action="index.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>
    <div id="index-div">
        <!-- Feladat megoldása -->
         
    </div>
</body>
</html>

<?php

function check_login() {
    if (!isset($_SESSION['id'])) {
        header('Location: login.php');
    }
}

session_start();
check_login();
function logout() {
    session_destroy();
    header('Location: login.php');
}

if (isset($_POST['logout'])) {
    logout();
}


$servername = "10.0.0.46";
$username = "test";
$password = "test";
$dbname = "school";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



/*ide kerül a feladat megoldása*/



?>