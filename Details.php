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

<body>
    <?php
        // Include the header
        include('header.php');
    ?>

    <div class="search-bar">
        <form method="post" action="search.php">
            <input type="text" name="search_query" placeholder="Search...">
            <button type="submit" name="search_btn">Search</button>
        </form>
    </div>

    <div class="main-content">
        <div class="books-container">
            <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "username", "password", "database_name");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Get all books from the database
                $sql = "SELECT * FROM books";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='book'>";
                        echo "<img src='" . $row['book_cover'] . "' alt='Book cover'>";
                        echo "<div class='book-info'>";
                        echo "<h2>" . $row['book_title'] . "</h2>";
                        echo "<p>" . $row['author_name'] . "</p>";
                        echo "<p>Published: " . $row['published_year'] . "</p>";
                        echo "<p>Genre: " . $row['genre'] . "</p>";
                        echo "<a href='book_details.php?book_id=" . $row['book_id'] . "' class='btn'>Details</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No books found.</p>";
                }

                // Close the database connection
                mysqli_close($conn);
            ?>
        </div>
    </div>

    <?php
        // Include the footer
        include('footer.php');
    ?>
</body>
</html>
