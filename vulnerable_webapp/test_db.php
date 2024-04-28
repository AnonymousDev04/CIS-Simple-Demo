<?php

$databaseHost = 'localhost';
$databaseName = 'crud_with_login';
$databaseUsername = 'root';
$databasePassword = 'Admin@12s345'; // Replace 'your_password' with your actual database password

// Attempt to connect to MySQL
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Check connection
if (!$mysqli) {
    // Connection failed
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Connection successful
    echo "Connected successfully";
}

// Close the connection
mysqli_close($mysqli);
?>
