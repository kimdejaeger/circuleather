<?php
require_once 'session.php';
require_once 'partials/dbconnection-kim.php';

$soorten = [];

$result = $conn->query("SELECT DISTINCT soort FROM product ORDER BY soort");

while ($row = $result->fetch_assoc()) {
    $soorten[] = $row['soort'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $naam = $_POST['naam'];
    $gewicht = $_POST['gewicht'];
    $kleur = $_POST['kleur'];
    $dikte = $_POST['dikte'];
    $soort = $_POST['soort'];
    $gelooid = $_POST['gelooid'];
    $prijs = $_POST['prijs'];
    $voorraad = $_POST['voorraad'];

    $sql = "INSERT INTO product 
            (naam, gewicht, kleur, dikte, soort, gelooid, prijs, voorraad)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sdssdssd",
        $naam,
        $gewicht,
        $kleur,
        $dikte,
        $soort,
        $gelooid,
        $prijs,
        $voorraad
    );

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

    <link rel="stylesheet" href="css/style-nieuw.css">
</head>

<body>

<form method="POST" class="product-form">

    <h1>Nieuw product toevoegen</h1>

    <?php if (isset($foutmelding)): ?>
        <p><?= htmlspecialchars($foutmelding) ?></p>
    <?php endif; ?>

    <label for="naam">Naam</label>
    <input type="text" id="naam" name="naam" required>

    <label for="gewicht">Gewicht</label>
    <input type="text" id="gewicht" name="gewicht" inputmode="decimal" required>

    <label for="kleur">Kleur</label>
    <input type="text" id="kleur" name="kleur" required>

    <label for="dikte">Dikte</label>
    <input type="text" id="dikte" name="dikte" inputmode="decimal" required>

    <label for="soort">Soort</label>
    <select id="soort" name="soort" required>
        <option value="">Kies een soort</option>

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
    <input type="text" id="prijs" name="prijs" inputmode="decimal" required>

    <label for="voorraad">Voorraad</label>
    <input type="text" id="voorraad" name="voorraad" inputmode="numeric" pattern="[0-9]+" required>

    <button type="submit">Product toevoegen</button>

</form>

<a href="dashboard.php" class="terug">Terug naar overzicht</a>

</body>
</html>