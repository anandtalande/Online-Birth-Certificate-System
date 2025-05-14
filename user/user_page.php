<?php
session_start();

$error_message = ''; // Initialize the error message variable

if (isset($_POST['login'])) {
    $number = $_POST['number'];
    $password_input = $_POST['password'];  // Plaintext password from the form

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'obcs');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user data by mobile number
    $query = "SELECT * FROM users WHERE number='$number'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Hash the input password using MD5 and compare it with the stored hash
        if (md5($password_input) === $row['password']) {
            // Successful login
            $_SESSION['number'] = $row['number'];  // Store the mobile number in session
            header('Location: ../home2.php');  // Redirect to a home or user page
            exit();
        } else {
            // Invalid password
            $error_message = "Invalid mobile number or password. Please try again.";
        }
    } else {
        // Invalid mobile number
        $error_message = "Invalid mobile number or password. Please try again.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <video autoplay muted loop class="video-bg">
            <source src="../media/navbar.mp4" type="video/mp4"> <!-- Replace with your video -->
        </video>
        <div class="card shadow-lg highlighted-card">
            <div class="card-body">
                <h2 class="text-center mb-3">Online Birth Certificate System</h2>
                <h5 class="text-center mb-4">User Login Form</h5>
                
                <!-- Display error message if any -->
                <?php if ($error_message != ''): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobile" name="number" placeholder="Enter your mobile number" required>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer; user-select: none;">👁️</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                </form>
                <div class="last text-center mt-4">
                    <p>Don't have an account? <a href="registration.php" class="signup-link">Sign Up</a></p>
                    <p><a href="../home.php" class="back-home">Back to Home</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                // toggle the type attribute
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                // toggle the eye icon
                this.textContent = type === 'password' ? '👁️' : '🙈';
            });
        }
    </script>
</body>
</html>
