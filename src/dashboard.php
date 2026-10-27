<?php
require_once 'session.php';

// Haalt de zoekterm en filters uit de URL op
$search = $_GET['search'] ?? '';
$kleur = $_GET['kleur'] ?? '';
$gelooid = $_GET['gelooid'] ?? '';
$soort = $_GET['soort'] ?? '';

// Paginering: maximaal 25 producten per pagina
$perPagina = 25;
$pagina = max(1, (int)($_GET['pagina'] ?? 1));

$conn = require_once "partials/dbconnection-kim.php";

// Haalt de beschikbare kleuren en soorten op voor de filters
$result_kleuren = $conn->query(
    "SELECT DISTINCT kleur FROM product ORDER BY kleur"
);

$result_soorten = $conn->query(
    "SELECT DISTINCT soort FROM product ORDER BY soort"
);

// Bouwt de SQL-filters op. 1=1 maakt het makkelijker om AND toe te voegen.
$where = " WHERE 1=1";
$params = [];
$types = "";

// Voegt alleen filters toe als de gebruiker ze heeft ingevuld
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

// Telt hoeveel producten aan de zoekterm en filters voldoen
$sqlTotaal = "SELECT COUNT(*) AS totaal FROM product" . $where;
$stmtTotaal = $conn->prepare($sqlTotaal);

if ($params) {
    // Koppelt de filterwaarden aan de SQL-query
    // $types geeft de datatypes aan; s betekent tekst
    // ...$params geeft alle waarden afzonderlijk door
    $stmtTotaal->bind_param($types, ...$params);
}

$stmtTotaal->execute();
$totaalProducten = (int)$stmtTotaal->get_result()->fetch_assoc()['totaal'];
$stmtTotaal->close();

// Berekent het aantal pagina's en voorkomt een ongeldig paginanummer
$totaalPaginas = max(1, (int)ceil($totaalProducten / $perPagina));
$pagina = min($pagina, $totaalPaginas);

// Berekent hoeveel producten moeten worden overgeslagen
// Pagina 1 = 0, pagina 2 = 25, pagina 3 = 50
$start = ($pagina - 1) * $perPagina;

// Haalt alleen de producten voor de huidige pagina op
// DESC toont de hoogste ID's eerst; LIMIT en OFFSET regelen de paginering
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

    <?php
    // Leegt de winkelwagen na een succesvolle bestelling
    ?>
    <?php if (isset($_GET['bestelling']) && $_GET['bestelling'] === 'gelukt'): ?>
        <script>
            localStorage.removeItem('winkelwagen');
        </script>
    <?php endif; ?>

    <!-- GET verstuurt de zoekterm en filters via de URL -->
    <form method="GET">
        <div class="top-bar">
            <div class="search">
                <!-- De ingevulde zoekterm blijft in het invoerveld staan -->
                <input
                    type="text"
                    name="search"
                    placeholder="Zoek product..."
                    value="<?= htmlspecialchars($search) ?>"
                >
                <button type="submit">Zoeken</button>
            </div>

            <div class="buttons">
                <!-- Alleen bedrijven zien de winkelwagenknop -->
                <?php if ($_SESSION['rol'] === 'bedrijf'): ?>
                    <button type="button" onclick="location.href='winkelwagen.php'">
                        🛒 Winkelwagen
                    </button>
                <?php endif; ?>

                <!-- Alleen admins zien de beheerknoppen -->
                <?php if ($_SESSION['rol'] === 'admin'): ?>
                    <!-- Opent het formulier om een product toe te voegen -->
                    <button type="button" onclick="window.location.href='product_toevoegen.php'">
                        Product toevoegen
                    </button>

                    <!-- Opent het overzicht van bestellingen -->
                    <button type="button" onclick="window.location.href='bestelling.php'">
                        Bestellingen
                    </button>
                <?php endif; ?>

                <!-- Logt de gebruiker uit -->
                <button type="button" onclick="location.href='logout.php'">
                    Logout
                </button>
            </div>
        </div>

        <br>

        <!-- Laadt de productentabel, filters en paginering -->
        <?php include 'producten.php'; ?>
    </form>

    <!-- Laadt JavaScript voor de winkelwagen -->
    <script src="js/winkelwagen.js?v=2"></script>

</body>
</html>

<?php
// Sluit de databasequery en de verbinding af
$stmt->close();
$conn->close();
?>
