<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="verify.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <video autoplay muted loop class="video-bg">
            <source src="../media/navbar.mp4" type="video/mp4"> <!-- Replace with your video -->
        </video>
        <div class="card shadow-lg highlighted-card">
            <div class="card-body">
                <h2 class="text-center mb-3">Online Birth Certificate System</h2>
                <h5 class="text-center mb-4">Verify Your Certificate</h5>
                <form action="verify_home.php" method="POST"> <!-- Submit to verify_home.php -->
                    <div class="form-group">
                        <label for="mobile">Registered Mobile Number</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
                    </div>
                    <div class="form-group">
                        <label for="certificate_number">Certificate Number</label>
                        <input type="text" class="form-control" id="certificate_number" name="certificate_number" placeholder="Enter your Certificate Number" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Verify</button>
                </form>
                <div class="last text-center mt-4">
                    <p><a href="../home.php" class="back-home">Back to Home</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (for functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
