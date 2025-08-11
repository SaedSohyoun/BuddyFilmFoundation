# Betalingsverwerking Setup - Buddy Film Foundation

## 📋 Overzicht

Dit document bevat instructies voor het instellen van echte betalingsverwerking voor de donatie functionaliteit. Het systeem ondersteunt de volgende betalingsmethoden:

- **PayPal** - Voor internationale donaties
- **iDEAL** - Voor Nederlandse bankoverschrijvingen
- **Credit Cards** - Visa, Mastercard, American Express
- **Directe Bankoverschrijving** - Handmatige overschrijving

## 🔧 Vereiste Accounts

### 1. PayPal Business Account
- Ga naar [PayPal Business](https://www.paypal.com/business)
- Maak een Business account aan
- Verifieer je email en bankrekening
- Ga naar **Tools > PayPal Buttons**
- Kopieer je **Client ID** en **Secret**

### 2. Mollie Account (voor iDEAL)
- Ga naar [Mollie](https://www.mollie.com)
- Maak een account aan
- Verifieer je bedrijf
- Ga naar **Settings > API Keys**
- Kopieer je **Live API Key** en **Test API Key**

### 3. Stripe Account (voor Credit Cards)
- Ga naar [Stripe](https://stripe.com)
- Maak een account aan
- Verifieer je bedrijf
- Ga naar **Developers > API Keys**
- Kopieer je **Publishable Key** en **Secret Key**

## ⚙️ Configuratie

### Stap 1: API Keys Instellen

Open `process_payment.php` en vervang de placeholder waarden:

```php
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
```

### Stap 2: PayPal Email Instellen

In `process_payment.php`, regel 108, vervang de PayPal email:

```php
'business' => 'info@buddyfilmfoundation.com', // Je PayPal email
```

### Stap 3: Return URLs Aanpassen

Pas de return URLs aan in `process_payment.php`:

```php
'return' => 'https://buddyfilmfoundation.com/donate_success.php',
'cancel_return' => 'https://buddyfilmfoundation.com/donate_cancel.php',
'notify_url' => 'https://buddyfilmfoundation.com/process_payment.php?ipn=paypal'
```

## 📦 SDK Installatie

### PayPal SDK
```bash
composer require paypal/rest-api-sdk-php
```

### Mollie SDK
```bash
composer require mollie/mollie-api-php
```

### Stripe SDK
```bash
composer require stripe/stripe-php
```

## 🔄 Echte Betalingsverwerking Implementeren

### PayPal Integratie

Vervang de `processPayPalPayment` functie in `process_payment.php`:

```php
function processPayPalPayment($data) {
    global $config;
    
    require_once 'vendor/autoload.php';
    
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            $config['paypal']['client_id'],
            $config['paypal']['client_secret']
        )
    );
    
    $apiContext->setConfig([
        'mode' => $config['paypal']['mode']
    ]);
    
    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale');
    
    $redirectUrls = new \PayPal\Api\RedirectUrls();
    $redirectUrls->setReturnUrl('https://buddyfilmfoundation.com/donate_success.php')
                 ->setCancelUrl('https://buddyfilmfoundation.com/donate_cancel.php');
    $payment->setRedirectUrls($redirectUrls);
    
    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount(new \PayPal\Api\Amount([
        'total' => $data['amount'],
        'currency' => 'EUR'
    ]));
    $transaction->setDescription('Donation to Buddy Film Foundation');
    
    $payment->setTransactions([$transaction]);
    
    try {
        $payment->create($apiContext);
        return [
            'success' => true,
            'transaction_id' => $payment->getId(),
            'redirect_url' => $payment->getApprovalLink()
        ];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
```

### Mollie iDEAL Integratie

Vervang de `processIDEALPayment` functie:

```php
function processIDEALPayment($data) {
    global $config;
    
    require_once 'vendor/autoload.php';
    
    $mollie = new \Mollie\Api\MollieApiClient();
    $mollie->setApiKey($config['mollie']['api_key']);
    
    try {
        $payment = $mollie->payments->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => number_format($data['amount'], 2, '.', '')
            ],
            'description' => 'Donation to Buddy Film Foundation',
            'redirectUrl' => 'https://buddyfilmfoundation.com/donate_success.php',
            'webhookUrl' => 'https://buddyfilmfoundation.com/process_payment.php?webhook=mollie',
            'metadata' => [
                'donation_id' => $data['donation_id'] ?? null
            ]
        ]);
        
        return [
            'success' => true,
            'transaction_id' => $payment->id,
            'redirect_url' => $payment->getCheckoutUrl()
        ];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
```

### Stripe Credit Card Integratie

Vervang de `processCreditCardPayment` functie:

```php
function processCreditCardPayment($data) {
    global $config;
    
    require_once 'vendor/autoload.php';
    
    \Stripe\Stripe::setApiKey($config['stripe']['secret_key']);
    
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Donation to Buddy Film Foundation',
                    ],
                    'unit_amount' => intval($data['amount'] * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'https://buddyfilmfoundation.com/donate_success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://buddyfilmfoundation.com/donate_cancel.php',
            'metadata' => [
                'donation_id' => $data['donation_id'] ?? null
            ]
        ]);
        
        return [
            'success' => true,
            'transaction_id' => $session->id,
            'redirect_url' => $session->url
        ];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}
```

## 🔒 Beveiliging

### SSL Certificaat
- Zorg ervoor dat je website een geldig SSL certificaat heeft
- Alle betalingsverkeer moet via HTTPS verlopen

### Webhook Beveiliging
- Implementeer webhook verificatie voor alle providers
- Gebruik sterke wachtwoorden voor alle accounts
- Houd API keys veilig en deel ze nooit

### Database Beveiliging
- Gebruik prepared statements (al geïmplementeerd)
- Valideer alle input data
- Log alle betalingsactiviteiten

## 📧 Email Notificaties

Implementeer email notificaties voor:
- Succesvolle donaties
- Mislukte betalingen
- Webhook ontvangst

## 🧪 Testen

### Test Modus
- Alle providers hebben een test/sandbox modus
- Test eerst uitgebreid voordat je naar productie gaat
- Gebruik test credit cards en bankrekeningen

### Productie
- Verander alle `test_mode` en `mode` instellingen naar `live`
- Verifieer alle accounts volledig
- Test met kleine bedragen

## 📞 Support

Voor vragen over:
- **PayPal**: [PayPal Developer Support](https://developer.paypal.com/support/)
- **Mollie**: [Mollie Support](https://www.mollie.com/en/contact)
- **Stripe**: [Stripe Support](https://support.stripe.com/)

## ⚠️ Belangrijke Opmerkingen

1. **Compliance**: Zorg ervoor dat je voldoet aan alle lokale wetgevingen
2. **Privacy**: Implementeer GDPR compliance voor Europese gebruikers
3. **Backup**: Maak regelmatig backups van je database
4. **Monitoring**: Monitor alle betalingsverkeer op verdachte activiteiten
5. **Updates**: Houd alle SDK's en dependencies up-to-date

## 🎯 Volgende Stappen

1. Stel alle accounts in
2. Configureer de API keys
3. Test in sandbox/test modus
4. Implementeer webhook handlers
5. Test met echte betalingen
6. Ga live en monitor de resultaten
