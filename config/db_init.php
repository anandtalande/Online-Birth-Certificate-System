<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';

// Create connection without database
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create OBCS database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS obcs";
if ($conn->query($sql) === TRUE) {
    // echo "OBCS database created successfully\n";
} else {
    // echo "Error creating OBCS database: " . $conn->error . "\n";
}

// Create user_system database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS user_system";
if ($conn->query($sql) === TRUE) {
    // echo "User system database created successfully\n";
} else {
    // echo "Error creating user system database: " . $conn->error . "\n";
}

// Connect to OBCS database
$conn->select_db('obcs');

// Create users table in OBCS database
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birthplace VARCHAR(100),
    certificate_number VARCHAR(50),
    number VARCHAR(15) UNIQUE NOT NULL,
    date_of_birth DATE,
    address TEXT,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255) NOT NULL, -- Added password column
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    // echo "Users table created successfully in OBCS database\n";
} else {
    // echo "Error creating users table in OBCS database: " . $conn->error . "\n";
}

// Connect to user_system database
$conn->select_db('user_system');

// Create users table in user_system database
$sql_user_system = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_user_system) === TRUE) {
    // echo "Users table created successfully in user_system database\n";
} else {
    // echo "Error creating users table: " . $conn->error . "\n";
}

// Connect to OBCS database before creating admins table
$conn->select_db('obcs');

// Create admins table in OBCS database
$sql = "CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_name VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    // echo "Admins table created successfully in OBCS database\n";
} else {
    // echo "Error creating admins table: " . $conn->error . "\n";
}

// Connect to user_system database
$conn->select_db('user_system');

// Create users table in user_system database
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    // echo "Users table created successfully in user_system database\n";
} else {
    // echo "Error creating users table: " . $conn->error . "\n";
}

$conn->close();

// echo "Database initialization completed successfully!\n";
?>