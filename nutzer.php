<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <header>
        <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
            <div class="logo">
                <h1>Bookly</h1>
            </div>
        </button>
        <nav>
            <?php
            session_start ();
            // Überprüfen, ob der Benutzer eingeloggt ist
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                // Benutzer ist eingeloggt, zeige den "Logout"-Button an
                echo '<button class="btn" onclick="location.href=\'logout.php\'">Abmelden</button>';
            } else {
                // Benutzer ist nicht eingeloggt, zeige den "Anmelden"-Button an
                echo '<button class="btn" onclick="location.href=\'login.php\'">Anmelden</button>';
            }
            ?>
            <hamburger-icon>
                <span></span>
                <span></span>
                <span></span>
            </hamburger-icon>
            <div id="hamburger-menu" class="hidden">
            <a href="index.php" class="nav-link">Home</a>
            <a href="bookoverview.php" class="nav-link">Book Overview</a>
            <a href="nutzer.php" class="nav-link">Nutzer</a>
        </div>
        </nav>
    </header>

    <div class="search-bar">
        <form method="post" action="">
            <input type="text" name="search_query" placeholder="Suche..." onfocus="showPopup()">
            <button type="submit" name="search_btn"></button>
        </form>
    </div>

    <div class="main-contentnutzer">
        <?php
        include 'conf.php';
        // Funktion zur Anzeige eines Benutzerfelds
        function displayUser($kid, $vorname, $name) {
            echo '<div class="nutzer">';
            echo '<h3 class="nutzer-username">' . $kid . '</h3>';
            echo '<p class="nutzer-name">' . $vorname . ' ' . $name . '</p>';
            echo '</div>';
        }

        // Funktion zum Abrufen und Anzeigen aller Benutzer
        function displayAllUsers($conn) {
            $sql = "SELECT kid, vorname, name FROM kunden";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    displayUser($row['kid'], $row['vorname'], $row['name']);
                }
            } else {
                echo "0 Ergebnisse";
            }
        }

        // Hinzugefügter PHP-Code zur Handhabung der Suche
        if (isset($_POST['search_btn'])) {
            $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
            $sql = "SELECT kid, vorname, name FROM kunden WHERE vorname LIKE '%$search_query%' OR name LIKE '%$search_query%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    displayUser($row['kid'], $row['vorname'], $row['name']);
                }
            } else {
                echo "0 Ergebnisse";
            }
        } else {
            displayAllUsers($conn);
        }

        mysqli_close($conn);
        ?>
    </div>

    <nav class="nav2">
        <a class="nav-link" href="#">Bücher</a>
    </nav>
</body>
</html>
