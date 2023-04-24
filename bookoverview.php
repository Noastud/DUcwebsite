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
    // Connect to database
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "books";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully<br>";
    }

 
    try {
        $stmt = $conn->prepare("SELECT id, kurztitle, autor, title, foto, sprache, verfasser, zustand FROM buecher");
        $stmt->execute();
        $result = $stmt->get_result();
    } catch (mysqli_sql_exception $ex) {
        echo "Error: " . $ex->getMessage();
    }

  
    if ($result->num_rows > 0) {
        $i = 0;
        echo '<div class="books-container">';
        while($row = $result->fetch_assoc()) {
            if ($i % 3 == 0) {
                echo '<div class="book-row">';
            }
            echo '<div class="book">';
            echo '<img src="' . $row["foto"] . '" alt="Book cover">';
            echo '<div class="book-info">';
            echo '<h2>' . $row["kurztitle"] . '</h2>';
            echo '<p>' . $row["autor"] . '</p>';
            echo '<p>Language: ' . $row["sprache"] . '</p>';
            echo '<p>Condition: ' . $row["zustand"] . '</p>';
            echo '<button class="btn">Details</button>';
            echo '</div>';
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
    