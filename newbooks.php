<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
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
        include 'conf.php';

        // überprüft ob der User eingeloggt ist
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // wenn der User eingeloggt ist, zeige den "Logout" button an
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // wenn der user nicht einngeloggt ist, zeige den "Login" button an
            echo '<button class="btn" onclick="location.href=\'login.php\'">Login</button>';
        }
        ?>
        <!-- Hamburger menu -->
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
<!-- Form um neues buch hinzuzufügen  -->
<div class="wrapper">
    <h2>Add New Book</h2>
    <form method="post" action="">
        <p><strong>Kurztitle:</strong></p>
        <input type="text" name="kurztitle" required>
        <p><strong>Titel:</strong></p>
        <input type="text" name="title" required>
        <p><strong>Autor:</strong></p>
        <input type="text" name="autor" required>
        <p><strong>Verfasser:</strong></p>
        <input type="text" name="verfasser" required>
        <p><strong>Sprache:</strong></p>
        <input type="text" name="sprache" required>
        <p><strong>Zustand:</strong></p>
        <input type="text" name="zustand" required>
        <br>
        <input type="submit" name="add_book" value="Add Book" class="btn">
    </form>
</div>

<?php
//überprüft ob das form ausgefüllt wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    // hohlt die daten aus dem form
    $kurztitle = mysqli_real_escape_string($conn, $_POST['kurztitle']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $verfasser = mysqli_real_escape_string($conn, $_POST['verfasser']);
    $sprache = mysqli_real_escape_string($conn, $_POST['sprache']);
    $zustand = mysqli_real_escape_string($conn, $_POST['zustand']);

    // SQL query um die daten in die datenbank zu speichern
    $sql_add_book = "INSERT INTO buecher (kurztitle, title, autor, verfasser, sprache, zustand)
                     VALUES ('$kurztitle', '$title', '$autor', '$verfasser', '$sprache', '$zustand')";

    // query wird ausgeführt
    if (mysqli_query($conn, $sql_add_book)) {
        echo "Book added successfully.";
        // wenn es funktioniert hat wird der user auf die bookoverview seite weitergeleitet
        header("Location: bookoverview.php");
        exit();
    } else {
      // wenn es nicht funktioniert hat wird ein error ausgegeben
        echo "Error adding book: " . mysqli_error($conn);
    }
}

$conn->close();
?>

</body>
</html>
