<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-register.css">
    <title>Bejelentkezés - 2025. 03. 09. </title>
</head>
<body>
    <div id="login">
        <h1>Jelentkezz be!</h1>
        <h3>Nincs még fiókod? <a href="register.php">Regisztrálj egyet itt!</a></h3>
        <form action="" method="POST">
            Felhasználónév: <input type="text" name="felhasznalo" required><br>
            Jelszó: <input type="password" name="jelszo" required><br><br>
            <input type="submit" value="Belépés" id="submit">
        </form>
    </div>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "felhasznalok";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['felhasznalo'])) {
            $form_username = $conn->real_escape_string($_POST['felhasznalo']);
            $form_password = $_POST['jelszo'];

            $stmt = $conn->prepare("SELECT jelszo FROM felhasznalok WHERE felhasznalo = ?");
            $stmt->bind_param("s", $form_username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                if (password_verify($form_password, $hashed_password)) {
                    setcookie("felhasznalo", $form_username, time() + (86400 * 30), "/");
                    header("Location: main.php");
                    exit;
                } else {
                    echo "<script>alert('Hibás jelszó!');</script>";
                }
            } else {
                echo "<script>alert('Ez a fiók nem létezik!');</script>";
            }
            $stmt->close();
        }
        $conn->close();
    ?>
</body>
</html>

