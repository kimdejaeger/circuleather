<?php
require_once 'session.php';

$search = $_GET['search'] ?? '';
$kleur = $_GET['kleur'] ?? '';
$gelooid = $_GET['gelooid'] ?? '';
$soort = $_GET['soort'] ?? '';

$conn = require_once "partials/dbconnection-kim.php";

// Kleuren ophalen
$result_kleuren = $conn->query(
    "SELECT DISTINCT kleur FROM product ORDER BY kleur"
);

// Soorten ophalen
$result_soorten = $conn->query(
    "SELECT DISTINCT soort FROM product ORDER BY soort"
);

// Producten ophalen
$sql = "SELECT * FROM product WHERE 1=1";
$params = [];
$types = "";

if ($search !== '') {
    $sql .= " AND naam LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}

if ($kleur !== '') {
    $sql .= " AND kleur = ?";
    $params[] = $kleur;
    $types .= "s";
}

if ($gelooid !== '') {
    $sql .= " AND gelooid = ?";
    $params[] = $gelooid;
    $types .= "s";
}

if ($soort !== '') {
    $sql .= " AND soort = ?";
    $params[] = $soort;
    $types .= "s";
}

$stmt = $conn->prepare($sql);

if ($params) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style-nieuw.css">
</head>

<body>

<form method="GET">

    <div class="top-bar">

        <div class="search">

            <input
                type="text"
                name="search"
                placeholder="Zoek product..."
                value="<?= htmlspecialchars($search) ?>"
            >

            <button type="submit">Zoeken</button>

        </div>

        <div class="buttons">

            <button type="button" onclick="location.href='winkelwagen.php'">
    🛒 Winkelwagen
</button>

            <button type="button" onclick="location.href='product_toevoegen.php'">
                Product toevoegen
            </button>

            <button type="button" onclick="location.href='logout.php'">
                Logout
            </button>

        </div>

    </div>

    <br>

    <?php include 'producten.php'; ?>

</form>
<script src="js/winkelwagen.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>