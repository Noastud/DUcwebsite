<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="style/styles.css">
  
    <script src="scripts.js" defer></script>
</head>
<body>
<header>
<button onclick="location.href='index.php'" style="background:none; border:none; font-size: 30px;">
    <div class="logo">
    <h1>Bookly</h1>
    </div>
</button>
<nav>
    <button class="btn" onclick="location.href='login.php'">login</button>
    <hamburger-icon>
    <span></span>
    <span></span>
    <span></span>
    </hamburger-icon>
    <div id="hamburger-menu" class="hidden">
    <a href="admin.html" class="nav-link">Admin Panel</a>
    <a href="bookoverview.php" class="nav-link">Book Overview</a>
    <a href="details.php" class="nav-link">Search</a>    </div>
    </nav>
</header>
<?php
// Start the session
session_start();

// Include the database configuration file
include 'conf.php';

// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to insert the user data into the table
    $sql = "INSERT INTO benutzer (benutzername, passwort, email) VALUES ('$username', '$hashedPassword', '$email')";

    // Execute the SQL statement
    if (mysqli_query($conn, $sql)) {
        // Registration successful
        $_SESSION['message'] = "Registration successful. You can now login.";
        header("Location: login.php");
        exit();
    } else {
        // Registration failed
        $_SESSION['error'] = "Error: " . mysqli_error($conn);
        header("Location: register.php");
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>


<div class="green-box">
    <div class="register-card">
        <h2>Register</h2>
        <?php
        // Display error message if exists
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="register.php" method="POST">
            <label for="username" class="input-label"></label>
            <input type="text" id="username" name="username" required onfocus="if(this.value=='Username') this.value='';" onblur="if(this.value=='') this.value='Username';" value="Username" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="name" class="input-label"></label>
            <input type="text" id="name" name="name" required onfocus="if(this.value=='Name') this.value='';" onblur="if(this.value=='') this.value='Name';" value="Name" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="vorname" class="input-label"></label>
            <input type="text" id="vorname" name="vorname" required onfocus="if(this.value=='Vorname') this.value='';" onblur="if(this.value=='') this.value='Vorname';" value="Vorname" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="email" class="input-label"></label>
            <input type="text" id="email" name="email" required onfocus="if(this.value=='E-mail') this.value='';" onblur="if(this.value=='') this.value='E-mail';" value="E-mail" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="password" class="input-label"></label>
            <input type="password" id="password" name="password" required onfocus="if(this.value=='Password') this.value='';" onblur="if(this.value=='') this.value='Password';" value="Password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 20px; margin-bottom: 5px; margin-left: 15%; margin-right: 15%; text-align: left; background-color: #726C6C !important;">
            <label for="admin" class="input-label"></label>

            <button type="submit" style="width: 30%; padding: 10px; background-color: #fff !important; color: black; margin: 0 auto; border: none; border-radius: 4px; font-size: 30px; cursor: pointer;">Submit</button>
        </form>
    </div>
</div>


<script>
    // Add this to your scripts.js file
    const loginBtn = document.querySelector('.btn');
    const closeBtn = document.getElementById('closeBtn');
    const loginModal = document.getElementById('loginModal');

    loginBtn.onclick = () => {
        loginModal.style.display = 'block';
    }

    closeBtn.onclick = () => {
        loginModal.style.display = 'none';
    }

    window.onclick = (event) => {
        if (event.target === loginModal) {
            loginModal.style.display = 'none';
        }
    }
    
    // JavaScript for hamburger button
    const hamburger = document.querySelector('hamburger-icon');
    const nav = document.querySelector('header nav');
    
    hamburger.addEventListener('click', function() {
        nav.classList.toggle('active');
    });
</script>
</body>
</html>
