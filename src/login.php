<?php
session_start();
$conn = require_once "partials/dbconnection-kim.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
            $_SESSION['klant_id'] = $user['id'];

            header("Location: dashboard.php");
            exit();

        } else {
            $error = "Username or password are not correct";
        }

    } else {
        $error = "Username or password are not correct";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h1>Login</h1>

    <?php if ($error): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
<form method="POST">
    <input type="text" name="name" placeholder="Username" required>
    <br>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <button type="submit">Login</button>
</form>

</body>
</html>