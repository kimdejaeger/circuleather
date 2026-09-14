<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

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
    <table>
    <tr>
      <th>Id</th>
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

    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0)
      exit('No rows');

    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td> <a href='update.php?id=" . $row['id'] . "'>" . $row['id'] . "</a></td>";
      echo "<td id='gewicht'>" . $row['gewicht'] . "</td>";
      echo "<td id='kleur'>" . $row['kleur'] . "</td>";
      echo "<td id='dikte'>" . $row['dikte'] . "</td>";
      echo "<td id='soort'>" . $row['soort'] . "</td>";
      echo "<td id='gelooid'>" . $row['gelooid'] . "</td>";
      echo "<td id='prijs'>" . $row['prijs'] . "</td>";
      echo "<td id='voorraad'>" . $row['voorraad'] . "</td>";
      // echo "<td id='verwijder'>" . "<a href='delete.php?id=" . $row['id'] . "'>Verwijder</a>" . "</td>";
      echo "</tr>";
    }
    echo "</table>";

    $stmt->close();
    ?>
     <!-- <a href="logout.php" class="btn">Log out</a> -->
     <button onclick="window.location.href='logout.php'; return false;">Logout</button>

</body>
</html>
