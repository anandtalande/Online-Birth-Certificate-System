<?php
session_start();

// Handle logout action
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: admin.php'); // Redirect to login page
    exit();
}


if (isset($_POST['login'])) {
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];

    // Include database connection
    require_once __DIR__ . '/../config/db_connect.php';
    $conn = getConnection();

    // Prepare and execute the query
    $query = "SELECT * FROM admins WHERE admin_name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Login successful, set session variables
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_logged_in'] = true; // Ensure admin_logged_in is set
            header('Location: admin_home.php');  // Redirect to admin dashboard
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No admin found with that name.";
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
    <title>Admin - Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <video autoplay muted loop class="video-bg">
            <source src="../media/navbar.mp4" type="video/mp4">
        </video>
        <div class="card shadow-lg highlighted-card">
            <div class="card-body">
                <h2 class="text-center mb-3">Online Birth Certificate System</h2>
                <h5 class="text-center mb-4">ADMIN LOGIN</h5>
                
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <form action="admin.php" method="POST">
                    <div class="form-group">
                        <label for="admin_name">Admin Name</label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Enter your Name" required>
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="adminPassword">Password</label>
                        <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Enter your password" required>
                        <span id="toggleAdminPassword" style="position: absolute; right: 10px; top: 42px; transform: translateY(-50%); cursor: pointer; user-select: none;">👁️</span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                </form>
                <div class="text-center mt-4">
                    <p><a href="../home.php" class="back-home">Back to Home</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const toggleAdminPassword = document.getElementById('toggleAdminPassword');
        const adminPasswordInput = document.getElementById('adminPassword');

        if (toggleAdminPassword && adminPasswordInput) {
            toggleAdminPassword.addEventListener('click', function () {
                // toggle the type attribute
                const type = adminPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                adminPasswordInput.setAttribute('type', type);
                // toggle the eye icon
                this.textContent = type === 'password' ? '👁️' : '🙈';
            });
        }
    </script>
</body>
</html>
