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
<html lang="en">

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

            <button type="button" onclick="location.href='bestellen.php'">
                Bestellen
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

    <div class="dashboard">

        <div class="voorraad">

            <table>

                <tr>
                    <th>Id</th>
                    <th>Naam</th>
                    <th>Gewicht</th>
                    <th>Kleur</th>
                    <th>Dikte</th>
                    <th>Soort</th>
                    <th>Gelooid</th>
                    <th>Prijs</th>
                    <th>Voorraad</th>
                </tr>

                <?php if ($result->num_rows === 0): ?>

                    <tr>
                        <td colspan="9">Geen producten gevonden.</td>
                    </tr>

                <?php else: ?>

                    <?php while ($row = $result->fetch_assoc()): ?>

                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['naam']) ?></td>
                            <td><?= htmlspecialchars($row['gewicht']) ?></td>
                            <td><?= htmlspecialchars($row['kleur']) ?></td>
                            <td><?= htmlspecialchars($row['dikte']) ?></td>
                            <td><?= htmlspecialchars($row['soort']) ?></td>
                            <td><?= htmlspecialchars($row['gelooid']) ?></td>
                            <td><?= htmlspecialchars($row['prijs']) ?></td>
                            <td><?= htmlspecialchars($row['voorraad']) ?></td>
                        </tr>

                    <?php endwhile; ?>

                <?php endif; ?>

            </table>

        </div>

        <div class="sidebar">

            <div class="voorraad-box">

                <h2>Voorraad</h2>

                <p>🟢 Op voorraad</p>
                <p>🔴 Niet op voorraad</p>

            </div>

            <div class="filters">

                <select name="kleur">

                    <option value="">Alle kleuren</option>

                    <?php while ($row = $result_kleuren->fetch_assoc()): ?>

                        <option
                            value="<?= htmlspecialchars($row['kleur']) ?>"
                            <?= $kleur === $row['kleur'] ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($row['kleur']) ?>
                        </option>

                    <?php endwhile; ?>

                </select>

                <select name="gelooid">

                    <option value="">Gelooid</option>

                    <option
                        value="natuurlijk"
                        <?= $gelooid === 'natuurlijk' ? 'selected' : '' ?>
                    >
                        Natuurlijk
                    </option>

                    <option
                        value="chemisch"
                        <?= $gelooid === 'chemisch' ? 'selected' : '' ?>
                    >
                        Chemisch
                    </option>

                </select>

                <select name="soort">

                    <option value="">Alle soorten</option>

                    <?php while ($row = $result_soorten->fetch_assoc()): ?>

                        <option
                            value="<?= htmlspecialchars($row['soort']) ?>"
                            <?= $soort === $row['soort'] ? 'selected' : '' ?>
                        >
                            <?= htmlspecialchars($row['soort']) ?>
                        </option>

                    <?php endwhile; ?>

                </select>

                <button type="submit">
                    Filteren
                </button>

                <button
                    type="button"
                    onclick="location.href='dashboard.php'"
                >
                    Reset
                </button>

            </div>

        </div>

    </div>

</form>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>