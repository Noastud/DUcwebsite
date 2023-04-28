<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive - Register</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
   
    <script src="scripts.js" defer></script>
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
    <div class="green-box">
        <div class="modal-content">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <label for="username"></label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <br>
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="E-Mail" required>
                <br>
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</div>

<footer>
    <p>&copy; 2023 Book Archive. All rights reserved.</p>
</footer>

</body>
</html>
