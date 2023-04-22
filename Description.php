<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
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
            <a href="bookoverview.php" class="nav-link">Book Overview</a>
            <a href="register.html" class="nav-link">Register</a>
        </div>
    </nav>
    </header>

    <main>
        <div class="book-details-container">
            <div class="book-image">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
            </div>
            <div class="book-description">
                <h2>Book Title</h2>
                <p>Author Name</p>
                <p>Published: 2020</p>
                <p>Genre: Fiction</p>
                <p>Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod justo odio, in mollis velit posuere ut. Duis pulvinar turpis a nulla sodales, vel blandit dolor convallis. In hac habitasse platea dictumst. Sed congue orci id est ullamcorper, ut faucibus ipsum molestie. Sed a nulla nec lacus mollis faucibus.</p>
                <button class="btn">Buy Now</button>
            </div>
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
