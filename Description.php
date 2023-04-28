<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
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
    <!--code für weiterleitung an login.php-->
    <button class="btn" onclick="location.href='login.php'">Login</button>
    <!--code für hamburger button erstellt blöche die beim anklicken 3 auswahl möglichkeiten zeigt-->
    <hamburger-icon>
      <span></span>
      <span></span>
      <span></span>
    </hamburger-icon>
    <div id="hamburger-menu" class="hidden">
      <a href="admin.html" class="nav-link">Admin Panel</a>
      <a href="bookoverview.php" class="nav-link">Book Overview</a>
      <a href="details.php" class="nav-link">Search</a>   
    </div>
  </nav>
</header>   
<div class="wrapper">
  <div class="box">

<?php
// startet die session
session_start();

// erstellt eine verbindung zur datenbank
$conn = mysqli_connect("localhost", "root", "", "books");

// Check überprüft verbindung
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
} else {
     "Verbindung erfolgreich";
}

if (isset($_GET['id'])) {
    // GET die ID von einer anderen seite
    $book_id = mysqli_real_escape_string($conn, $_GET['id']);

    // SQL statement um die details des buches zu bekommen
    $sql_book_details = "SELECT * 
                         FROM buecher 
                         WHERE id = '$book_id'";
// führt die abfrage aus
    $result_book_details = $conn->query($sql_book_details);

    // Check ob die abfrage funktioniert hat
    if ($result_book_details) {
      if (mysqli_num_rows($result_book_details) > 0) {
          $book_details = $result_book_details->fetch_assoc();
          $random_cover = "https://picsum.photos/300/450?random=" . $book_details['id'];
          
          echo '<div class="book-details">';
          echo '<div class="book-details-text-container">';
          
          echo "<h2>" . $book_details['kurztitle'] . "</h2>";
          echo "<p><strong>Titel:</strong> " . $book_details['title'] . "</p>";
          echo "<p><strong>Autor:</strong> " . $book_details['autor'] . "</p>";
          echo "<p><strong>Verfasser:</strong> " . $book_details['verfasser'] . "</p>";
          echo "<p><strong>Sprache:</strong> " . $book_details['sprache'] . "</p>";
          echo "<p><strong>Zustand:</strong> " . $book_details['zustand'] . "</p>";
          
          if (isset($book_details['text'])) {
              echo '<p><strong>Inhalt:</strong></p>';
              echo '<p>' . $book_details['text'] . '</p>';
          }
          
          echo '</div>';
          echo '<div class="book-details-image" style="background-image: url(' . $random_cover . ')"></div>';
          echo '</div>';
      } else {
          echo "Das Buch konnte nicht gefunden werden.";
      }
  } else {
      echo "Fehler beim Ausführen der Abfrage: " . mysqli_error($conn);
  }
}
// schluss der verbindung
mysqli_close($conn);

?>

    </div>
</div>

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