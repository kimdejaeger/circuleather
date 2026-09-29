<?php
require_once 'session.php';
require_once 'partials/dbconnection-kim.php';

$sql = "
    SELECT
        bestelling.id,
        klant_id,
        product_id,
        hoeveelheid,
        bestelnummer,
        status,
        besteldatum,
        product.naam
    FROM bestelling
    LEFT JOIN product ON bestelling.product_id = product.id
    ORDER BY besteldatum ASC
";

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
        <h1>Bestellingen</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Klant ID</th>
                    <th>Product</th>
                    <th>Product ID</th>
                    <th>Hoeveelheid</th>
                    <th>Bestelnummer</th>
                    <th>Status</th>
                    <th>Besteldatum</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= (int)$row['id'] ?></td>
                        <td><?= (int)$row['klant_id'] ?></td>
                        <td><?= htmlspecialchars($row['naam'] ?? 'Onbekend') ?></td>
                        <td><?= (int)$row['product_id'] ?></td>
                        <td><?= (int)$row['hoeveelheid'] ?></td>
                        <td><?= htmlspecialchars($row['bestelnummer']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['besteldatum']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <br>

        <a href="dashboard.php" class="terug">Terug naar voorraad</a>
    </div>
</body>
</html>