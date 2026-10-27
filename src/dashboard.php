<?php
require_once 'session.php';

$search = $_GET['search'] ?? '';
$kleur = $_GET['kleur'] ?? '';
$gelooid = $_GET['gelooid'] ?? '';
$soort = $_GET['soort'] ?? '';

$perPagina = 25;
$pagina = max(1, (int)($_GET['pagina'] ?? 1));

$conn = require_once "partials/dbconnection-kim.php";

// Kleuren ophalen
$result_kleuren = $conn->query(
    "SELECT DISTINCT kleur FROM product ORDER BY kleur"
);

// Soorten ophalen
$result_soorten = $conn->query(
    "SELECT DISTINCT soort FROM product ORDER BY soort"
);

// Filters instellen
$where = " WHERE 1=1";
$params = [];
$types = "";

if ($search !== '') {
    $where .= " AND naam LIKE ?";
    $params[] = "%$search%";
    $types .= "s";
}

if ($kleur !== '') {
    $where .= " AND kleur = ?";
    $params[] = $kleur;
    $types .= "s";
}

if ($gelooid !== '') {
    $where .= " AND gelooid = ?";
    $params[] = $gelooid;
    $types .= "s";
}

if ($soort !== '') {
    $where .= " AND soort = ?";
    $params[] = $soort;
    $types .= "s";
}

// Totaal aantal producten tellen
$sqlTotaal = "SELECT COUNT(*) AS totaal FROM product" . $where;
$stmtTotaal = $conn->prepare($sqlTotaal);

if ($params) {
    $stmtTotaal->bind_param($types, ...$params);
}

$stmtTotaal->execute();
$totaalProducten = (int)$stmtTotaal->get_result()->fetch_assoc()['totaal'];
$stmtTotaal->close();

// Pagina's berekenen
$totaalPaginas = max(1, (int)ceil($totaalProducten / $perPagina));
$pagina = min($pagina, $totaalPaginas);
$start = ($pagina - 1) * $perPagina;

// Producten ophalen
$sql = "SELECT * FROM product" . $where .
       " ORDER BY id DESC LIMIT $perPagina OFFSET $start";

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
    <link rel="stylesheet" href="css/style-nieuw.css?v=2">
</head>

<body>

    <?php if (isset($_GET['bestelling']) && $_GET['bestelling'] === 'gelukt'): ?>
        <script>
            localStorage.removeItem('winkelwagen');
        </script>
    <?php endif; ?>

    <?php if (isset($_GET['melding'])): ?>
        <?php if ($_GET['melding'] === 'in_gebruik'): ?>
            <p class="melding">Dit product staat in een bestelling en kan niet worden verwijderd.</p>
        <?php elseif ($_GET['melding'] === 'verwijderd'): ?>
            <p class="melding">Product succesvol verwijderd.</p>
        <?php endif; ?>
    <?php endif; ?>

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

                <?php if ($_SESSION['rol'] === 'bedrijf'): ?>
                    <button type="button" onclick="location.href='winkelwagen.php'">
                        🛒 Winkelwagen
                    </button>
                <?php endif; ?>

                <?php if ($_SESSION['rol'] === 'admin'): ?>
                    <button type="button" onclick="window.location.href='product_toevoegen.php'">
                        Product toevoegen
                    </button>

                    <button type="button" onclick="window.location.href='bestelling.php'">
                        Bestellingen
                    </button>
                <?php endif; ?>

                <button type="button" onclick="location.href='logout.php'">
                    Logout
                </button>

            </div>

        </div>

        <br>

        <?php include 'producten.php'; ?>

    </form>

    <script src="js/winkelwagen.js?v=2"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
