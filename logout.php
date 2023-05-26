<?php
// Start die session
session_start();

// leert alle session variablen
$_SESSION = array();

// beendet die session
session_destroy();

// zurück zur login seite
header("Location: login.php");
exit();
?>
