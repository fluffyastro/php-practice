<!DOCTYPE html>
<html lang="hu-HU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log in - 03. 19.</title>
</head>
<body>
<div id="login-ui">  
<h1>Log in</h1>  
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username" id="input-user"><br>
    <input type="password" name="password" placeholder="Password" id="input-pass"><br>
    <button type="submit">Login</button>
    </div>


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
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $h_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql = "SELECT * FROM Teachers WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['h_password'])) {
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}

?>
</body>
</html>