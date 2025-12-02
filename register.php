<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Benutzer in die Datenbank einfügen
    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        header('Location: login.php'); // Weiterleitung zur Login-Seite
        exit();
    } catch (PDOException $e) {
        die("Fehler bei der Registrierung: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Registrieren</title>
</head>
<body>
    <h1>Registrieren</h1>
    <form method="post">
        <label for="username">Benutzername:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="email">E-Mail:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Passwort:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Registrieren</button>
    </form>
</body>
</html>
