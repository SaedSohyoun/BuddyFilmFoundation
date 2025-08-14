# Gmail Setup Guide - Contact Form Notifications

## 📧 Contactformulier E-mail Notificaties Instellen

### Stap 1: E-mail Configuratie Aanpassen

1. **Open het bestand `email_config.php`**
2. **Vervang `your-email@gmail.com` met je echte Gmail adres:**

```php
// Je Gmail adres waar je contactberichten wilt ontvangen
define('ADMIN_EMAIL', 'jouw-email@gmail.com'); // ← Vervang dit!
```

### Stap 2: Basis E-mail Instellingen (Aanbevolen)

Voor de meeste gebruikers is de basis instelling voldoende:

```php
// Zet dit op false voor basis e-mail functionaliteit
define('USE_SMTP', false);
```

**Voordelen:**
- ✅ Eenvoudig in te stellen
- ✅ Werkt direct
- ✅ Geen extra configuratie nodig

**Nadelen:**
- ⚠️ E-mails kunnen in spam terechtkomen
- ⚠️ Minder betrouwbaar dan SMTP

### Stap 3: Geavanceerde SMTP Instellingen (Optioneel)

Voor betere e-mail aflevering en om spam te voorkomen:

#### 3.1 Google Account App Wachtwoord Aanmaken

1. **Ga naar je Google Account instellingen**
2. **Beveiliging → 2-staps verificatie** (moet aan staan)
3. **App-wachtwoorden → App-wachtwoord genereren**
4. **Kies "Mail" en genereer een wachtwoord**
5. **Kopieer het 16-cijferige wachtwoord**

#### 3.2 SMTP Configuratie

Pas `email_config.php` aan:

```php
// Zet SMTP aan
define('USE_SMTP', true);

// Vul je Gmail gegevens in
define('SMTP_USERNAME', 'jouw-email@gmail.com');
define('SMTP_PASSWORD', 'jouw-16-cijferige-app-wachtwoord');
```

### Stap 4: Testen

1. **Ga naar je website**
2. **Vul het contactformulier in**
3. **Verstuur een test bericht**
4. **Controleer je Gmail inbox (en spam map)**

### Stap 5: Troubleshooting

#### E-mails komen niet aan?

1. **Controleer spam/junk map**
2. **Verifieer Gmail adres in `email_config.php`**
3. **Test met SMTP instellingen**
4. **Controleer server logs**

#### SMTP werkt niet?

1. **Controleer app wachtwoord**
2. **Zorg dat 2-staps verificatie aan staat**
3. **Verifieer Gmail adres**
4. **Test met basis instellingen eerst**

### Stap 6: E-mail Voorbeelden

#### Basis E-mail (naar info@buddyfilmfoundation.com)
```
Onderwerp: Nieuw contactformulier bericht: [Onderwerp]
Van: noreply@buddyfilmfoundation.com
Naar: info@buddyfilmfoundation.com, jouw-email@gmail.com
```

#### Gmail Notificatie (naar jouw Gmail)
```
Onderwerp: NIEUW CONTACT BERICHT - [Onderwerp]
Van: noreply@buddyfilmfoundation.com
Naar: jouw-email@gmail.com
```

### Stap 7: Admin Dashboard

Alle berichten worden ook opgeslagen in de admin dashboard:
- **Ga naar:** `admin/contact_berichten.php`
- **Bekijk alle berichten**
- **Markeer als gelezen**
- **Verwijder berichten**

### Stap 8: Backup

Berichten worden ook opgeslagen in:
- **Database:** `contact_berichten` tabel
- **Bestand:** `contact_messages.txt`
- **E-mail bestanden:** `emails/` directory (als backup)

---

## 🔧 Technische Details

### Bestanden die zijn aangepast:
- `process_contact.php` - E-mail verwerking
- `email_config.php` - E-mail configuratie
- `admin/contact_berichten.php` - Admin dashboard

### Database tabel:
```sql
CREATE TABLE contact_berichten (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    onderwerp VARCHAR(255) NOT NULL,
    bericht TEXT NOT NULL,
    datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    gelezen TINYINT(1) DEFAULT 0
);
```

### E-mail Methoden:
1. **PHP mail() functie** - Basis methode
2. **SMTP via Gmail** - Geavanceerde methode
3. **File backup** - Backup naar bestanden

---

## 📞 Support

Als je problemen hebt:
1. **Controleer eerst spam map**
2. **Test met basis instellingen**
3. **Verifieer Gmail adres**
4. **Controleer server logs**

**Succes met het instellen van je Gmail notificaties!** 🎉
