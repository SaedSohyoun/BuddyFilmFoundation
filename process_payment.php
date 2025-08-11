<?php
session_start();
include 'inc/connectie.php';

// Configuratie voor betalingsproviders
$config = [
    'paypal' => [
        'client_id' => 'YOUR_PAYPAL_CLIENT_ID', // Vervang met je echte PayPal Client ID
        'client_secret' => 'YOUR_PAYPAL_SECRET', // Vervang met je echte PayPal Secret
        'mode' => 'sandbox' // Verander naar 'live' voor productie
    ],
    'mollie' => [
        'api_key' => 'YOUR_MOLLIE_API_KEY', // Vervang met je echte Mollie API key
        'test_mode' => true // Verander naar false voor productie
    ],
    'stripe' => [
        'publishable_key' => 'YOUR_STRIPE_PUBLISHABLE_KEY', // Vervang met je echte Stripe key
        'secret_key' => 'YOUR_STRIPE_SECRET_KEY', // Vervang met je echte Stripe secret
        'test_mode' => true // Verander naar false voor productie
    ]
];

// Functie om donatie op te slaan in database
function saveDonation($conn, $data) {
    try {
        // Check of donaties tabel bestaat, zo niet maak deze aan
        $tableExists = $conn->query("SHOW TABLES LIKE 'donaties'");
        if ($tableExists->num_rows == 0) {
            $createTable = "CREATE TABLE IF NOT EXISTS `donaties` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `voornaam` varchar(100) NOT NULL,
                `achternaam` varchar(100) NOT NULL,
                `email` varchar(255) NOT NULL,
                `bedrag` decimal(10,2) NOT NULL,
                `donatie_namens` enum('myself','organization','someone-else') DEFAULT NULL,
                `gehoord_via` varchar(100) DEFAULT NULL,
                `datum` date NOT NULL,
                `tijd` time NOT NULL,
                `status` enum('pending','completed','failed') DEFAULT 'pending',
                `betaalmethode` varchar(50) DEFAULT NULL,
                `transactie_id` varchar(255) DEFAULT NULL,
                `opmerkingen` text DEFAULT NULL,
                `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_datum` (`datum`),
                KEY `idx_status` (`status`),
                KEY `idx_email` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            $conn->query($createTable);
        }

        $stmt = $conn->prepare("INSERT INTO donaties (voornaam, achternaam, email, bedrag, donatie_namens, gehoord_via, datum, tijd, status, betaalmethode, transactie_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $datum = date('Y-m-d');
        $tijd = date('H:i:s');
        $status = 'pending';
        
        $stmt->bind_param("sssdsssssss", 
            $data['firstName'], 
            $data['lastName'], 
            $data['email'], 
            $data['amount'], 
            $data['donateInName'], 
            $data['hearAbout'], 
            $datum, 
            $tijd, 
            $status, 
            $data['paymentMethod'], 
            $data['transactionId']
        );
        
        if ($stmt->execute()) {
            return $conn->insert_id;
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }
    } catch (Exception $e) {
        error_log("Error saving donation: " . $e->getMessage());
        return false;
    }
}

// PayPal betaling verwerken
function processPayPalPayment($data) {
    global $config;
    
    // PayPal SDK zou hier geïntegreerd worden
    // Voor nu simuleren we de betaling
    
    $transactionId = 'PAYPAL_' . time() . '_' . rand(1000, 9999);
    
    return [
        'success' => true,
        'transaction_id' => $transactionId,
        'redirect_url' => 'https://www.paypal.com/cgi-bin/webscr?' . http_build_query([
            'cmd' => '_donations',
            'business' => 'info@buddyfilmfoundation.com', // Je PayPal email
            'item_name' => 'Donation to Buddy Film Foundation',
            'amount' => $data['amount'],
            'currency_code' => 'EUR',
            'return' => 'https://buddyfilmfoundation.com/donate_success.php',
            'cancel_return' => 'https://buddyfilmfoundation.com/donate_cancel.php',
            'notify_url' => 'https://buddyfilmfoundation.com/paypal_ipn.php'
        ])
    ];
}

// iDEAL betaling via Mollie
function processIDEALPayment($data) {
    global $config;
    
    // Mollie SDK zou hier geïntegreerd worden
    // Voor nu simuleren we de betaling
    
    $transactionId = 'IDEAL_' . time() . '_' . rand(1000, 9999);
    
    return [
        'success' => true,
        'transaction_id' => $transactionId,
        'redirect_url' => 'https://www.mollie.com/payscreen/select-method/' . $transactionId
    ];
}

// Credit Card betaling via Stripe
function processCreditCardPayment($data) {
    global $config;
    
    // Stripe SDK zou hier geïntegreerd worden
    // Voor nu simuleren we de betaling
    
    $transactionId = 'STRIPE_' . time() . '_' . rand(1000, 9999);
    
    return [
        'success' => true,
        'transaction_id' => $transactionId,
        'redirect_url' => 'https://checkout.stripe.com/pay/' . $transactionId
    ];
}

// Directe bankoverschrijving
function processBankTransfer($data) {
    $transactionId = 'BANK_' . time() . '_' . rand(1000, 9999);
    
    return [
        'success' => true,
        'transaction_id' => $transactionId,
        'bank_details' => [
            'iban' => 'NL 96 TRIO 0338 5192 89',
            'bic' => 'TRIONL2U',
            'beneficiary' => 'Stichting Buddy Film Foundation',
            'reference' => $transactionId
        ]
    ];
}

// Hoofdverwerking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => '', 'data' => null];
    
    try {
        // Valideer input
        $required_fields = ['firstName', 'lastName', 'email', 'amount', 'paymentMethod'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Veld '$field' is verplicht.");
            }
        }
        
        // Email validatie
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Ongeldig email adres.");
        }
        
        // Bedrag validatie
        $amount = floatval($_POST['amount']);
        if ($amount < 1) {
            throw new Exception("Minimum donatie bedrag is €1.");
        }
        
        // Bereid data voor
        $donationData = [
            'firstName' => htmlspecialchars($_POST['firstName']),
            'lastName' => htmlspecialchars($_POST['lastName']),
            'email' => htmlspecialchars($_POST['email']),
            'amount' => $amount,
            'donateInName' => htmlspecialchars($_POST['donateInName'] ?? ''),
            'hearAbout' => htmlspecialchars($_POST['hearAbout'] ?? ''),
            'paymentMethod' => htmlspecialchars($_POST['paymentMethod']),
            'transactionId' => null
        ];
        
        // Verwerk betaling op basis van methode
        switch ($donationData['paymentMethod']) {
            case 'paypal':
                $paymentResult = processPayPalPayment($donationData);
                break;
            case 'ideal':
                $paymentResult = processIDEALPayment($donationData);
                break;
            case 'creditcard':
                $paymentResult = processCreditCardPayment($donationData);
                break;
            case 'banktransfer':
                $paymentResult = processBankTransfer($donationData);
                break;
            default:
                throw new Exception("Ongeldige betalingsmethode.");
        }
        
        if ($paymentResult['success']) {
            // Sla donatie op in database
            $donationData['transactionId'] = $paymentResult['transaction_id'];
            $donationId = saveDonation($conn, $donationData);
            
            if ($donationId) {
                $response['success'] = true;
                $response['message'] = 'Betaling succesvol geïnitieerd.';
                $response['data'] = [
                    'donation_id' => $donationId,
                    'transaction_id' => $paymentResult['transaction_id'],
                    'redirect_url' => $paymentResult['redirect_url'] ?? null,
                    'bank_details' => $paymentResult['bank_details'] ?? null
                ];
            } else {
                throw new Exception("Fout bij het opslaan van de donatie.");
            }
        } else {
            throw new Exception("Betaling kon niet worden verwerkt.");
        }
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    // Stuur JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// PayPal IPN (Instant Payment Notification) handler
if (isset($_GET['ipn']) && $_GET['ipn'] === 'paypal') {
    // Hier zou je PayPal IPN verwerking implementeren
    // Dit wordt aangeroepen door PayPal na een succesvolle betaling
    
    $donationId = $_POST['custom'] ?? null;
    $paymentStatus = $_POST['payment_status'] ?? '';
    $transactionId = $_POST['txn_id'] ?? '';
    
    if ($donationId && $paymentStatus === 'Completed') {
        // Update donatie status naar completed
        $stmt = $conn->prepare("UPDATE donaties SET status = 'completed' WHERE id = ?");
        $stmt->bind_param("i", $donationId);
        $stmt->execute();
        
        // Stuur bevestigingsemail
        // emailBevestiging($donationId);
    }
    
    echo "OK";
    exit;
}
?>
