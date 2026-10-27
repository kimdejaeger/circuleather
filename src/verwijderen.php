<?php
require_once 'session.php';
require_once 'rechten.php';

alleenAdmin();

$conn = require_once "partials/dbconnection-kim.php";

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Controleren of het product in een bestelling staat
    $sql = "SELECT id FROM bestelling WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $conn->close();
        header("Location: dashboard.php?melding=in_gebruik");
        exit;
    }

    // Product verwijderen
    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
header("Location: dashboard.php?melding=verwijderd");
exit;
?>