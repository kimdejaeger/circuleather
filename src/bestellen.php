<?php
// Controleert of de gebruiker is ingelogd
require_once 'session.php';

$conn = require_once 'partials/dbconnection-kim.php';

// Zet de winkelwagengegevens om van JSON naar een PHP-array
$producten = json_decode($_POST['producten'] ?? '', true);

// Stuurt terug naar de winkelwagen als deze leeg is of geen geldige producten bevat
if (!is_array($producten) || empty($producten)) {
    header("Location: winkelwagen.php");
    exit();
}

// Haalt het ID op van de ingelogde klant
$klant_id = $_SESSION['klant_id'];

// Bepaalt het volgende bestelnummer op basis van het laatst gebruikte nummer
$result = $conn->query("SELECT MAX(bestelnummer) AS laatste_nummer FROM bestelling");
$row = $result->fetch_assoc();

$bestelnummer = ($row['laatste_nummer'] ?? 100011) + 1;

// Iedere nieuwe bestelling begint met deze status
$status = "in behandeling";

// Maakt een query aan om de producten van de bestelling op te slaan
$stmt = $conn->prepare("
    INSERT INTO bestelling
    (klant_id, product_id, hoeveelheid, bestelnummer, status, besteldatum)
    VALUES (?, ?, ?, ?, ?, NOW())
");

// Slaat ieder product uit de winkelwagen op als een aparte regel
foreach ($producten as $product) {

    // Zet de product-ID en hoeveelheid om naar gehele getallen
    $product_id = (int) $product['id'];
    $hoeveelheid = (int) $product['aantal'];

    // Koppelt de waarden aan de vraagtekens in de query
    // i = geheel getal, s = tekst
    $stmt->bind_param(
        "iiiis",
        $klant_id,
        $product_id,
        $hoeveelheid,
        $bestelnummer,
        $status
    );

    $stmt->execute();
}

// Sluit de query en databaseverbinding
$stmt->close();
$conn->close();

// Stuurt terug naar het dashboard na het plaatsen van de bestelling
header("Location: dashboard.php?bestelling=gelukt");
exit();
?>
