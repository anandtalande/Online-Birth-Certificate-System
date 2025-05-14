<?php
if (isset($_POST['register'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $dob = $_POST['dob'];
    $birthplace = $_POST['birthplace'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // MD5 encryption for the password

    // Auto-generate certificate number (example: random number, but you could use any logic)
    $certificate_number = rand(100000, 999999);  // 6-digit random certificate number

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'obcs');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user details along with the certificate number
    $query = "INSERT INTO users (first_name, last_name, date_of_birth, birthplace, address, number, email, password, certificate_number) 
              VALUES ('$first_name', '$last_name', '$dob', '$birthplace', '$address', '$number', '$email', '$password', '$certificate_number')";

    if ($conn->query($query) === TRUE) {
        // Registration successful, redirect to login page
        header('Location: ../user/user_page.php');
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <video autoplay muted loop class="video-bg">
            <source src="../media/navbar.mp4" type="video/mp4">
        </video>
        <div class="card shadow-lg highlighted-card">
            <div class="card-body">
                <h2 class="text-center mb-3">Online Birth Certificate System</h2>
                <h5 class="text-center mb-4">User Registration Form</h5>
                <form action="" method="POST"> <!-- Added POST method -->
                    <div class="row">
                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label for="birthplace">Birthplace</label>
                            <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Enter your birthplace" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group">
                            <label for="number">Mobile Number</label>
                            <input type="tel" class="form-control" id="number" name="number" placeholder="Enter your mobile number" pattern="[0-9]+" required>
                        </div>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 70%; transform: translateY(-50%); cursor: pointer; user-select: none;">👁️</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="register">Sign Up</button>
                </form>
                <div class="last text-center mt-4">
                    <p><a href="../home.php" class="back-home">Back to Home</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
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