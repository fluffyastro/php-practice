<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "felhasznalok";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_COOKIE['felhasznalo'])) {
    $stmt = $conn->prepare("SELECT felhasznalo FROM felhasznalok WHERE felhasznalo = ?");
    $stmt->bind_param("s", $_COOKIE['felhasznalo']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($felhasznalo);
        $stmt->fetch();
    } else {
        header("Location: logout.php");
        exit;
    }
} else {
    header("Location: logout.php");
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <title>Üdvözlünk - 2025. 03. 09.</title>
</head>
<body>
    <div id="login">
        <h1>Belépett!</h1>
        <h1>Üdvözöljük, <u><?php echo htmlspecialchars($felhasznalo, ENT_QUOTES, 'UTF-8'); ?></u></h1>
        <a href="logout.php"><button id="logout">Kijelentkezés</button></a>
    </div>
</body>
</html>

