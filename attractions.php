<?php
session_start();
include 'includes/db_connect.php';
?>
<?php
session_start();
$attractions = [
    [
        'title' => 'Black River Gorges',
        'image' => '..\MauritiusGuide-main\black-river-gorges-national.jpg',
        'alt' => 'Black River Gorges',
        'description' => 'Explore lush greenery and wildlife.'
    ],
    [
        'title' => 'Le Morne Brabant',
        'image' => '..\MauritiusGuide-main\le-morne-brabant-(1).jpg',
        'alt' => 'Le Morne Brabant',
        'description' => 'A UNESCO site offering breathtaking panoramic views.'
    ],
    [
        'title' => 'Seven Colored Earths',
        'image' => '..\MauritiusGuide-main\chamarel-mauritius (2).jpg',
        'alt' => 'Seven Colored Earths',
        'description' => 'Unique dunes of seven distinct colors — a true natural wonder.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Attractions - Mauritius Guide</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <section class="section">
        <h2>Top Attractions</h2>
        <div class="cards">
            <?php foreach ($attractions as $attraction): ?>
                <div class="card">
                    <img src="<?= $attraction['image'] ?>" alt="<?= $attraction['alt'] ?>" />
                    <h3><?= $attraction['title'] ?></h3>
                    <p><?= $attraction['description'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
