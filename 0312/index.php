<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Kép feltöltés - 2025. 03. 12.</title>
</head>
<body>
    <?php
    $conn = $conn = new mysqli('localhost', 'root', '', 'felhasznalo_db');

    if($conn->connect_error){
        die("Hiba:" . $conn->connect_error);
    } 
    
    $sql = "CREATE DATABASE kepek"
    ?>
    <div id="form-req">
        <h1>Töltsön fel képeket URL-ként!</h1>
        <form action="galeria.php" method="POST">
            <input type="text" id="url">
        </form>
    </div>
</body>
</html>