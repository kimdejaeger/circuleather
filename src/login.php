<?php
session_start();
$conn = require_once "partials/dbconnection-kim.php";

$formUsername = $_POST['name'] ?? '';
$formPassword = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $formUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();

    if (password_verify($formPassword, $user['password'])) {

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "Username or password are not correct";
    }

} else {
    echo "Username or password are not correct";
}
?>