<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive - Edit Page</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
    <style>
      /* Custom styles for the input fields */
      input[type="text"] {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        background-color: #f2f2f2;
        margin-bottom: 10px;
        color: black;
      }

      /* Custom styles for the book details */
      .book-details {
        display: flex;
        align-items: flex-start;
      }

      .book-details-text-container {
        flex: 1;
      }

      .book-details-image {
        margin-left: 20px;
      }

      .book-details-image img {
        width: 300px;
        height: 450px;
      }
    </style>
    <script src="script/script.js"></script>
</head>
<body class="difback">
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
      <a href="admin.html" class="nav-link">Admin Panel</a>
      <a href="bookoverview.php" class="nav-link">Book Overview</a>
      <a href="details.php" class="nav-link">Search</a>   
    </div>
  </nav>
</header>   
<div class="wrapper">
  <div class="box">
  <?php
  // Start the session
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
        $sql_delete_book = "DELETE FROM buecher WHERE id = '$book_id'";

        // Execute the query
        if (mysqli_query($conn, $sql_delete_book)) {
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
                            SET title = '$updated_title', autor = '$updated_autor', 
                                verfasser = '$updated_verfasser', sprache = '$updated_sprache', 
                                zustand = '$updated_zustand' 
                            WHERE id = '$book_id'";

        // Execute the query
        if (mysqli_query($conn, $sql_update_book)) {
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
                         WHERE id = '$book_id'";
    // Execute the query
    $result_book_details = $conn->query($sql_book_details);

    // Check if the query was successful
    if ($result_book_details) {
      if (mysqli_num_rows($result_book_details) > 0) {
        $book_details = $result_book_details->fetch_assoc();
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
        </div>
        <?php
      }
    } else {
      echo "No book found.";
    }
  } else {
    echo "No book ID provided.";
  }

  $conn->close();
  ?>
  </div>
</div>
<script>
// Your Javascript Code
</script>
</body>
</html>
