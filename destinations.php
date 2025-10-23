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
        <li>
            <?php 
            if (isset($_SESSION['user_id'])) {
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login-register.php">Login/Register</a>';
            }
            ?>
        </li>
    </ul>
</nav>
 <?php
session_start();
include 'includes/db_connect.php';
?>
<?php
session_start();
$destinations = [
    [
        'title' => 'Grand Baie',
        'image' => '..\MauritiusGuide-main\Grand-baie(3).jpg',
        'alt' => 'Grand Baie',
        'description' => 'Vibrant coastal town with beaches, nightlife, and shopping.'
    ],
    [
        'title' => 'Flic en Flac',
        'image' => '..\MauritiusGuide-main\sunset-at-flic-en-flac.jpg',
        'alt' => 'Flic en Flac',
        'description' => 'Long sandy beaches and great spots for snorkeling.'
    ],
    [
        'title' => 'Port Louis',
        'image' => "..\MauritiusGuide-main\portlouis(2).jpg',
        'alt' => 'Port Louis',
        'description' => 'The capital city, rich with history, culture, and street food.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Destinations - Mauritius Guide</title>
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

    <section class="section">
        <h2>Popular Destinations</h2>
        <div class="cards">
            <?php foreach ($destinations as $place): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($place['image']) ?>" alt="<?= htmlspecialchars($place['alt']) ?>" />
                    <h3><?= htmlspecialchars($place['title']) ?></h3>
                    <p><?= htmlspecialchars($place['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
