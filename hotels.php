<?php
session_start();

// Sample hotel data
$hotels = [
    [
        'name' => 'Lux Belle Mare',
        'image' => 'images/Lux-bellemare.jpg',
        'alt' => 'Lux Belle Mare',
        'description' => 'Luxury beach resort with world-class dining and ocean views.'
    ],
    [
        'name' => 'One&Only Le Saint Géran',
        'image' => 'images/Saint-geran.jpg',
        'alt' => 'One&Only Le Saint Géran',
        'description' => 'An iconic 5-star resort offering private beaches and fine hospitality.'
    ],
    [
        'name' => 'The Westin Turtle Bay',
        'image' => 'images/westin-turtle.jpg',
        'alt' => 'The Westin Turtle Bay',
        'description' => 'Elegant rooms, spa treatments, and views of Turtle Bay.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotels - Mauritius Guide</title>
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
        <h2>Top Hotels</h2>
        <div class="cards">
            <?php foreach ($hotels as $hotel): ?>
                <div class="card">
                    <img src="<?= htmlspecialchars($hotel['image']) ?>" alt="<?= htmlspecialchars($hotel['alt']) ?>" />
                    <h3><?= htmlspecialchars($hotel['name']) ?></h3>
                    <p><?= htmlspecialchars($hotel['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
