<?php
 $config = require __DIR__ . '/../config/database.php';


// Create a new MySQLi instance with error reporting enabled
$connection = new mysqli(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

// Check for a connection error
if ($connection->connect_errno) {
    // Log or display a descriptive error message in production applications
    die("Database connection failed: " . htmlspecialchars($connection->connect_error));
}

// Set the character set to UTF-8 for proper encoding
$connection->set_charset('utf8mb4');