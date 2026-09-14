<?php
session_start();
$conn = require_once "partials/dbconnection-kim.php";

$formUsername = $_POST['name'] ?? '';
$formPassword = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $formUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1){

    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    
    header("Location: dashboard.php");
    exit();
} else {
    echo "Username or password are not correct";
}
?>
