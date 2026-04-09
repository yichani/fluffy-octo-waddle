<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Practice Page</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav {
            background-color: #555;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 10px;
            text-decoration: none;
        }

        .container {
            padding: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            margin: 10px 0;
            border-radius: 8px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <h1>My Practice Website</h1>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>

    <div class="container">
        <div class="box">
            <h2>Welcome</h2>
            <p>This is a simple HTML practice layout.</p>
        </div>

        <div class="box">
            <h2>Login</h2>
            <input type="text" placeholder="Username"><br><br>
            <input type="password" placeholder="Password"><br><br>
            <button>Login</button>
        </div>
    </div>

    <footer>
        <p>© 2026 Practice Page</p>
    </footer>

</body>
</html>