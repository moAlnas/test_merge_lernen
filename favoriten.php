<?php
session_start();
require 'db.php';

// Prüfen, ob der Benutzer angemeldet ist
if (!isset($_SESSION['user_id'])) {
    die("Bitte melde dich zuerst an.");
}

// Aktuelle Benutzer-ID aus der Session holen
$user_id = $_SESSION['user_id'];

// Favoriten abrufen
try {
    $stmt = $pdo->prepare("SELECT title FROM favoriten WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $favoriten = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Fehler beim Abrufen der Favoriten: " . $e->getMessage());
}

// HTML-Ausgabe
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Favoriten</title>
</head>
<body>
    <h1>Deine Favoriten</h1>
    <?php if (empty($favoriten)): ?>
        <p>Du hast noch keine Favoriten.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($favoriten as $favorit): ?>
                <li><a href="<?= htmlspecialchars($favorit['link']) ?>"><?= htmlspecialchars($favorit['title']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
