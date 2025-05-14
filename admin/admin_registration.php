<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// This script is for adding an admin for testing purposes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        if (isset($_POST['admin_name']) && isset($_POST['password'])) {
            $admin_name = $_POST['admin_name'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'obcs');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if admin_name already exists
            $check_query = "SELECT id FROM admins WHERE admin_name = ?";
            $check_stmt = $conn->prepare($check_query);
            $check_stmt->bind_param("s", $admin_name);
            $check_stmt->execute();
            $check_stmt->store_result();

            if ($check_stmt->num_rows > 0) {
                echo "<p class='error-message'>Admin name already exists. Please choose a different name.</p>";
            } else {
                // Insert admin details
                $query = "INSERT INTO admins (admin_name, password) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $admin_name, $password);

                if ($stmt->execute()) {
                    echo "<p class='success-message'>Admin registered successfully!</p>";
                } else {
                    echo "<p class='error-message'>Error: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
            $check_stmt->close();
            $conn->close();
        } else {
            echo "<p class='error-message'>Please fill in all fields.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <style>
        body {
            background-color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.5;
        }

        .content {
            z-index: 1;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: black;
        }

        label {
            display: block;
            margin: 5px 0 5px;
            font-weight: bold;
            color: black;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <video autoplay muted loop class="video-bg">
        <source src="../media/admin.mp4" type="video/mp4">
    </video>
    <div class="content">
        <form action="admin_registration.php" method="POST">
            <h2>Register Admin</h2>
            <label for="admin_name">Admin Name:</label>
            <input type="text" name="admin_name" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="register">Register Admin</button>
        </form>
    </div>
</body>

</html>
