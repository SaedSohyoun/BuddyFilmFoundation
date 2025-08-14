<?php
session_start();

// Laad e-mail configuratie
require_once 'email_config.php';

// Controleer of het formulier is verzonden
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Haal de formuliergegevens op
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Valideer de invoer
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Naam is verplicht.";
    }
    
    if (empty($email)) {
        $errors[] = "E-mail is verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Voer een geldig e-mailadres in.";
    }
    
    if (empty($subject)) {
        $errors[] = "Onderwerp is verplicht.";
    }
    
    if (empty($message)) {
        $errors[] = "Bericht is verplicht.";
    }
    
    // Als er geen fouten zijn, verstuur de e-mail
    if (empty($errors)) {
        // E-mail headers - stuur naar zowel website e-mail als admin Gmail
        $to = WEBSITE_EMAIL . ", " . ADMIN_EMAIL;
        $email_subject = "Nieuw contactformulier bericht: " . $subject;
        
        // E-mail body
        $email_body = "Er is een nieuw bericht ontvangen via het contactformulier op de website.\n\n";
        $email_body .= "Details:\n";
        $email_body .= "Naam: " . $name . "\n";
        $email_body .= "E-mail: " . $email . "\n";
        $email_body .= "Onderwerp: " . $subject . "\n";
        $email_body .= "Bericht:\n" . $message . "\n";
        $email_body .= "\n---\n";
        $email_body .= "Dit bericht is automatisch gegenereerd door het contactformulier op buddyfilmfoundation.com";
        
        // Headers
        $headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        // Sla het bericht op in de database
        include 'inc/connectie.php';
        $stmt = $conn->prepare("INSERT INTO contact_berichten (naam, email, onderwerp, bericht) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();
        $stmt->close();
        
        // Sla het bericht ook op in een bestand voor backup
        $log_entry = date('Y-m-d H:i:s') . " - Naam: " . $name . " - E-mail: " . $email . " - Onderwerp: " . $subject . " - Bericht: " . substr($message, 0, 100) . "...\n";
        file_put_contents('contact_messages.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        // Verstuur de e-mail
        $mail_sent = false;
        
        // Voor lokale ontwikkeling: sla altijd op als bestand
        $email_file = "emails/" . date('Y-m-d_H-i-s') . "_" . uniqid() . ".txt";
        
        // Maak emails directory als deze niet bestaat
        if (!is_dir('emails')) {
            mkdir('emails', 0755, true);
        }
        
        $email_content = "To: " . $to . "\n";
        $email_content .= "Subject: " . $email_subject . "\n";
        $email_content .= "From: " . EMAIL_FROM . "\n";
        $email_content .= "Reply-To: " . $email . "\n";
        $email_content .= "Date: " . date('r') . "\n\n";
        $email_content .= $email_body;
        
        $mail_sent = file_put_contents($email_file, $email_content) !== false;
        
        // Probeer ook de standaard mail() functie (voor productie)
        if (function_exists('mail') && !strpos($_SERVER['HTTP_HOST'], 'localhost')) {
            $mail_sent = $mail_sent || mail($to, $email_subject, $email_body, $headers);
        }
        
        // Methode 3: Probeer ook een aparte e-mail naar je Gmail te sturen
        $gmail_to = ADMIN_EMAIL;
        $gmail_subject = "NIEUW CONTACT BERICHT - " . $subject;
        $gmail_body = "🔔 NIEUW CONTACT BERICHT ONTVANGEN!\n\n";
        $gmail_body .= "Er is een nieuw bericht ontvangen via het contactformulier op buddyfilmfoundation.com\n\n";
        $gmail_body .= "📧 VAN: " . $name . " (" . $email . ")\n";
        $gmail_body .= "📝 ONDERWERP: " . $subject . "\n";
        $gmail_body .= "📅 DATUM: " . date('d-m-Y H:i:s') . "\n\n";
        $gmail_body .= "💬 BERICHT:\n" . $message . "\n\n";
        $gmail_body .= "---\n";
        $gmail_body .= "Dit bericht is automatisch gegenereerd door het contactformulier.\n";
        $gmail_body .= "Je kunt dit bericht ook bekijken in de admin dashboard.";
        
        $gmail_headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM . ">\r\n";
        $gmail_headers .= "Reply-To: " . $email . "\r\n";
        $gmail_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $gmail_headers .= "X-Mailer: PHP/" . phpversion();
        
        // Voor lokale ontwikkeling: sla Gmail e-mail ook op als bestand
        $gmail_file = "emails/GMAIL_" . date('Y-m-d_H-i-s') . "_" . uniqid() . ".txt";
        
        $gmail_content = "To: " . $gmail_to . "\n";
        $gmail_content .= "Subject: " . $gmail_subject . "\n";
        $gmail_content .= "From: " . EMAIL_FROM . "\n";
        $gmail_content .= "Reply-To: " . $email . "\n";
        $gmail_content .= "Date: " . date('r') . "\n\n";
        $gmail_content .= $gmail_body;
        
        $gmail_sent = file_put_contents($gmail_file, $gmail_content) !== false;
        
        // Probeer ook de standaard mail() functie (voor productie)
        if (function_exists('mail') && !strpos($_SERVER['HTTP_HOST'], 'localhost')) {
            $gmail_sent = $gmail_sent || mail($gmail_to, $gmail_subject, $gmail_body, $gmail_headers);
        }
        
        // Als SMTP is ingeschakeld, probeer ook via SMTP te versturen
        if (USE_SMTP && function_exists('fsockopen') && !strpos($_SERVER['HTTP_HOST'], 'localhost')) {
            // Dit is een basis SMTP implementatie - voor productie gebruik je beter PHPMailer
            $gmail_sent = $gmail_sent || sendEmailViaSMTP($gmail_to, $gmail_subject, $gmail_body);
        }
        
        if ($mail_sent) {
            // Redirect met succes bericht - check waar het vandaan kwam
            $referer = $_SERVER['HTTP_REFERER'] ?? '';
            if (strpos($referer, 'contact.php') !== false) {
                header("Location: contact.php?contact=success");
            } else {
                header("Location: index.php?contact=success");
            }
            exit;
        } else {
            $errors[] = "Er is een fout opgetreden bij het versturen van het bericht. Het bericht is wel opgeslagen en we nemen contact met je op.";
        }
    }
    
    // Als er fouten zijn, redirect met foutmeldingen
    if (!empty($errors)) {
        $_SESSION['contact_errors'] = $errors;
        $_SESSION['contact_data'] = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ];
        // Check waar het vandaan kwam
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        if (strpos($referer, 'contact.php') !== false) {
            header("Location: contact.php?contact=error");
        } else {
            header("Location: index.php?contact=error");
        }
        exit;
    }
} else {
    // Als het geen POST request is, redirect naar homepage
    header("Location: index.php");
    exit;
}

