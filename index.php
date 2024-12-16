<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load database configuration from an external file
$config = include('config.php');

// Database connection details
$host = $config['host'];
$username = $config['username'];
$password = $config['password'];
$database = $config['database'];

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debug: Test if connection details are correct
echo "Connected successfully to the database.<br>";

// Fetch the current time from the database
$query = "SELECT CURRENT_TIMESTAMP";
$result = $conn->query($query);

// Debug: Check if query execution fails
if (!$result) {
    die("Query error: " . $conn->error);
}

$row = $result->fetch_assoc();
$currentTime = $row['CURRENT_TIMESTAMP'];

// Close the connection
$conn->close();

// Get the visitor's IP address
$visitorIP = $_SERVER['REMOTE_ADDR'];

// Display the information
echo "<h1>Welcome to My Website</h1>";
echo "<p>Your IP address: <strong>$visitorIP</strong></p>";
echo "<p>Current time: <strong>$currentTime</strong></p>";
?>