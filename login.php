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
<button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
    <h1>Bookly</h1>
    </div>
</button>
<nav>
    <button class="btn" onclick="location.href='register.php'">Register</button>
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
<?php
session_start();
include 'conf.php';
// fragt nach dem Benutzernamen und Passwort
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // bereitet die Eingaben vor 
    $sql = "SELECT * FROM benutzer WHERE benutzername = '$username'";

    // führt die Abfrage aus
    $result = mysqli_query($conn, $sql);

    // überprüft, ob der Benutzername existiert
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // verifiziert das Passwort
        if (password_verify($password, $row['passwort'])) {
            // wenn das passwort korrekt ist, wird der Benutzer eingeloggt
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['benutzername'];
            $_SESSION['admin'] = $row['admin'];

            // leitet den Benutzer weiter zur Buchübersicht
            header("Location: bookoverview.php");
            exit();
        } else {
            // error message wenn das Passwort falsch ist
            echo '<p class="error-message">Error: Invalid password.</p>';
        }
    } else {
        // error message wenn der user nicht gefunden wurde
        echo '<p class="error-message">Error: User not found.</p>';
    }
}

mysqli_close($conn);
?>
<!-- Login Formular -->
<div class="green-boxlogin">
    <div class="login-card">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username" class="input-label"></label>
            <input type="text" id="username" name="username" required onfocus="if(this.value=='Username') this.value='';" onblur="if(this.value=='') this.value='Username';" value="Username">
            <label for="password" class="input-label"></label>
            <input type="password" id="password" name="password" required onfocus="if(this.value=='Password') this.value='';" onblur="if(this.value=='') this.value='Password';" value="Password">
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

<script>
    
    // JavaScript for hamburger button
    const hamburger = document.querySelector('hamburger-icon');
    const nav = document.querySelector('header nav');
    
    hamburger.addEventListener('click', function() {
        nav.classList.toggle('active');
    });
</script>
</body>
</html>
