<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy all session data
    header('Location: login.php'); // Redirect to login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin: 0 0 20px 0;
            font-size: 24px;
            color: #333;
        }

        p {
            font-size: 18px;
            margin-bottom: 30px;
            color: #666;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Home Page!</h2>
        <p>You are logged in as: <strong><?php echo $_SESSION['email']; ?></strong></p>

        <form method="get" action="/MD5/login.php">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>
