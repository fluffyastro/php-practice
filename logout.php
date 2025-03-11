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
    <script>
        let dots = '';
        let timer = setInterval(function() {
            dots += '.';
            document.querySelector('h1').textContent = `Kijelentkezés folyamatban${dots}`;
            if (dots.length === 3) {
                clearInterval(timer);
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 1000);
            }
        }, 1000);
    </script>
</head>
<body>
    <div id="login">
        <h1>Kijelentkezés <br> folyamatban</h1>
    </div>
</body>
</html>

