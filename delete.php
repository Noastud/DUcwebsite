<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive - Edit Page</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
    <style>
  
    </style>
    <script src="script/script.js"></script>
</head>
<body class="difback">
<header>
   <!--code für weiterleitung an index.php dient als logo für schnellen zugriff auf hauptseite-->
  <button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
      <h1>Bookly</h1>
    </div>
  </button>
  <!-- Code für  navigation bar, login, und hamburger menu. -->
  <nav>
  <?php
        session_start();

        // Überprüft ob der User eingeloggt ist
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Zeigt den "Logout" button an
            echo '<button class="btn" onclick="location.href=\'logout.php\'">Logout</button>';
        } else {
            // Zeigt den "Login" button an
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
            <a href="nutzer.php" class="nav-link">Nutzer</a>
        </div>
        </div>
  </nav>
</header>   
<div class="wrapper">
  <div class="box">
  <?php
  include 'conf.php';

  if (isset($_GET['id'])) {
    // Get the ID from another page
    $book_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Store the book ID in the session
    $_SESSION['book_id'] = $book_id;

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the delete action is triggered
      if (isset($_POST['delete'])) {
        // SQL statement to delete the book entry
        $sql_delete_book = "DELETE FROM buecher WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql_delete_book);
        mysqli_stmt_bind_param($stmt, "s", $book_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
          echo "Book deleted successfully.";
          // Redirect to a desired page after successful deletion
          header("Location: index.php");
          exit();
        } else {
          echo "Error deleting book: " . mysqli_error($conn);
        }
      }

      // Check if the approve edit action is triggered
      if (isset($_POST['approve_edit'])) {
        // Get the updated values from the form
        $updated_title = mysqli_real_escape_string($conn, $_POST['title']);
        $updated_autor = mysqli_real_escape_string($conn, $_POST['autor']);
        $updated_verfasser = mysqli_real_escape_string($conn, $_POST['verfasser']);
        $updated_sprache = mysqli_real_escape_string($conn, $_POST['sprache']);
        $updated_zustand = mysqli_real_escape_string($conn, $_POST['zustand']);

        // SQL statement to update the book entry
        $sql_update_book = "UPDATE buecher 
                            SET title = ?, autor = ?, 
                                verfasser = ?, sprache = ?, 
                                zustand = ? 
                            WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql_update_book);
        mysqli_stmt_bind_param($stmt, "ssssss", $updated_title, $updated_autor, $updated_verfasser, $updated_sprache, $updated_zustand, $book_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
          echo "Book updated successfully.";
          // Refresh the page to show the updated details
          header("Location: details.php?id=$book_id");
          exit();
        } else {
          echo "Error updating book: " . mysqli_error($conn);
        }
      }
    }

    // SQL statement to get the details of the book
    $sql_book_details = "SELECT * 
                         FROM buecher 
                         WHERE id = ?";
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql_book_details);
    mysqli_stmt_bind_param($stmt, "s", $book_id);
    // Execute the query
    $result_book_details = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result_book_details) {
      if (mysqli_stmt_num_rows($stmt) > 0) {
        $book_details = mysqli_stmt_get_result($stmt)->fetch_assoc();
        $random_cover = "https://picsum.photos/300/450?random=" . $book_details['id'];
        ?>
        <div class="book-details">
          <div class="book-details-text-container">
                        
            <form method="post" action="">
                <p><strong>Kurztitle:</strong></p>
                <input type="text" name="kurztitle" value="<?php echo $book_details['kurztitle']; ?>">
                <p><strong>Titel:</strong></p>
                <input type="text" name="title" value="<?php echo $book_details['title']; ?>">
                <p><strong>Autor:</strong></p>
                <input type="text" name="autor" value="<?php echo $book_details['autor']; ?>">
                <p><strong>Verfasser:</strong></p>
                <input type="text" name="verfasser" value="<?php echo $book_details['verfasser']; ?>">
                <p><strong>Sprache:</strong></p>
                <input type="text" name="sprache" value="<?php echo $book_details['sprache']; ?>">
                <p><strong>Zustand:</strong></p>
                <input type="text" name="zustand" value="<?php echo $book_details['zustand']; ?>">
                <br>
                <input type="submit" name="approve_edit" value="Approve Edit" class="btn">
                <input type="submit" name="delete" value="Delete" class="btn" style="background-color: #dc3545;">
        </form>            
          </div>
          <div class="book-details-image">
            <img src="<?php echo $random_cover; ?>">
          </div>
         <!-- Add New Book Button -->
          <button class="btn" style="background-color: #ADD8E6;" onclick="location.href='newbooks.php'">Add New Book</button>

        </div>
        <?php
      }
    } else {
      echo "No book found.";
    }
  } else {
    echo "No book ID provided.";
  }

  mysqli_close($conn);
  ?>
  </div>
</div>
<script>
// Your Javascript Code
</script>
</body>
</html>
