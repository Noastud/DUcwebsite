<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive - Register</title>
    <link rel="stylesheet" href="styles.css">
   
    <script src="scripts.js" defer></script>
</head>
<body>
<header>
    <h1>Book Archive</h1>

    <nav>
        <button class="btn" id="loginBtn">Login</button>
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
