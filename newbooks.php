<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
</head>
<body>
<header>
  <!-- Code for redirection to index.php, serves as a logo for quick access to the main page. -->
  <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
      <h1>Bookly</h1>
    </div>
  </button>
  <!-- Code for the navigation bar, login, and hamburger menu. -->
  <nav>
  <?php
        session_start();
        include 'conf.php';

        // Check if the user is logged in
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // User is logged in, show the "Logout" button
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // User is not logged in, show the "Login" button
            echo '<button class="btn" onclick="location.href=\'login.php\'">Login</button>';
        }
        ?>
    <hamburger-icon>
      <span></span>
      <span></span>
      <span></span>
    </hamburger-icon>
    <div id="hamburger-menu" class="hidden">
            <a href="index.php" class="nav-link">Home</a>
            <a href="bookoverview.php" class="nav-link">Book Overview</a>
            <a href="bookoverview.php" class="nav-link">Search</a>
        </div>
  </nav>
</header>   
<div class="wrapper">
    <h2>Add New Book</h2>
    <form method="post" action="">
        <p><strong>Kurztitle:</strong></p>
        <input type="text" name="kurztitle" required>
        <p><strong>Titel:</strong></p>
        <input type="text" name="title" required>
        <p><strong>Autor:</strong></p>
        <input type="text" name="autor" required>
        <p><strong>Verfasser:</strong></p>
        <input type="text" name="verfasser" required>
        <p><strong>Sprache:</strong></p>
        <input type="text" name="sprache" required>
        <p><strong>Zustand:</strong></p>
        <input type="text" name="zustand" required>
        <br>
        <input type="submit" name="add_book" value="Add Book" class="btn">
    </form>
</div>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    // Get the input values from the form
    $kurztitle = mysqli_real_escape_string($conn, $_POST['kurztitle']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $verfasser = mysqli_real_escape_string($conn, $_POST['verfasser']);
    $sprache = mysqli_real_escape_string($conn, $_POST['sprache']);
    $zustand = mysqli_real_escape_string($conn, $_POST['zustand']);

    // SQL statement to insert the new book into the database
    $sql_add_book = "INSERT INTO buecher (kurztitle, title, autor, verfasser, sprache, zustand)
                     VALUES ('$kurztitle', '$title', '$autor', '$verfasser', '$sprache', '$zustand')";

    // Execute the query
    if (mysqli_query($conn, $sql_add_book)) {
        echo "Book added successfully.";
        // Redirect to a desired page after successful addition
        header("Location: bookoverview.php");
        exit();
    } else {
        echo "Error adding book: " . mysqli_error($conn);
    }
}

$conn->close();
?>

</body>
</html>
