<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .title5 {
    text-align: center;
    margin-top: 30px;
  }
  
  .title5 h1 {
    font-size: 50px;
    margin: 0;
  }

  .search-bar input[type="text"] {
background-color: #FFFFFF;
width: 60%; /* geändert auf 50% */
border-radius: 25px;
padding: 10px;
border: none;
outline: none;
}
.search-bar {
display: flex;
justify-content: center;
align-items: center;
margin: 20px auto;
position: relative; 
}

.search-bar input[type="text"] {
background-color: #FFFFFF;
width: 80%;
border-radius: 25px;
padding: 10px;
border: none;
outline: none;
}

.search-bar button {
background-color: #fff;
border: none;
border-radius: 20px;
width: 40px;
height: 40px;
position: absolute; 
right: 0px; 
margin-right: 45%;

}

.search-bar button:before {
content: "\1F50E";
font-size: 20px;
color: #555;
line-height: 40px;
text-align: center;
display: block;

}
    </style>

<body>
<header>
        <h1>Book Archive</h1>

    <nav>
            <button class="btn"> Login</button>
        <hamburger-icon>
            <span></span>
            <span></span>
            <span></span>
        </hamburger-icon>
        <div id="hamburger-menu" class="hidden">
            <a href="admin.html" class="nav-link">Admin Panel</a>
            <a href="book-overview.html" class="nav-link">Book Overview</a>
            <a href="register.html" class="nav-link">Register</a>
        </div>
    </nav>
    </header>
   
      <div class="title5">
  <h1>Bookly</h1>
</div>
    
    <div class="search-bar">
        <form method="post" action="search.php">
            <input type="text" name="search_query" placeholder="Search...">
            <button type="submit" name="search_btn">Search</button>
        </form>
    </div>

    <div class="main-content">
        <div class="books-container">
        <?php
// Start the session
session_start();

// Stelle die Verbindung zur Datenbank her
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Überprüfe die Verbindung
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Überprüfe, ob das Suchformular abgesendet wurde
if(isset($_POST['search_btn'])) {

    // Hole den Suchbegriff aus dem Formular
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);

    // Erstelle die SQL-Abfrage mit den gewünschten Suchkriterien
    $sql_books = "SELECT buecher.*, kategorien.* 
                  FROM buecher 
                  INNER JOIN kategorien ON buecher.kategorie = kategorien.id
                  WHERE 
                  katalog LIKE '%$search_query%' OR 
                  kurztitle LIKE '%$search_query%' OR 
                  autor LIKE '%$search_query%' OR 
                  genre LIKE '%$search_query%'";
                  
    $result_books = $conn->query($sql_books);

} else {
    // Das Suchformular wurde nicht abgesendet, zeige alle Bücher an

    $books_per_page = 20;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $books_per_page;

    // Sortierung der Bücher
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'katalog';
    $sort_options = array('katalog', 'nummer', 'kurztitle', 'autor', 'kategorie');
    if (!in_array($sort, $sort_options)) {
        $sort = 'katalog';
    }
    if ($sort == 'kategorie') {
      $sort = 'kategorien.id';
    }

    $sql_total = "SELECT COUNT(*) FROM buecher";
    $result_total = $conn->query($sql_total);
    $total_books = $result_total->fetch_row()[0];
    $total_pages = ceil($total_books / $books_per_page);

    $sql_books = "SELECT buecher.*, kategorien.* 
                  FROM buecher 
                  INNER JOIN kategorien ON buecher.kategorie = kategorien.id
                  ORDER BY $sort 
                  LIMIT $offset, $books_per_page";

    $result_books = $conn->query($sql_books);
}

?>    
        </div>
    </div>

    <?php
        // Include the footer
        include('footer.php');
    ?>
      <script>const hamburger = document.querySelector('hamburger-icon');
        const nav = document.querySelector('header nav');
        
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
        </script>
</body>
</html>
