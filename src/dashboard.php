<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

$search = $_GET['search'] ?? '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="css/style-kim.css">

</head>
<body>

    <!-- Search -->
    <form method="GET" action="">
        <input 
            type="text" 
            name="search" 
            placeholder="Zoek product..."
            value="<?= htmlspecialchars($search) ?>"
        >
        <button type="submit">Zoeken</button>
    </form>

    <br>

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

<?php

    $conn = require_once "partials/dbconnection-kim.php";

    // Search op naam
    if ($search !== '') {

        $searchTerm = "%" . $search . "%";

        $stmt = $conn->prepare("
            SELECT * FROM product
            WHERE naam LIKE ?
        ");

        $stmt->bind_param("s", $searchTerm);

    } else {

        $stmt = $conn->prepare("SELECT * FROM product");

    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {

        echo "<tr>";
        echo "<td colspan='9'>Geen producten gevonden.</td>";
        echo "</tr>";

    } else {

        while ($row = $result->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['naam'] . "</td>";
            echo "<td id='gewicht'>" . $row['gewicht'] . "</td>";
            echo "<td id='kleur'>" . $row['kleur'] . "</td>";
            echo "<td id='dikte'>" . $row['dikte'] . "</td>";
            echo "<td id='soort'>" . $row['soort'] . "</td>";
            echo "<td id='gelooid'>" . $row['gelooid'] . "</td>";
            echo "<td id='prijs'>" . $row['prijs'] . "</td>";
            echo "<td id='voorraad'>" . $row['voorraad'] . "</td>";
            echo "</tr>";

        }

    }

    echo "</table>";

    $stmt->close();
    $conn->close();

?>

     <button onclick="window.location.href='logout.php'; return false;">
        Logout
     </button>

</body>
</html>
