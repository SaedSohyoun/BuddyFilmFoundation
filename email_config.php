<?php
// Email configuratie
// Vervang 'your-email@gmail.com' met je echte Gmail adres

// Je Gmail adres waar je contactberichten wilt ontvangen
define('ADMIN_EMAIL', 'info@buddyfilmfoundation.com'); // ← JOUW ECHTE GMAIL ADRES

// Website e-mail adres
define('WEBSITE_EMAIL', 'info@buddyfilmfoundation.com');

// E-mail instellingen
define('EMAIL_FROM', 'noreply@buddyfilmfoundation.com');
define('EMAIL_FROM_NAME', 'Buddy Film Foundation');

// SMTP instellingen (optioneel - voor betere e-mail aflevering)
define('USE_SMTP', false); // Zet op true als je SMTP wilt gebruiken
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'info@buddyfilmfoundation.com'); // Je Gmail adres
define('SMTP_PASSWORD', 'your-app-password'); // Je Gmail app wachtwoord
define('SMTP_SECURE', 'tls');

// Instructies:
// 1. Vervang 'your-email@gmail.com' met je echte Gmail adres
// 2. Als je SMTP wilt gebruiken (aanbevolen voor betere aflevering):
//    - Zet USE_SMTP op true
//    - Maak een app wachtwoord aan in je Google Account
//    - Vul je Gmail adres en app wachtwoord in
// 3. Als je geen SMTP gebruikt, kunnen e-mails in spam terechtkomen
?>
