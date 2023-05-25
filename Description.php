<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
</head>
<body class="difback">
<header>
    <!--code für weiterleitung an index.php dient als logo für schnellen zugriff auf hauptseite-->
  <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
      <h1>Bookly</h1>
    </div>
  </button>
  <nav>
    <!--code für weiterleitung an login.php-->
    <?php
        session_start();

        // Check if the user is logged in
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // User is logged in, show the "Logout" button
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // User is not logged in, show the "Login" button
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
    include 'conf.php';

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
          ?>
         <div class="book-details">
  <div class="book-details-text-container">
    <h2><?php echo $book_details['kurztitle']; ?></h2>
    <p><strong>Titel:</strong> <?php echo $book_details['title']; ?></p>
    <p><strong>Autor:</strong> <?php echo $book_details['autor']; ?></p>
    <p><strong>Verfasser:</strong> <?php echo $book_details['verfasser']; ?></p>
    <p><strong>Sprache:</strong> <?php echo $book_details['sprache']; ?></p>
    <p><strong>Zustand:</strong> <?php echo $book_details['zustand']; ?></p>
<!-- Only show the "Edit" button if the user is logged in as an admin -->
<?php 
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && 
    isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
    echo '<button class="btn" onclick="location.href=\'delete.php?id='. $book_id . '\'">Edit</button>';
} 
?>
    <?php if (isset($book_details['text'])) { ?>
      <p><strong>Inhalt:</strong></p>
      <p><?php echo $book_details['text']; ?></p>
    <?php } ?>
  </div>
  <div class="book-details-image">
    <img src="<?php echo $random_cover; ?>" alt="Book cover">
  </div>
</div>

        <?php
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
  <?php
    session_start();

    // Check if the user is logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // User is logged in, show the "Logout" button
        echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';

        // If the user is an admin, show the button that links to newbook.php
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            echo '<button class="btn" onclick="location.href=\'newbook.php\'">Add New Book</button>';
        }
    } else {
        // User is not logged in, show the "Login" button
        echo '<button class="btn" onclick="location.href=\'login.php\'">Login</button>';
    }
  ?>

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