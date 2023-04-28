<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="styles.css?v=2">
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


<?php
// Start the session
session_start();

// Establish the database connection
$conn = mysqli_connect("localhost", "root", "", "books");

// Check the connection
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
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
            echo "<h2>" . $book_details['title'] . "</h2>";
            echo "<p><strong>Autor:</strong> " . $book_details['autor'] . "</p>";
            echo "<p><strong>Verfasser:</strong> " . $book_details['verfasser'] . "</p>";
            echo "<p><strong>Erscheinungsjahr:</strong> " . $book_details['erscheinungsjahr'] . "</p>";
            echo "<p><strong>Sprache:</strong> " . $book_details['sprache'] . "</p>";
            echo "<p><strong>Zustand:</strong> " . $book_details['zustand'] . "</p>";
            echo "<p><strong>Inhalt:</strong></p>";
            echo "<p>" . $book_details['text'] . "</p>";
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



    <script>
     const hamburger = document.querySelector('hamburger-icon');
        const nav = document.querySelector('header nav');
        
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
      
        const searchInput = document.querySelector('.search-bar input[type="text"]');
const popup = document.querySelector('.popup');
const popupList = popup.querySelector('ul');

searchInput.addEventListener('input', function() {
    const inputValue = this.value.trim();
    if (inputValue === '') {
        popup.style.display = 'none';
    } else {
        fetch('search.php?search_query=' + inputValue)
            .then(response => response.json())
            .then(data => {
                popupList.innerHTML = '';
                data.forEach(result => {
                    const li = document.createElement('li');
                    li.textContent = result.title + ' by ' + result.author;
                    popupList.appendChild(li);
                });
                popup.style.display = 'block';
            })
            .catch(error => {
                console.error(error);
            });
    }
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.search-bar')) {
        popup.style.display = 'none';
    }
});


</script>

</body>
</html>
