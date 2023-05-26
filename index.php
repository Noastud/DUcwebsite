<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
    <script src="scripts.js" defer></script>
</head>
<body>
<header>
    <!--code für weiterleitung an index.php dient als logo für schnellen zugriff auf hauptseite-->
    <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
        <div class="logo">
            <h1>Bookly</h1>
        </div>
    </button>
    <nav>
    <?php
        session_start();

        // Überprüft ob der User eingeloggt ist
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Zeigt den "Logout" button an
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // Zeigt den "Login" button an
            echo '<button class="btn" onclick="location.href=\'login.php\'">Login</button>';
        }
        ?>
        <!--code für hamburger button erstellt blöche die beim anklicken 3 auswahl möglichkeiten zeigt-->
        <hamburger-icon>
            <span></span>
            <span></span>
            <span></span>
        </hamburger-icon>
        <div id="hamburger-menu" class="hidden">
            <a href="index.php" class="nav-link">Home</a>
            <a href="bookoverview.php" class="nav-link">Book Overview</a>
            <a href="bookoverview.php" class="nav-link">Search</a>
        </div>
    </nav>
</header>

<main>
    <!-- typewriter effekt für die h2 überschrift -->
    <div class="typewriter">
        <h2>Bookly: Browse Antique Books.</h2>
    </div>
</main>
<script>
    //javascript für hamburger button
    //der event listener wartet auf einen klick auf den hamburger button und führt dann die funktion aus die die klasse active hinzufügt
    //die klasse active ist in der css datei definiert und sorgt dafür das die navigation angezeigt wird
    const hamburger = document.querySelector('hamburger-icon');
    const nav = document.querySelector('header nav');

    hamburger.addEventListener('click', function() {
        nav.classList.toggle('active');
    });
</script>
<nav class="nav2">
    <a class="nav-link" href="#">Books</a>
</nav>
</body>
</html>
