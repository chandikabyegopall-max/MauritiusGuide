<?php
session_start();

// Apply XSL transformation to XML
$xml = new DOMDocument;
$xml->load('hotels.xml');   // your XML file

$xsl = new DOMDocument;
$xsl->load('hotels.xsl');   // your XSL file

$proc = new XSLTProcessor;
$proc->importStylesheet($xsl);

$transformedHtml = $proc->transformToXML($xml);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hotels - Mauritius Guide</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .hidden { display: none; }
    #availabilityScreen {
      padding: 20px;
      background: #f9f9f9;
    }
    #availabilityScreen table {
      width: 100%;
      border-collapse: collapse;
    }
    #availabilityScreen th, #availabilityScreen td {
      border: 1px solid #ccc;
      padding: 8px;
    }
  </style>
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

  <!-- Dark Mode Toggle -->
  <div class="mode-toggle">
    <span id="mode-text">Switch to Dark Mode</span>
    <img id="mode-switch" src="darkmode.png" alt="Toggle Mode">
  </div>

  <!-- Hotel List (from XML+XSL) -->
  <section class="section" id="hotelList">
    <h2>Top Hotels</h2>
    <?php echo $transformedHtml; ?>
  </section>

  <!-- Availability Screen -->
  <section id="availabilityScreen" class="hidden">
    <h2 id="hotelTitle"></h2>
    <p id="hotelDescription"></p>
    <div id="availabilityTable"></div>
    <button onclick="goBack()">← Back to Hotels</button>
  </section>

  <!-- Wishlist Sidebar -->
  <div id="wishlistToggle" class="wishlist-toggle" title="Open Wishlist">💙 Wishlist</div>
  <aside id="wishlistSidebar" class="wishlist-sidebar hidden" aria-hidden="true">
    <header class="wishlist-header">
      <h3>Your Wishlist</h3>
      <button id="closeWishlist" class="close-wishlist" aria-label="Close wishlist">Close</button>
    </header>
    <ul id="wishlistItems"></ul>
    <div id="wishlistEmpty" class="wishlist-empty">Your wishlist is empty.</div>
  </aside>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="wishlist.js"></script>
  <script src="app-wishlist.js"></script>
  <script src="darkmode.js"></script>

  <script>
  // Show clicked hotel card in availability screen
  function showAvailability(cardHtml) {
      document.getElementById("hotelList").style.display = "none";
      document.getElementById("availabilityScreen").innerHTML = cardHtml + 
          '<button onclick="goBack()">← Back to Hotels</button>';
      document.getElementById("availabilityScreen").classList.remove("hidden");
  }

  function goBack() {
      document.getElementById("hotelList").style.display = "block";
      document.getElementById("availabilityScreen").classList.add("hidden");
  }

  // Attach click handler to each card
  document.addEventListener("DOMContentLoaded", function() {
      document.querySelectorAll(".card").forEach(function(card) {
          card.addEventListener("click", function() {
              showAvailability(card.outerHTML);
          });
      });
  });
  </script>
</body>
</html>

