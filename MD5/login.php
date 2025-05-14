<?php
session_start();

$error_message = ''; // Initialize the error message variable

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $submitted_password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'user_system');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT password FROM users WHERE email=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($submitted_password, $user['password'])) {
            // Successful login
            $_SESSION['email'] = $email;  // Store session information
            header('Location: home.php'); // Redirect to home page
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid email or password. Please try again.";
        }
    } else {
        // Invalid email
        $error_message = "Invalid email or password. Please try again."; 
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Display the error message if login fails -->
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
