<?php
require_once 'session.php';

$conn = require_once 'partials/dbconnection-kim.php';

$producten = json_decode($_POST['producten'], true);

if (empty($producten)) {
    header("Location: winkelwagen.php");
    exit();
}

$klant_id = $_SESSION['klant_id'];

$result = $conn->query("SELECT MAX(bestelnummer) AS laatste_nummer FROM bestelling");
$row = $result->fetch_assoc();

$bestelnummer = ($row['laatste_nummer'] ?? 100011) + 1;

$status = "in behandeling";

$stmt = $conn->prepare("
    INSERT INTO bestelling
    (klant_id, product_id, hoeveelheid, bestelnummer, status, besteldatum)
    VALUES (?, ?, ?, ?, ?, NOW())
");

foreach ($producten as $product) {

    $product_id = (int) $product['id'];
    $hoeveelheid = (int) $product['aantal'];

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

$stmt->close();
$conn->close();

header("Location: dashboard.php?bestelling=gelukt");
exit();
?>