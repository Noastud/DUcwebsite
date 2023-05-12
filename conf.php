<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";
//verbindung zur Datenbank wird versucht mit den angemessenen Login Daten.
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Falls die Verbindung fehlgeschlagen ist, gibt man einen Error an.
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
﻿
