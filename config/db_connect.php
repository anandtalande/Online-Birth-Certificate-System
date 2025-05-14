<?php
// Include database initialization script
require_once __DIR__ . '/db_init.php';

// Function to get database connection
function getConnection($database = 'obcs') {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    
    // Create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}
?>