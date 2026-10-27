<?php
$conn = require_once "partials/dbconnection-kim.php";

// Controleert of het registratieformulier is verstuurd
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Haalt de ingevulde gegevens op en verwijdert onnodige spaties
    $formUsername = trim($_POST["username"] ?? '');
    $password = $_POST["password"] ?? '';
    $email = trim($_POST["email"] ?? '');
    $rol = $_POST["rol"] ?? '';

    $errors = [];

    // Controleert of de username geldig is
    if ($formUsername === '') {
        $errors[] = "Username is verplicht.";
    } elseif (strlen($formUsername) < 5 || strlen($formUsername) > 20) {
        $errors[] = "Username moet tussen de 5 en 20 tekens zijn.";
    }

    // Controleert of het wachtwoord lang genoeg is
    if ($password === '') {
        $errors[] = "Password is verplicht.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password moet minimaal 8 tekens bevatten.";
    }

    // Controleert of het e-mailadres geldig is
    if ($email === '') {
        $errors[] = "Email is verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Ongeldig e-mailadres.";
    }

    // Controleert of de gekozen rol geldig is
    if (!in_array($rol, ['bedrijf', 'admin'], true)) {
        $errors[] = "Kies een geldige rol.";
    }

    // Slaat de gegevens alleen op als er geen fouten zijn
    if (empty($errors)) {

        // Controleert of de username al bestaat
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $formUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Deze username is al in gebruik.";
        } else {

            // Hashing beschermt het wachtwoord; het echte wachtwoord wordt niet opgeslagen
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Voegt de nieuwe gebruiker toe met een prepared statement
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

            if ($stmt->execute()) {
                header("Location: login.html");
                exit();
            } else {
                $errors[] = "Er ging iets mis bij het registreren.";
            }
        }

        $stmt->close();
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

            <!-- Formulier met de gegevens die nodig zijn om een account aan te maken -->
            <input
                type="text"
                name="username"
                placeholder="Username"
                minlength="5"
                maxlength="20"
                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
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
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
            >
            <br><br>

            <select name="rol" required>
                <option value="">Kies een rol</option>
                <option value="bedrijf" <?= ($_POST['rol'] ?? '') === 'bedrijf' ? 'selected' : '' ?>>
                    Bedrijf
                </option>
                <option value="admin" <?= ($_POST['rol'] ?? '') === 'admin' ? 'selected' : '' ?>>
                    Admin
                </option>
            </select>
            <br><br>

            <button type="submit">Registreer</button>

        </form>
    </div>

    <!-- Toont eventuele foutmeldingen onder elkaar -->
    <div>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</body>

</html>
