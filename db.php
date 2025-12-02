
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database   = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database );

 
// Verbindung prüfen
if (mysqli_connect_error()) {
  die("Datenbankverbindung fehlgeschlagen: " . mysqli_connect_error());
}
echo "Erfolgreich verbunden, Ja Ho!";
?>

