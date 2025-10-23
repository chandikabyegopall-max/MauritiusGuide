<?php
session_start();
include 'includes/db_connect.php';
?>
<?php
session_start();
$activities = [
    [
        'title' => 'Snorkeling',
        'image' => '\MauritiusGuide-main\scuba-diving.jpg',
        'alt' => 'Snorkeling',
        'description' => 'Discover vibrant coral reefs and marine life in turquoise waters.'
    ],
    [
        'title' => 'Hiking',
        'image' => '\MauritiusGuide-main\hiking.jpeg',
        'alt' => 'Hiking',
        'description' => 'Enjoy trails through forests and mountain peaks.'
    ],
    [
        'title' => 'Cultural Tour',
        'image' => '\MauritiusGuide-main\culture.jpg',
        'alt' => 'Cultural Tour',
        'description' => 'Immerse yourself in the local art, music, and cuisine.'
    ],
    [
        'title' => 'Catamaran Tours',
        'image' => '\MauritiusGuide-main\catamaran.jpg/images/catamaran.jpg',
        'alt' => 'Catamaran Tours',
        'description' => 'Relax on boat cruises and island-hopping adventures.'
    ]
];
?>
<div class="cards">
  <?php foreach ($activities as $activity): ?>
    <div class="card">
      <img src="<?= $activity['image'] ?>" alt="<?= $activity['alt'] ?>" />
      <h3><?= $activity['title'] ?></h3>
      <p><?= $activity['description'] ?></p>
    </div>
  <?php endforeach; ?>
</div>
