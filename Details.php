
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookly</title>
    <link rel="stylesheet" href="styles.css?v=2">
</head>

<body class="book-page">
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
      <a href="register.html" class="nav-link">Register</a>
    </div>
  </nav>
</header>

   
      <div>
  <h1 class="title5">Bookly</h1>
</div>
<div class="search-bar">
    <form method="post" action="">
        <input type="text" name="search_query" placeholder="Search..." onfocus="showPopup()">
        <button type="submit" name="search_btn"></button>
    </form>
</div>

<div class="main-content">
    <div class="books-container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "books";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['search_btn'])) {
        $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
        $sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher WHERE kurztitle LIKE '%$search_query%' OR autor LIKE '%$search_query%' OR zustand LIKE '%$search_query%'";
    } else {
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'default';
        $sort_options = array('default', 'kurztitle', 'autor', 'zustand');
        if (!in_array($sort, $sort_options)) {
            $sort = 'default';
        }

        if ($sort == 'default') {
            $sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher";
        } else {
          $sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher WHERE kurztitle != '' AND autor != '' AND zustand != '' ORDER BY $sort ASC";
        }
    }

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="book-container">';
        while($row = mysqli_fetch_assoc($result)) {
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
        echo '</div>';
    } else {
        echo "0 results";
    }

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
</body>
</html>
