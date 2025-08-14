# 📧 Gmail Instellen voor Contact Berichten

## 🎯 Wat je moet doen:

### **Stap 1: Je Gmail Adres Invullen**

1. **Open het bestand `email_config.php`**
2. **Vervang `jouw-echte-email@gmail.com` met je echte Gmail adres**
3. **Sla het bestand op**

```php
// Je Gmail adres waar je contactberichten wilt ontvangen
define('ADMIN_EMAIL', 'jouw-echte-email@gmail.com'); // ← VERVANG DIT!
```

### **Stap 2: Test Basis E-mail (Eenvoudig)**

1. **Zorg dat `USE_SMTP` op `false` staat**
2. **Test het contactformulier**
3. **Controleer je Gmail inbox (en spam map)**

### **Stap 3: Geavanceerde SMTP Instellingen (Aanbevolen)**

Voor betere e-mail aflevering en om spam te voorkomen:

#### **3.1 Google App Wachtwoord Aanmaken**

1. **Ga naar je Google Account instellingen**
2. **Beveiliging → 2-staps verificatie** (moet aan staan)
3. **App-wachtwoorden → App-wachtwoord genereren**
4. **Kies "Mail" en genereer een wachtwoord**
5. **Kopieer het 16-cijferige wachtwoord**

#### **3.2 SMTP Configuratie**

Pas `email_config.php` aan:

```php
// Zet SMTP aan
define('USE_SMTP', true);

// Vul je Gmail gegevens in
define('SMTP_USERNAME', 'jouw-echte-email@gmail.com');
define('SMTP_PASSWORD', 'jouw-16-cijferige-app-wachtwoord');
```

## 🧪 Testen

### **Voor Lokale Ontwikkeling:**
- E-mails worden opgeslagen in `emails/` directory
- Bekijk via admin dashboard → "📁 E-mail Bestanden"

### **Voor Productie:**
- E-mails worden verstuurd naar je Gmail
- Controleer inbox en spam map

## 🔍 Troubleshooting

### **E-mails komen niet aan?**
1. **Controleer spam/junk map**
2. **Verifieer Gmail adres in `email_config.php`**
3. **Test met SMTP instellingen**
4. **Controleer of 2-staps verificatie aan staat**

### **SMTP werkt niet?**
1. **Controleer app wachtwoord**
2. **Zorg dat 2-staps verificatie aan staat**
3. **Verifieer Gmail adres**
4. **Test met basis instellingen eerst**

## 📞 Voorbeelden

### **Basis E-mail (naar info@buddyfilmfoundation.com)**
```
Onderwerp: Nieuw contactformulier bericht: [Onderwerp]
Van: noreply@buddyfilmfoundation.com
Naar: info@buddyfilmfoundation.com, jouw-email@gmail.com
```

### **Gmail Notificatie (naar jouw Gmail)**
```
Onderwerp: NIEUW CONTACT BERICHT - [Onderwerp]
Van: noreply@buddyfilmfoundation.com
Naar: jouw-email@gmail.com
```

## 🎉 Resultaat

**Na het instellen van je Gmail adres:**

- ✅ Contact berichten komen in admin dashboard
- ✅ E-mails worden verstuurd naar je Gmail
- ✅ Backup in e-mail bestanden
- ✅ Geen mailserver fouten meer

**Succes met het instellen van je Gmail notificaties!** 🚀
