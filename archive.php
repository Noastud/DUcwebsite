<php>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive - Archived Books</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
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
            <a href="book-overview.html" class="nav-link">Book Overview</a>
            <a href="register.html" class="nav-link">Register</a>
        </div>
    </nav>
    </header>
    <main>
        <h2>Archived Books</h2>
        <section>
            <form id="filter-form">
                <label for="author">Author:</label>
                <input type="text" id="author">
                <label for="year">Year:</label>
                <input type="number" id="year" min="1900" max="2099">
                <label for="sales">Sales:</label>
                <input type="number" id="sales" min="0">
                <button type="submit">Filter</button>
            </form>
        </section>
        <section id="book-list">
            <!-- Books will be dynamically added here -->
        </section>
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