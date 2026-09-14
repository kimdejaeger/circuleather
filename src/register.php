<?php
$conn = require_once "partials/dbconnection-kim.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formUsername = htmlspecialchars(trim($_POST["username"] ?? ''));
    $password = $_POST["password"] ?? '';
    $email = htmlspecialchars(trim($_POST["email"] ?? ''));
    $rol = htmlspecialchars(trim($_POST["rol"] ?? ''));

    $errors = [];

    // Username controleren
    if ($formUsername === '') {
        $errors[] = "Username is verplicht.";
    } elseif (strlen($formUsername) < 5 || strlen($formUsername) > 20) {
        $errors[] = "Username moet tussen de 5 en 20 tekens zijn.";
    }

    // Password controleren
    if ($password === '') {
        $errors[] = "Password is verplicht.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password moet minimaal 8 tekens bevatten.";
    }

    // Email controleren
    if ($email === '') {
        $errors[] = "Email is verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres.";
    }

    // Rol controleren
    if ($rol === '') {
        $errors[] = "Rol is verplicht.";
    }

    if (empty($errors)) {

        // Wachtwoord veilig versleutelen
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (username, password, email, rol)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssss",
            $formUsername,
            $hashedPassword,
            $email,
            $rol
        );

        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            header("Location: login.html");
            exit();
        } else {
            $errors[] = "Er ging iets mis.";
        }
    }
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
</head>

<body>

<div>
    <form action="register.php" method="POST">

        <h2>Registreer</h2>

        <input
            type="text"
            name="username"
            placeholder="Username"
            minlength="5"
            maxlength="20"
            required
        >
        <br><br>

        <input
            type="password"
            name="password"
            placeholder="Password"
            minlength="8"
            required
        >
        <br><br>

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >
        <br><br>

        <select name="rol" required>
            <option value="">Kies een rol</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <br><br>

        <button type="submit">Voeg persoon toe</button>

    </form>
</div>

<div>
    <?php
    if (!empty($errors)) {
        echo "<ul>";

        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }

        echo "</ul>";
    }
    ?>
</div>

</body>
</html>