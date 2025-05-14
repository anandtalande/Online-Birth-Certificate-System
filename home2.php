<?php
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['number'])) { // Check for mobile number session
    header('Location: ../user/user_page.php'); // Redirect to login if not logged in
    exit();
}

// Include database connection
require_once __DIR__ . '/config/db_connect.php';
$conn = getConnection();

// Fetch user details using the mobile number stored in session
$number = $_SESSION['number'];

// Use prepared statements to prevent SQL injection
$query = "SELECT first_name, last_name, birthplace, certificate_number FROM users WHERE number=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $number);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $birthplace = $row['birthplace'];
    $certificate_number = $row['certificate_number'];
} else {
    // echo "Error fetching user data.";
}

// Close statement if it was used
if (isset($stmt)) {
    $stmt->close();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy(); // Destroy all session data
    header('Location: ../user/user_page.php'); // Redirect to login page
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

        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 1;
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
    <video autoplay muted loop class="video-bg">
        <source src="media/navbar.mp4" type="video/mp4">
    </video>
    <div class="container">
        <h2>Welcome to the Home Page!</h2>
        <p>You are logged in as: <strong><?php echo $_SESSION['number']; ?></strong></p>

        <!-- Display user details -->
        <p><strong>Name:</strong> <?php echo $first_name . ' ' . $last_name; ?></p>
        <p><strong>Birthplace:</strong> <?php echo $birthplace; ?></p>
        <p><strong>Certificate Number:</strong> <?php echo $certificate_number; ?></p>

        <form method="get" action="home.php">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>

</html>
