<?php
session_start();

// Sample guide data
$guides = [
    [
        'name' => 'Raj Tours',
        'description' => 'Professional guide offering nature hikes and cultural experiences.'
    ],
    [
        'name' => 'Marie’s Adventures',
        'description' => 'Personalized tours around beaches and local food markets.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guides - Mauritius Guide</title>
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
        <h2>Local Guides</h2>
        <div class="cards">
            <?php foreach ($guides as $guide): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($guide['name']) ?></h3>
                    <p><?= htmlspecialchars($guide['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
