<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <title>Regisztráció - 2025. 03. 09.</title>
</head>
<body>
    <div id="login">
        <h1>Regisztrálj egy fiókot!</h1>
        <h3>Van már fiókod? <a href="login.php">Lépj be itt!</a></h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                Felhasználónév: <input type="text" name="felhasznalo" required><br>
                Jelszó: <input type="password" name="jelszo" required><br><br>
            <input type="submit" value="Regisztráció" id="submit">
        </form>
    </div>
</body>
<?php
$form_username = "";
$form_password = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "felhasznalok";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolat sikertelen: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['felhasznalo'])) {
    $form_username = $conn->real_escape_string($_POST['felhasznalo']);
    $form_password = password_hash($_POST['jelszo'], PASSWORD_BCRYPT); // Jelszó titkosítása

    $stmt = $conn->prepare("SELECT felhasznalo FROM felhasznalok WHERE felhasznalo = ?");
    $stmt->bind_param("s", $form_username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('A felhasználónév már foglalt!');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO felhasznalok (felhasznalo, jelszo) VALUES (?, ?)");
        $stmt->bind_param("ss", $form_username, $form_password);

        if ($stmt->execute()) {
            setcookie("felhasznalo", $form_username, time() + (86400 * 30), "/");
            header("Location: main.php");
            exit;
        } else {
            echo "Hiba történt: " . $stmt->error;
        }
    }
    $stmt->close();
}

$conn->close();
?>
</html>