// Eenvoudige SMTP functie (basis implementatie)
function sendEmailViaSMTP($to, $subject, $body) {
    if (!USE_SMTP) {
        return false;
    }
    
    try {
        $socket = fsockopen(SMTP_HOST, SMTP_PORT, $errno, $errstr, 30);
        if (!$socket) {
            return false;
        }
        
        // Basis SMTP communicatie
        fgets($socket, 515);
        fwrite($socket, "EHLO " . $_SERVER['SERVER_NAME'] . "\r\n");
        fgets($socket, 515);
        
        if (SMTP_SECURE == 'tls') {
            fwrite($socket, "STARTTLS\r\n");
            fgets($socket, 515);
            stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
        }
        
        // Authenticatie
        fwrite($socket, "AUTH LOGIN\r\n");
        fgets($socket, 515);
        fwrite($socket, base64_encode(SMTP_USERNAME) . "\r\n");
        fgets($socket, 515);
        fwrite($socket, base64_encode(SMTP_PASSWORD) . "\r\n");
        fgets($socket, 515);
        
        // E-mail versturen
        fwrite($socket, "MAIL FROM: <" . EMAIL_FROM . ">\r\n");
        fgets($socket, 515);
        fwrite($socket, "RCPT TO: <" . $to . ">\r\n");
        fgets($socket, 515);
        fwrite($socket, "DATA\r\n");
        fgets($socket, 515);
        
        $headers = "From: " . EMAIL_FROM_NAME . " <" . EMAIL_FROM . ">\r\n";
        $headers .= "To: " . $to . "\r\n";
        $headers .= "Subject: " . $subject . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "Date: " . date('r') . "\r\n\r\n";
        
        fwrite($socket, $headers . $body . "\r\n.\r\n");
        fgets($socket, 515);
        
        fwrite($socket, "QUIT\r\n");
        fclose($socket);
        
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
