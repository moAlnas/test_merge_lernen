<?php

session_start();


require 'db.php';
//Die Variable $_SERVER['REQUEST_METHOD'] gibt die HTTP-Methode 
//zurück, die für die aktuelle Anfrage verwendet wurde. Häufige HTTP-Methoden sind:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Benutzer in der Datenbank suchen
    try {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Login erfolgreich, Benutzer-ID in Session speichern
            $_SESSION['user_id'] = $user['id'];
            header('Location: favoriten.php'); // Weiterleitung zur Favoriten-Seite
            exit();
        } else {
            $error = "Ungültiger Benutzername oder Passwort.";
        }
    } catch (PDOException $e) {
        die("Fehler bei der Anmeldung: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Benutzername:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Passwort:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Anmelden</button>
    </form>
</body>
</html>
