<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
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
            <a href="book-overview.html" class="nav-link">Book Overview</a>
            <a href="register.html" class="nav-link">Register</a>
        </div>
    </nav>
    </header>
    <div class="search-bar">
        <form>
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="main-content">
        <div class="books-container">
            <div class="book">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                <div class="book-info">
                    <h2>Book Title</h2>
                    <p>Author Name</p>
                    <p>Published: 2020</p>
                    <p>Genre: Fiction</p>
                    <button class="btn">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                <div class="book-info">
                    <h2>Book Title</h2>
                    <p>Author Name</p>
                    <p>Published: 2020</p>
                    <p>Genre: Fiction</p>
                    <button class="btn">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                <div class="book-info">
                    <h2>Book Title</h2>
                    <p>Author Name</p>
                    <p>Published: 2020</p>
                    <p>Genre: Fiction</p>
                    <button class="btn">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                <div class="book-info">
                    <h2>Book Title</h2>
                    <p>Author Name</p>
                    <p>Published: 2020</p>
                    <p>Genre: Fiction</p>
                    <button class="btn">Details</button>
                </div>
            </div>
            <div class="book">
                <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                <div class="book-info">
                    <h2>Book Title</h2>
                    <p>Author Name</p>
                    <p>Published: 2020</p>
                    <p>Genre: Fiction</p>
                    <button class="btn">Details</button>
                </div>
            </div>
                <div class="book">
                    <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                    <div class="book-info">
                        <h2>Book Title</h2>
                        <p>Author Name</p>
                        <p>Published: 2020</p>
                        <p>Genre: Fiction</p>
                        <button class="btn">Details</button>
                    </div>
                </div>
                <div class="book">
                    <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                    <div class="book-info">
                        <h2>Book Title</h2>
                        <p>Author Name</p>
                        <p>Published: 2020</p>
                        <p>Genre: Fiction</p>
                        <button class="btn">Details</button>
                    </div>
                </div>
                
                <div class="book">
                    <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                    <div class="book-info">
                        <h2>Book Title</h2>
                        <p>Author Name</p>
                        <p>Published: 2020</p>
                        <p>Genre: Fiction</p>
                        <button class="btn">Details</button>
                    </div>
                </div>
                
                <div class="book">
                    <img src="https://images.unsplash.com/photo-1542831379-9c40d0a93f24" alt="Book cover">
                    <div class="book-info">
                        <h2>Book Title</h2>
                        <p>Author Name</p>
                        <p>Published: 2020</p>
                        <p>Genre: Fiction</p>
                        <button class="btn">Details</button>
                    </div>
                </div>
            </div>
        </div>
        <script>const hamburger = document.querySelector('hamburger-icon');
        const nav = document.querySelector('header nav');
        
        hamburger.addEventListener('click', function() {
            nav.classList.toggle('active');
        });
        </script>
    </body>
    
    </html>
    