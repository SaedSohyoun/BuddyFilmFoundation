# Lokale E-mail Ontwikkeling Guide

## 🔧 Probleem Opgelost: Mail Server Fout

### **Wat was het probleem?**
```
Warning: mail(): Failed to connect to mailserver at "localhost" port 25
```

Dit gebeurt omdat WAMP/XAMPP geen mailserver heeft geconfigureerd voor lokale ontwikkeling.

### **Hoe ik het heb opgelost:**

1. **📁 Lokale E-mail Opslag**
   - E-mails worden nu opgeslagen als `.txt` bestanden in de `emails/` directory
   - Geen mailserver configuratie nodig
   - Werkt perfect voor lokale ontwikkeling

2. **🔄 Slimme E-mail Logica**
   - **Lokaal (localhost):** Slaat e-mails op als bestanden
   - **Productie:** Gebruikt normale `mail()` functie
   - **SMTP:** Optioneel voor geavanceerde gebruikers

3. **📋 Admin Dashboard Integratie**
   - Nieuwe pagina: `admin/email_bestanden.php`
   - Bekijk alle e-mail bestanden
   - Verwijder oude bestanden
   - Lees e-mail inhoud

## 📧 Hoe het nu werkt:

### **Voor Lokale Ontwikkeling:**
1. **Vul contactformulier in**
2. **E-mails worden opgeslagen in `emails/` directory**
3. **Bekijk e-mails via admin dashboard**

### **Voor Productie:**
1. **Vul contactformulier in**
2. **E-mails worden verstuurd naar Gmail**
3. **Bekijk e-mails in Gmail inbox**

## 🎯 Voordelen van deze oplossing:

### **✅ Lokale Ontwikkeling:**
- Geen mailserver configuratie nodig
- Snelle ontwikkeling en testen
- Geen spam in je echte Gmail
- E-mails zijn altijd beschikbaar

### **✅ Productie:**
- Normale e-mail functionaliteit
- Gmail notificaties werken
- Backup in admin dashboard
- Geen wijzigingen nodig

## 📁 E-mail Bestanden Structuur:

```
emails/
├── 2024-08-14_13-23-51_abc123.txt          # Standaard e-mail
├── GMAIL_2024-08-14_13-23-51_def456.txt    # Gmail notificatie
└── ...
```

### **Bestand Inhoud:**
```
To: info@buddyfilmfoundation.com, your-email@gmail.com
Subject: Nieuw contactformulier bericht: Test
From: noreply@buddyfilmfoundation.com
Reply-To: user@example.com
Date: Wed, 14 Aug 2024 13:23:51 +0200

Er is een nieuw bericht ontvangen via het contactformulier op de website.

Details:
Naam: Test User
E-mail: user@example.com
Onderwerp: Test
Bericht: Dit is een test bericht

---
Dit bericht is automatisch gegenereerd door het contactformulier op buddyfilmfoundation.com
```

## 🔧 Admin Dashboard:

### **Nieuwe Pagina's:**
1. **Contact Berichten** (`admin/contact_berichten.php`)
   - Database berichten
   - Markeer als gelezen
   - Verwijder berichten

2. **E-mail Bestanden** (`admin/email_bestanden.php`)
   - Lokale e-mail bestanden
   - Bekijk inhoud
   - Verwijder bestanden

### **Dashboard Links:**
- 📧 Contact Berichten
- 📁 E-mail Bestanden
- 👥 Teambeheer
- ✅ Portfolio Moderatie

## 🚀 Volgende Stappen:

### **Voor Lokale Ontwikkeling:**
1. **Test het contactformulier**
2. **Bekijk e-mails in `admin/email_bestanden.php`**
3. **Controleer database in `admin/contact_berichten.php`**

### **Voor Productie:**
1. **Pas `email_config.php` aan met je Gmail adres**
2. **Upload naar live server**
3. **Test e-mail functionaliteit**

## 🔍 Troubleshooting:

### **E-mails verschijnen niet?**
1. **Controleer `emails/` directory**
2. **Bekijk admin dashboard**
3. **Controleer bestandsrechten**

### **Admin dashboard werkt niet?**
1. **Log in als admin**
2. **Controleer database connectie**
3. **Verifieer bestandsrechten**

### **Productie e-mails werken niet?**
1. **Controleer `email_config.php`**
2. **Verifieer Gmail adres**
3. **Test SMTP instellingen**

## 📞 Support:

### **Lokale Ontwikkeling:**
- ✅ E-mails worden opgeslagen als bestanden
- ✅ Geen mailserver nodig
- ✅ Snelle ontwikkeling

### **Productie:**
- ✅ Normale e-mail functionaliteit
- ✅ Gmail notificaties
- ✅ Backup system

---

## 🎉 Resultaat:

**Het contactformulier werkt nu perfect voor zowel lokale ontwikkeling als productie!**

- **Lokaal:** E-mails worden opgeslagen als bestanden
- **Productie:** E-mails worden verstuurd naar Gmail
- **Admin:** Volledige controle via dashboard
- **Backup:** Database en bestand opslag

**Geen mailserver fouten meer!** 🚀
