<?php
require_once 'session.php';
require_once 'rechten.php';

// Controleert of de gebruiker adminrechten heeft
alleenAdmin();

require_once 'partials/dbconnection-kim.php';

// Stuurt de gebruiker terug naar het dashboard als er geen product-ID is
if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

// Zet de ID om naar een geheel getal
$id = (int) $_GET['id'];

/* Haalt het product op dat bewerkt moet worden */
$stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Stopt als het product niet bestaat
if (!$product) {
    echo "Product niet gevonden.";
    exit;
}

/* Haalt alle verschillende soorten uit de database op */
$soorten = [];

$result_soorten = $conn->query(
    "SELECT DISTINCT soort FROM product ORDER BY soort"
);

while ($row = $result_soorten->fetch_assoc()) {
    $soorten[] = $row['soort'];
}

/* Verwerkt het formulier wanneer de gebruiker op Opslaan klikt */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Haalt de nieuwe gegevens uit het formulier op
    $naam = $_POST['naam'];
    $gewicht = $_POST['gewicht'];
    $kleur = $_POST['kleur'];
    $dikte = $_POST['dikte'];
    $soort = $_POST['soort'];
    $gelooid = $_POST['gelooid'];
    $prijs = $_POST['prijs'];
    $voorraad = $_POST['voorraad'];

    // Werkt de gegevens van het gekozen product bij
    $stmt = $conn->prepare("
        UPDATE product
        SET naam = ?, gewicht = ?, kleur = ?, dikte = ?, soort = ?,
            gelooid = ?, prijs = ?, voorraad = ?
        WHERE id = ?
    ");

    // Koppelt de ingevulde waarden aan de vraagtekens
    // s = tekst, d = getal met decimalen, i = geheel getal
    $stmt->bind_param(
        "sdsdssddi",
        $naam,
        $gewicht,
        $kleur,
        $dikte,
        $soort,
        $gelooid,
        $prijs,
        $voorraad,
        $id
    );

    $stmt->execute();

    // Stuurt terug naar het dashboard nadat het product is bijgewerkt
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product bewerken</title>
    <link rel="stylesheet" href="css/style-nieuw.css?v=3">
</head>

<body>

    <div class="product-form">

        <h1>Product bewerken</h1>

        <!-- Formulier met de huidige gegevens van het product -->
        <form method="POST">

            <label for="naam">Naam:</label>
            <input
                type="text"
                id="naam"
                name="naam"
                value="<?= htmlspecialchars($product['naam']) ?>"
                required
            >

            <label for="gewicht">Gewicht (kg):</label>
            <input
                type="number"
                id="gewicht"
                name="gewicht"
                step="0.01"
                value="<?= htmlspecialchars($product['gewicht']) ?>"
                required
            >

            <label for="kleur">Kleur:</label>
            <input
                type="text"
                id="kleur"
                name="kleur"
                value="<?= htmlspecialchars($product['kleur']) ?>"
                required
            >

            <label for="dikte">Dikte (mm):</label>
            <input
                type="number"
                id="dikte"
                name="dikte"
                step="0.1"
                value="<?= htmlspecialchars($product['dikte']) ?>"
                required
            >

            <label for="soort">Soort:</label>
            <select id="soort" name="soort" required>

                <!-- Selecteert automatisch de huidige soort van het product -->
                <?php foreach ($soorten as $soort): ?>
                    <option
                        value="<?= htmlspecialchars($soort) ?>"
                        <?= $product['soort'] === $soort ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($soort) ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <label for="gelooid">Gelooid:</label>
            <select id="gelooid" name="gelooid" required>

                <!-- Selecteert automatisch de huidige looimethode -->
                <option
                    value="natuurlijk"
                    <?= $product['gelooid'] === 'natuurlijk' ? 'selected' : '' ?>
                >
                    Natuurlijk
                </option>

                <option
                    value="chemisch"
                    <?= $product['gelooid'] === 'chemisch' ? 'selected' : '' ?>
                >
                    Chemisch
                </option>

            </select>

            <label for="prijs">Prijs:</label>
            <input
                type="number"
                id="prijs"
                name="prijs"
                step="0.01"
                value="<?= htmlspecialchars($product['prijs']) ?>"
                required
            >

            <label for="voorraad">Voorraad:</label>
            <input
                type="number"
                id="voorraad"
                name="voorraad"
                min="0"
                step="1"
                value="<?= htmlspecialchars($product['voorraad']) ?>"
                required
            >

            <button type="submit">Opslaan</button>

        </form>

        <!-- Gaat terug naar het dashboard zonder de wijzigingen op te slaan -->
        <a href="dashboard.php" class="terug">
            Annuleren
        </a>

    </div>

</body>

</html>
