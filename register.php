<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Archive</title>
    <link rel="stylesheet" href="style/styles.css?v=2">
    <style>
        .green-box {
            background-color: #839788;
            width: 1000px;
            height: 550px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .login-card {
            width: 400px;
            height: 550px;
            background-color: #d9d9d9;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login-card h2 {
            text-align: center;
            margin-top: 40px;
            font-size: 54px;
            color: #fff;
            margin-bottom: 30px;
        }

        .login-card label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .login-card input[type="text"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 20px;
            margin-bottom: 5px;
            margin-left: 15%;
            margin-right: 15%;
            text-align: left;
            background-color: #726C6C !important;
        }

        .login-card input[type="text"]:hover,
        .login-card input[type="text"]:focus,
        .login-card input[type="password"]:hover,
        .login-card input[type="password"]:focus {
            color: #000;
            background-color: #fff !important;
        }

        .login-card button {
            width: 30%;
            padding: 10px;
            background-color: #fff !important;
            color: black;
            margin: 0 auto;
            border: none;
            border-radius: 4px;
            font-size: 30px;
            cursor: pointer;
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

<div class="green-box">
    <div class="login-card">
        <h2>Register</h2>
        <form action="login.php" method="POST">
            <label for="username" class="input-label"></label>
            <input type="text" id="username" name="username" required onfocus="if(this.value=='Username') this.value='';" onblur="if(this.value=='') this.value='Username';" value="Username">
            <label for="email" class="input-label"></label>
            <input type="text" id="email" name="email" required onfocus="if(this.value=='E-mail') this.value='';" onblur="if(this.value=='') this.value='E-mail';" value="E-mail">
            <label for="password" class="input-label"></label>
            <input type="password" id="password" name="password" required onfocus="if(this.value=='Password') this.value='';" onblur="if(this.value=='') this.value='Password';" value="Password">
            <button type="submit">Submit</button>
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

