<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin.php'); // Redirect to login page if not logged in
    exit();
}

// Include database connection
require_once __DIR__ . '/../config/db_connect.php';
$conn = getConnection();

// Fetch user details
$query = "SELECT * FROM users";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">User Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Birthplace</th>
                    <th>Address</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Certificate Number</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['date_of_birth']}</td>
                            <td>{$row['birthplace']}</td>
                            <td>{$row['address']}</td>
                            <td>{$row['number']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['certificate_number']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="admin.php?action=logout" class="btn btn-danger">Logout</a>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>