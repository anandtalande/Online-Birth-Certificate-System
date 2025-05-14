<?php
// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'obcs'); // Update with your credentials

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST['mobile'];
    $certificate_number = $_POST['certificate_number'];

    // Query to check if the mobile number and certificate number match
    $query = "SELECT * FROM users WHERE number = '$mobile' AND certificate_number = '$certificate_number'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Match found
        $success = true;
        $message = "Your certificate number is matched, verification successful.";
    } else {
        $message = "Verification failed. Please check your details.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: black;
            /* Dark background */
            animation: fadeInBody 1s ease-in-out;
            /* Fade-in effect for the body */
        }

        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the video covers the entire section */
            z-index: -1;
            /* Keeps the video in the background */
            opacity: 0.5;
            /* Semi-transparent video */
        }

        .content {
            z-index: 1;
            /* Keeps the content in front of the video */
            animation: fadeInUp 1.5s ease-in-out;
            /* Content fades in and slides up */
        }

        .highlighted-card {
            background-color: rgb(255, 255, 255);
            /* White background for the card */
            border-radius: 15px;
            /* Rounded corners for the card */
            padding: 30px;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.5);
            /* Shadow effect */
            animation: fadeInUp 0.7s ease-in-out;
            /* Card fades in and slides up */
        }

        .highlighted-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            /* Enhanced shadow on hover */
            transform: scale(1.02);
            /* Slightly enlarges the card on hover */
        }

        .card h2 {
            font-size: 1.8rem;
            /* Larger font size for the main heading */
            color: black;
            /* Darker color for the heading */
            animation: fadeIn 0.7s ease-in-out;
            /* Heading fades in smoothly */
        }

        .text-success {
            color: green;
            /* Success message color */
        }

        .text-danger {
            color: red;
            /* Error message color */
        }

        /* Keyframe animations */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInBody {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <video autoplay muted loop class="video-bg">
            <source src="../media/navbar.mp4" type="video/mp4">
        </video>
        <div class="card shadow-lg highlighted-card">
            <div class="card-body text-center">
                <h2 class="mb-3">Verification Result</h2>
                <?php if ($success): ?>
                    <div class="text-success">
                        <h3>&#10003; <?php echo $message; ?></h3> <!-- Green checkmark -->
                    </div>
                <?php else: ?>
                    <div class="text-danger">
                        <h3>&#10008; <?php echo $message; ?></h3> <!-- Red cross -->
                    </div>
                <?php endif; ?>
                <div class="mt-4">
                    <a href="verify_cerf.php" class="btn btn-primary">Verify Again</a>
                    <a href="../home.php" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>