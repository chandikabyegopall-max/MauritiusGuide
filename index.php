<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mauritius Travel Guide</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Mauritius Guide</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="attractions.php">Attractions</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="destinations.php">Destinations</a></li>
            <li><a href="guides.php">Guides</a></li>
            <li><a href="activities.php">Activities</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <!-- Home Section with Beach Background -->
    <header class="home-header">
        <div class="overlay">
            <h1>Welcome to Mauritius Travel Guide</h1>
            <p>
                Explore the island’s most beautiful beaches, top attractions, hotels,
                and local experiences.
            </p>
        </div>
    </header>
</body>
</html>
