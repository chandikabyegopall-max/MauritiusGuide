<?php
session_start();
include 'includes/db_connect.php';
?>
<?php
// Database configuration
$host = 'localhost';         // or your server name
$dbname = 'mauritius_guide'; // your database name
$username = 'root';          // your database username
$password = '';              // your database password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
