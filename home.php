<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OBCS - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <video autoplay muted loop class="navvideo-bg">
            <source src="media/navbar.mp4" type="video/mp4">
        </video>
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="#">OBCS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="user/user_page.php">Login</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="verify_cerf/verify_cerf.php">Verify Certificate</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="admin/admin.php">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="hero-section">
        <video autoplay muted loop class="video-bg">
            <source src="media/video.mp4" type="video/mp4">
        </video>
        <div class="content text-center">
            <h2>Welcome to OBCS</h2>
            <h3>Online Birth Certificate System</h3>
            <p>Your one-stop platform for Online Birth Certificates and verifying certificates efficiently.</p>
            <a href="user/registration.php" class="btn btn-primary btn-lg">Register</a>
        </div>
    </main>

    <!-- Bootstrap JS (for toggler functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>