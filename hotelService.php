<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$xmlFile = "hotels.xml";
$xml = simplexml_load_file($xmlFile);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $hotelName = $_POST["hotel"];
    $roomId = $_POST["room"];

    // BOOK ROOM
    if ($_POST["action"] === "book") {
        foreach ($xml->hotel as $hotel) {
            $name = trim((string)$hotel->name);
            if (strtolower($name) === strtolower($hotelName)) {
                foreach ($hotel->rooms->room as $room) {
                    if ((string)$room["id"] === $roomId && (string)$room["status"] === "Available") {
                        $room["status"] = "Booked";
                        $xml->asXML($xmlFile);

                        // Redirect immediately after updating
                        if (!empty($_POST["redirect"])) {
                            header("Location: " . $_POST["redirect"]);
                            exit;
                        }

                        echo "Room booked successfully";
                        exit;
                    }
                }
            }
        }
    }

    // RESET ROOM
    elseif ($_POST["action"] === "reset") {
        foreach ($xml->hotel as $hotel) {
            $name = trim((string)$hotel->name);
            if (strtolower($name) === strtolower($hotelName)) {
                foreach ($hotel->rooms->room as $room) {
                    if ((string)$room["id"] === $roomId && (string)$room["status"] === "Booked") {
                        $room["status"] = "Available";
                        $xml->asXML($xmlFile);

                        echo "Room reset successfully";
                        exit;
                    }
                }
            }
        }
    }
}

// Default: return XML
header("Content-Type: text/xml");
echo $xml->asXML();
?>
