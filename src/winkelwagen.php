<?php
// Controleert of de gebruiker is ingelogd
require_once 'session.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Winkelwagen</title>

    <link rel="stylesheet" href="css/style-nieuw.css?v=2">

</head>

<body>

    <h1>Winkelwagen</h1>

    <!-- JavaScript toont hier de producten die in de winkelwagen zitten -->
    <div id="winkelwagen"></div>

    <!-- Toont het totaalbedrag van alle producten in de winkelwagen -->
    <h2 id="totaal">
        Totaal: €0.00
    </h2>

    <!-- Stuurt de gebruiker terug naar het dashboard -->
    <button
        type="button"
        onclick="location.href='dashboard.php'"
    >
        Verder winkelen
    </button>

    <!-- Verwijdert alle producten uit de winkelwagen -->
    <button
        type="button"
        onclick="winkelwagenLeegmaken()"
    >
        Winkelwagen leegmaken
    </button>

    <!-- Verstuurt de winkelwagengegevens naar bestellen.php -->
    <form id="bestelForm" action="bestellen.php" method="POST">

        <!-- JavaScript zet de winkelwagenproducten in dit verborgen veld -->
        <input type="hidden" name="producten" id="productenInput">

        <button type="submit">Bestellen</button>

    </form>

    <!-- Laadt de JavaScript-functies voor de winkelwagen -->
    <script src="js/winkelwagen.js?v=2"></script>

    <script>
        // Leegt de winkelwagen en werkt de weergave bij
        function winkelwagenLeegmaken() {
            localStorage.removeItem("winkelwagen");

            winkelwagen = [];

            winkelwagenTonen();
        }
    </script>

</body>

</html>
