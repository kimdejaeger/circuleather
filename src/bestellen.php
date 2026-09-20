<?php
require_once 'session.php';
?>

<!DOCTYPE html>
<html lang="nl">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Winkelwagen</title>

    <link
        rel="stylesheet"
        href="css/style-nieuw.css"
    >

</head>

<body>

    <h1>Winkelwagen</h1>

    <div id="winkelwagen"></div>

    <h2 id="totaal">
        Totaal: €0.00
    </h2>

    <button
        type="button"
        onclick="location.href='dashboard.php'"
    >
        Verder winkelen
    </button>

    <button
        type="button"
        onclick="winkelwagenLeegmaken()"
    >
        Winkelwagen leegmaken
    </button>


    <script src="js/winkelwagen.js"></script>

    <script>

        function winkelwagenLeegmaken() {

            localStorage.removeItem("winkelwagen");

            winkelwagen = [];

            winkelwagenTonen();

        }

    </script>

</body>

</html>

