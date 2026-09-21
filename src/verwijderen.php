<?php

require_once 'session.php';

$conn = require_once "partials/dbconnection-kim.php";

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM product WHERE id = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    }

    $stmt->close();
}

$conn->close();

header("Location: dashboard.php");
exit;
?>

