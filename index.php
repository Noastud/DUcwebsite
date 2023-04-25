<php>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="styles.css">
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
    <main>
        <div class="typewriter">
            <h2>Bookly: Browse Antique Books.</h2>
          </div>
    </main>
    <script>const hamburger = document.querySelector('hamburger-icon');
        const nav = document.querySelector('header nav');
        
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
        </script>
</body>
</html>

</php>