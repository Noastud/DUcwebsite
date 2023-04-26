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
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }
        .book {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            margin: 1rem;
            overflow: hidden;
            display: flex;
        }
        .book-info {
            width: 50%;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-left: 2rem;
        }
        .book-image {
            width: 40%;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
        .book-title {
            font-size: 2rem;
            margin: 0;
        }
        .book-author {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .book-category {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .book-language {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .book-condition {
            font-size: 1.2rem;
            margin: 0.5rem 0;
        }
        .btn {
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
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
    <div class="search-bar">
        <form>
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="main-content">
        <div class="books-container">
        <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully<br>";
}

$sql = "SELECT id, kurztitle, autor, title, foto, sprache, verfasser, zustand FROM buecher";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $i = 0;
    echo '<div class="books-container">';
    while($row = $result->fetch_assoc()) {
        if ($i % 3 == 0) {
            echo '<div class="book-row">';
        }
        echo '<div class="book">';

        $random_image_url = 'https://picsum.photos/300/450';
        echo '<div class="book-info">';
        echo '<h2>' . $row["kurztitle"] . '</h2>';
        echo '<p>' . $row["autor"] . '</p>';
        echo '<p>Language: ' . $row["sprache"] . '</p>';
        echo '<p>Condition: ' . $row["zustand"] . '</p>';
        echo '<button class="btn">Details</button>';
        echo '</div>';
        echo '<div class="book-image" style="background-image: url(' . $random_image_url . ')"></div>';
        echo '</div>';
        $i++;
        if ($i % 3 == 0) {
            echo '</div>';
            echo '<div class="book-row">';
        }
    }
    if ($i % 3 != 0) {
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "No books found.";
}


$conn->close();
?>
