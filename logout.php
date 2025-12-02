<?php
session_start();
session_destroy(); // Alle Session-Daten löschen
header('Location: login.php'); // Weiterleitung zur Login-Seite
exit();
?>
