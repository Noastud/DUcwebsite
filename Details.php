<?php
    // Start the session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly</title>
    <link rel="stylesheet" href="styles.css?v=2">
</head>

<body>
<header>
        <h1>Bookly</h1>

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
            <a href="register.html" class="nav-link">Register</a>
        </div>
    </nav>
    </header>
   
      <div>
  <h1 class="title5">Bookly</h1>
</div>
    
<div class="search-bar">
    <form method="post" action="Description.php">
        <input type="text" name="search_query" placeholder="Search..." onfocus="showPopup()">
        <button type="submit" name="search_btn"></button>
    </form>
    <div class="popup" id="popup">
        <ul>
            <li>Recommendation 1</li>
            <li>Recommendation 2</li>
            <li>Recommendation 3</li>
            <li>Recommendation 4</li>
            <li>Recommendation 5</li>
        </ul>
    </div>
</div>


    <div class="main-content">
        <div class="books-container">
        <?php
// Start the session
session_start();

// Stelle die Verbindung zur Datenbank her
$conn = mysqli_connect("localhost", "root", "", "books");

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
#fuck
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


        function showPopup() {
    var popup = document.getElementById("popup");
    var input = document.querySelector(".search-bar input[type='text']");
    var search_query = input.value;
    if (search_query !== '') {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'Description.php?search_query=' + search_query);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var results = JSON.parse(xhr.responseText);
                var ul = document.createElement('ul');
                results.forEach(function(result) {
                    var li = document.createElement('li');
                    li.textContent = result;
                    ul.appendChild(li);
                });
                popup.innerHTML = '';
                popup.appendChild(ul);
                popup.style.display = "block";
            } else {
                console.log('Request failed. Returned status of ' + xhr.status);
            }
        };
        xhr.send();
    }
}


function hidePopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

document.addEventListener("click", function(event) {
    var popup = document.getElementById("popup");
    var input = document.querySelector(".search-bar input[type='text']");
    if (event.target !== popup && event.target !== input) {
        hidePopup();
    }
});

        </script>
</body>
</html>