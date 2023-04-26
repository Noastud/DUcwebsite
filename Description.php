<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Book Archive</h1>
        </div>

        <nav>
        <form method="post" action="description.php">

                <input type="text" name="q" placeholder="Search for a book">
                <button type="submit">Search</button>
            </form>

            <button class="btn login-btn">Login</button>

            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div id="hamburger-menu" class="hidden">
                <a href="admin.html" class="nav-link">Admin Panel</a>
                <a href="bookoverview.php" class="nav-link">Book Overview</a>
                <a href="register.html" class="nav-link">Register</a>
            </div>
        </nav>
    </header>

    <?php
// Start the session
session_start();

// Stelle die Verbindung zur Datenbank her
$conn = mysqli_connect("localhost", "root", "", "books");

// Überprüfe die Verbindung
if (!$conn) {
    die("Verbindung fehlgeschlagen: " . mysqli_connect_error());
}

// Hole den Suchbegriff aus der GET-Variable
$search_query = mysqli_real_escape_string($conn, $_GET['search_query']);

// Erstelle die SQL-Abfrage mit den gewünschten Suchkriterien
$sql_books = "SELECT Full_texts.*, kategorien.* 
              FROM Full_texts 
              INNER JOIN kategorien ON Full_texts.kategorie = kategorien.id
              WHERE 
              katalog LIKE '%$search_query%' OR 
              kurztitle LIKE '%$search_query%' OR 
              autor LIKE '%$search_query%' OR 
              title LIKE '%$search_query%' OR 
              verfasser LIKE '%$search_query%' OR 
              sprache LIKE '%$search_query%' OR 
              zustand LIKE '%$search_query%'";


$result_books = $conn->query($sql_books);

$search_results = array();
while ($row = $result_books->fetch_assoc()) {
    $search_results[] = $row['katalog'];
    $search_results[] = $row['kurztitle'];
    $search_results[] = $row['autor'];
    $search_results[] = $row['genre'];
}

echo json_encode($search_results);
?>


   
    <script>
        const hamburger = document.querySelector('.hamburger-icon');
        const nav = document.querySelector('header nav');

        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
        <script>
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
                        li.textContent = result;
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

    </script>
</body>
</html>
