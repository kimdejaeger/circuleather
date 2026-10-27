<?php
// Controleert of de gebruiker is ingelogd en adminrechten heeft
require_once 'session.php';
require_once 'rechten.php';

alleenAdmin();

require_once 'partials/dbconnection-kim.php';

// Haalt alle verschillende soorten uit de database op voor de keuzelijst
$soorten = [];

$result = $conn->query("SELECT DISTINCT soort FROM product ORDER BY soort");

while ($row = $result->fetch_assoc()) {
    $soorten[] = $row['soort'];
}

// Controleert of het formulier is verstuurd
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Haalt de ingevulde gegevens uit het formulier op
    $naam = $_POST['naam'];
    $gewicht = $_POST['gewicht'];
    $kleur = $_POST['kleur'];
    $dikte = $_POST['dikte'];
    $soort = $_POST['soort'];
    $gelooid = $_POST['gelooid'];
    $prijs = $_POST['prijs'];
    $voorraad = $_POST['voorraad'];

    // Voegt het nieuwe product toe aan de database
    // De vraagtekens worden vervangen door de ingevulde waarden
    $sql = "INSERT INTO product
            (naam, gewicht, kleur, dikte, soort, gelooid, prijs, voorraad)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    // Koppelt de waarden aan de query
    // s = tekst, d = getal met decimalen, i = geheel getal
    $stmt->bind_param(
        "sdsdssdi",
        $naam,
        $gewicht,
        $kleur,
        $dikte,
        $soort,
        $gelooid,
        $prijs,
        $voorraad
    );

    // Slaat het product op en stuurt bij succes terug naar het dashboard
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $foutmelding = "Er ging iets mis bij het toevoegen van het product.";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product toevoegen</title>
    <link rel="stylesheet" href="css/style-nieuw.css?v=2">
</head>

<body>

<!-- Formulier met alle gegevens die nodig zijn om een product toe te voegen -->
<form method="POST" class="product-form">

    <h1>Nieuw product toevoegen</h1>

    <!-- Toont een foutmelding als het toevoegen mislukt -->
    <?php if (isset($foutmelding)): ?>
        <p><?= htmlspecialchars($foutmelding) ?></p>
    <?php endif; ?>

    <label for="naam">Naam</label>
    <input type="text" id="naam" name="naam" placeholder="Naam" required>

    <label for="gewicht">Gewicht (kg)</label>
    <input type="text" id="gewicht" name="gewicht" placeholder="0.00" inputmode="decimal" required>

    <label for="kleur">Kleur</label>
    <input type="text" id="kleur" name="kleur" placeholder="Kleur" required>

    <label for="dikte">Dikte (mm)</label>
    <input type="text" id="dikte" name="dikte" placeholder="0.00" inputmode="decimal" required>

    <label for="soort">Soort</label>
    <select id="soort" name="soort" required>
        <option value="">Kies een soort</option>

        <!-- Maakt voor elke soort uit de database een optie aan -->
        <?php foreach ($soorten as $soort): ?>
            <option value="<?= htmlspecialchars($soort) ?>">
                <?= htmlspecialchars($soort) ?>
            </option>
        <?php endforeach; ?>

    </select>

    <label for="gelooid">Gelooid</label>
    <select id="gelooid" name="gelooid" required>
        <option value="">Kies een optie</option>
        <option value="natuurlijk">Natuurlijk</option>
        <option value="chemisch">Chemisch</option>
    </select>

    <label for="prijs">Prijs</label>
    <input type="text" id="prijs" name="prijs" placeholder="0.00" inputmode="decimal" required>

    <label for="voorraad">Voorraad</label>
    <input type="text" id="voorraad" name="voorraad" placeholder="0" inputmode="numeric" pattern="[0-9]+" required>

    <button type="submit">Product toevoegen</button>

</form>

<!-- Link om terug te gaan naar het dashboard -->
<a href="dashboard.php" class="terug">Terug naar overzicht</a>

</body>
</html>
