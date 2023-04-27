<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
<style>
    body {
      background-color: #EEE0CB;
      font-family: Arial, sans-serif;
      color: #000;
      margin: 0;
    }

    .book-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center; /* center the book containers horizontally */
      max-width: 1200px;
      margin: 0 auto; /* center the book container vertically */
    }

    .book {
      display: flex;
      flex-direction: row;
      align-items: center;
      position: relative;
      width: calc(33.33% - 2rem);
      height: 360px;
      background-color: #fff;
      border-radius: 0.5rem;
      transition: all 0.2s ease-in-out;
      overflow: hidden;
      background-color: transparent;
    }

    .book:hover {
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
      transform: translateY(-10px);
    }

    .book-image {
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      width: 60%;
      height: 100%;
      object-fit: cover; /* maintain aspect ratio of book cover image */
    }

    .book-info {
      position: relative;
      width: 40%;
      height: 100%;
      padding: 1rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: flex-start;
      background-color: transparent;
      transition: all 0.2s ease-in-out;
    }

    .book:hover .book-info {
      transform: translateX(5%);
    }

    .book-title {
      font-size: 1.5rem;
      margin: 0.5rem 0;
    }

    .book-author {
      font-size: 1rem;
      margin: 0.25rem 0;
    }

    .book-category {
      font-size: 1rem;
      margin: 0.25rem 0;
    }

    .book-language {
      font-size: 1rem;
      margin: 0.25rem 0;
    }

    .book-condition {
      font-size: 1rem;
      margin: 0.25rem 0;
    }

    .btn {
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 0.5rem;
      padding: 0.5rem 1rem;
      font-size: 1rem;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #fff;
      color: #000;
    }


    </style>
</head>
<body>
    <header>
        <h1>Book Archive</h1>
        <nav>
            <button class="btn" ><a href="login.php"> Login</a></button>
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

    <div class="main-content">
        <div class="book-container">
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, kurztitle, autor, sprache, zustand FROM buecher";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $random_cover = "https://picsum.photos/300/450?random=" . $row['id'];
        echo '<div class="book">';
        echo '<div class="book-info">';
        echo '<h3 class="book-title">' . $row['kurztitle'] . '</h3>';
        echo '<p class="book-author"><strong>Author:</strong> ' . $row['autor'] . '</p>';
        echo '<p class="book-category"><strong>Category:</strong> ' . $row['zustand'] . '</p>';
        echo '<p class="book-language"><strong>Language:</strong> ' . $row['sprache'] . '</p>';
        echo '<a href="Description.php?id=' . $row['id'] . '" class="btn">More Details</a>';
        echo '</div>';
        echo '<div class="book-image" style="background-image: url(' . $random_cover . ')"></div>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>


        </div>
    </div>
    <script>const hamburger = document.querySelector('hamburger-icon');
        const nav = document.querySelector('header nav');
        
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
        </script>
</body>
</html>
