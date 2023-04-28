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
  <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
      <h1>Bookly</h1>
    </div>
  </button>
  <nav>
    <button class="btn" onclick="location.href='login.php'">Login</button>
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
// Start the session
session_start();

// Establish the database connection
$conn = mysqli_connect("localhost", "root", "", "books");

// Check the connection
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
} else {
     "Verbindung erfolgreich";
}

if (isset($_GET['id'])) {
    // Get the book ID from the GET variable
    $book_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Create the SQL query to retrieve the book details
    $sql_book_details = "SELECT * 
                         FROM buecher 
                         WHERE id = '$book_id'";

    $result_book_details = $conn->query($sql_book_details);

    // Check if the book is found
    if ($result_book_details) {
        if (mysqli_num_rows($result_book_details) > 0) {
            // Retrieve book details from the database
            $book_details = $result_book_details->fetch_assoc();
    
            // Display book details
            $random_cover = "https://picsum.photos/300/450?random=" . $book_details['id'];
            echo '<div class="book-details">';
            echo '<div class="book-details-text-container">';
            echo '<h2 class="book-title">' . $book_details['title'] . '</h2>';
            echo '<p><strong>Autor:</strong> ' . $book_details['autor'] . '</p>';
            echo '<p><strong>Verfasser:</strong> ' . $book_details['verfasser'] . '</p>';
            echo '<p><strong>Sprache:</strong> ' . $book_details['sprache'] . '</p>';
            echo '<p><strong>Zustand:</strong> ' . $book_details['zustand'] . '</p>';
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
// Close the database connection
mysqli_close($conn);

?>

    </div>
</div>


   
   

<script>  const hamburger = document.querySelector('hamburger-icon');
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