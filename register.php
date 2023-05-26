<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="style/styles.css">
    <script src="scripts.js" defer></script>
</head>
<body>
<header>
    <!-- Code für Weiterleitung an index.php, dient als Logo für schnellen Zugriff auf die Hauptseite -->
    <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
        <div class="logo">
            <h1>Bookly</h1>
        </div>
    </button>
    <nav>
        <?php
        session_start();

        // Überprüfen, ob der Benutzer angemeldet ist
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Benutzer ist angemeldet, zeige den "Logout"-Button
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // Benutzer ist nicht angemeldet, zeige den "Login"-Button
            echo '<button class="btn" onclick="location.href=\'login.php\'">Login</button>';
        }
        ?>
        <!-- Code für den Hamburger-Button, erstellt Blöcke, die beim Klicken drei Auswahlmöglichkeiten anzeigen -->
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
<?php
// Starte die Session

// Inkludiere die Datenbank-Konfigurationsdatei
include 'conf.php';

// Überprüfe, ob das Registrierungsformular abgeschickt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hole die Benutzereingabe
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Validiere und bereite die Eingaben vor
    $username = trim($username);
    $password = trim($password);
    $email = trim($email);

    // Überprüfe, ob alle Pflichtfelder ausgefüllt sind
    if (empty($username) || empty($password) || empty($email)) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: register.php");
        exit();
    }

    // Überprüfe die E-Mail-Adresse
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email address.";
        header("Location: register.php");
        exit();
    }

    // Überprüfe, ob der Benutzername bereits verwendet wird
    $sql = "SELECT * FROM benutzer WHERE benutzername = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Username already taken.";
        header("Location: register.php");
        exit();
    }

    // Hash das Passwort
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Bereite das SQL-Statement vor, um die Benutzerdaten in die Tabelle einzufügen
    $sql = "INSERT INTO benutzer (benutzername, passwort, email) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $email);
    
    // Führe das SQL-Statement aus
    if (mysqli_stmt_execute($stmt)) {
        // Registrierung erfolgreich
        $_SESSION['message'] = "Registration successful. You can now login.";
        header("Location: login.php");
        exit();
    } else {
        // Registrierung fehlgeschlagen
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: register.php");
        exit();
    }
}

// Schließe die Datenbankverbindung
mysqli_close($conn);
?>


<div class="green-box">
    <div class="register-card">
        <h2>Register</h2>
        <?php
        // Zeige Fehlermeldung an, wenn vorhanden
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <!-- Formular für die Registrierung des users   --->
        <form action="register.php" method="POST">
            <label for="username" class="input-label"></label>
            <input type="text" id="username" name="username" required onfocus="if(this.value=='Username') this.value='';" onblur="if(this.value=='') this.value='Username';" value="Username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="name" class="input-label"></label>
            <input type="text" id="name" name="name" required onfocus="if(this.value=='Name') this.value='';" onblur="if(this.value=='') this.value='Name';" value="Name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="vorname" class="input-label"></label>
            <input type="text" id="vorname" name="vorname" required onfocus="if(this.value=='Vorname') this.value='';" onblur="if(this.value=='') this.value='Vorname';" value="Vorname" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="email" class="input-label"></label>
            <input type="text" id="email" name="email" required onfocus="if(this.value=='E-mail') this.value='';" onblur="if(this.value=='') this.value='E-mail';" value="E-mail" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="password" class="input-label"></label>
            <input type="password" id="password" name="password" required onfocus="if(this.value=='Password') this.value='';" onblur="if(this.value=='') this.value='Password';" value="Password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="admin" class="input-label"></label>

            <button type="submit" style="width: 30%; padding: 10px; background-color: #fff !important; color: black; margin: 0 auto; border: none; border-radius: 4px; font-size: 30px; cursor: pointer;">Submit</button>
        </form>
    </div>
</div>


<script>
    // JavaScript für den Hamburger-Button
    const hamburger = document.querySelector('hamburger-icon');
    const nav = document.querySelector('header nav');
    
    hamburger.addEventListener('click', function() {
        nav.classList.toggle('active');
    });
</script>
</body>
</html>
