<?php
// Controleert of de gebruiker is ingelogd
require_once 'session.php';
require_once 'partials/dbconnection-kim.php';

// Haalt alle bestellingen op, inclusief de bedrijfsnaam en productnaam
$sql = "
    SELECT
        bestelling.id,
        klant.bedrijfsnaam AS bedrijfsnaam,
        product.naam AS productnaam,
        bestelling.product_id,
        bestelling.hoeveelheid,
        bestelling.bestelnummer,
        bestelling.status,
        bestelling.besteldatum
    FROM bestelling
    LEFT JOIN klant ON bestelling.klant_id = klant.id
    LEFT JOIN product ON bestelling.product_id = product.id
    ORDER BY bestelling.besteldatum ASC
";

// Voert de query uit om de bestellingen op te halen
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen</title>
    <link rel="stylesheet" href="css/style-nieuw.css?v=3">
</head>

<body>

    <div class="container">

        <!-- Paginatitel en link om terug te gaan naar de voorraad -->
        <div class="pagina-bovenkant">
            <h1>Bestellingen</h1>
            <a href="dashboard.php" class="terug">Terug naar voorraad</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bedrijf</th>
                    <th>Product</th>
                    <th>Product ID</th>
                    <th>Hoeveelheid</th>
                    <th>Bestelnummer</th>
                    <th>Status</th>
                    <th>Besteldatum</th>
                </tr>
            </thead>

            <tbody>

                <!-- Toont elke bestelling als een aparte rij in de tabel -->
                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td><?= (int)$row['id'] ?></td>
                        <td><?= htmlspecialchars($row['bedrijfsnaam'] ?? 'Onbekend') ?></td>
                        <td><?= htmlspecialchars($row['productnaam'] ?? 'Onbekend') ?></td>
                        <td><?= (int)$row['product_id'] ?></td>
                        <td><?= (int)$row['hoeveelheid'] ?></td>
                        <td><?= htmlspecialchars($row['bestelnummer']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['besteldatum']) ?></td>
                    </tr>

                <?php endwhile; ?>

            </tbody>
        </table>

    </div>

</body>

</html>
