<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css?v=2">
</head>
<body class="book-page">
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

        // überprüft ob der user eingeloggt ist
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // wenn der user eingeloggt ist wird der logout button angezeigt
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // wenn der user nicht eingeloggt ist wird der login button angezeigt
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
            <a href="index.php" class="nav-link">Home</a>
            <a href="bookoverview.php" class="nav-link">Book Overview</a>
            <a href="nutzer.php" class="nav-link">Nutzer</a>
        </div>
    </nav>
</header>
<?php
include 'conf.php';

// erstellt eine variable die das sort formular auswertet und die datenbank nach den ausgewählten kriterien sortiert
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$sort_options = array('default', 'kurztitle', 'autor', 'zustand');
if (!in_array($sort, $sort_options)) {
    $sort = 'default';
}

// PHP-Code für die Suche
$search_query = "";
if (isset($_POST['search_btn'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
}

// Prepare the statement
if ($sort == 'default') {
    $sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher";
    $stmt = mysqli_prepare($conn, $sql);
} else {
    $sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher WHERE kurztitle != '' AND autor != '' AND zustand != '' ORDER BY ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $sort);
}

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result set
$result = mysqli_stmt_get_result($stmt);

?>
<!--code für Sortierungsformular-->
<div>
    <form>
        <label for="sort">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="default"<?php if ($sort == 'default') echo ' selected="selected"'; ?>>Default</option>
            <option value="kurztitle"<?php if ($sort == 'kurztitle') echo ' selected="selected"'; ?>>Title</option>
            <option value="autor"<?php if ($sort == 'autor') echo ' selected="selected"'; ?>>Author</option>
            <option value="zustand"<?php if ($sort == 'zustand') echo ' selected="selected"'; ?>>Category</option>
        </select>
    </form>
</div>
<!--code für Suchleiste-->
<div class="search-bar">
    <form method="post" action="">
        <input type="text" name="search_query" placeholder="Search..." onfocus="showPopup()">
        <button type="submit" name="search_btn"></button>
    </form>
</div>

<div class="main-content">
    <div class="book-container">
        <?php
        // Iterate over the result set
        while ($row = mysqli_fetch_assoc($result)) {
            $random_cover = "https://picsum.photos/300/450?random=" . $row['id'];
            echo '<div class="book">';
            echo '<div class="book-info">';
            echo '<h3 class="book-title">' . $row['kurztitle'] . '</h3>';
            echo '<p class="book-author"><strong>Author:</strong> ' . $row['autor'] . '</p>';
            echo '<p class="book-category"><strong>Category:</strong> ' . $row['zustand'] . '</p>';
            echo '<p class="book-language"><strong>Language:</strong> ' . $row['sprache'] . '</p>';
            echo '<a href="Description.php?id=' . $row['id'] . '" class="btn" style="text-decoration: none;">More Details</a>';
            echo '</div>';
            echo '<div class="book-image" style="background-image: url(' . $random_cover . ')"></div>';
            echo '</div>';
        }

        // Schließt das Statement
        mysqli_stmt_close($stmt);
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

<!--code für footer-->
<nav class="nav2">
    <a class="nav-link" href="#">Books</a>
</nav>

</body>
</html>
