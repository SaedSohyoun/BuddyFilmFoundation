<?php
// Zet sessie-instellingen vóór session_start()
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0);

session_start();

// Alle sessiegegevens wissen
$_SESSION = [];

// Sessie cookie verwijderen als cookies gebruikt worden
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    // Zet de cookie met dezelfde parameters op verlopen tijdstip om cookie te verwijderen
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Sessie vernietigen
session_destroy();

// Redirect naar loginpagina
header("Location: login.php");
exit;