<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
    <style>
  .green-box {
   color: var(--primary);
    width: 200px;
    height: 200px;
    margin: 0 auto;
    margin-top: 100px;
}
    </style>
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
    <button class="btn" onclick="location.href='login.php'">Login</button>
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

<div class="green-box"></div>

<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeBtn">&times;</span>
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
</div>

<script>
    // Add this to your scripts.js file
    const loginBtn = document.getElementById('loginBtn');
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
</script>
</body>
</html>
