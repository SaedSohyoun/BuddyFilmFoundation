# Portfolio Moderatie Systeem - Instructies

## 🎯 Overzicht

Het portfolio moderatie systeem zorgt ervoor dat filmmaker portfolios eerst door een admin worden gecontroleerd voordat ze online gaan. Dit voorkomt ongepaste content en zorgt voor kwaliteitscontrole.

## 🔧 Installatie

### 1. Database Update
Voer eerst de database update uit:

```sql
-- Voer dit uit in je database
source database_update.sql;
```

Of voer de SQL handmatig uit:

```sql
-- Voeg portfolio status en moderatie velden toe aan gebruikers tabel
ALTER TABLE gebruikers 
ADD COLUMN portfolio_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending' AFTER stad,
ADD COLUMN portfolio_moderatie_datum TIMESTAMP NULL DEFAULT NULL AFTER portfolio_status,
ADD COLUMN portfolio_moderatie_opmerking TEXT NULL AFTER portfolio_moderatie_datum,
ADD COLUMN portfolio_laatste_wijziging TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER portfolio_moderatie_opmerking;

-- Maak een moderatie log tabel aan
CREATE TABLE IF NOT EXISTS portfolio_moderatie_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filmmaker_id INT NOT NULL,
    admin_id INT NOT NULL,
    actie ENUM('approved', 'rejected', 'pending') NOT NULL,
    opmerking TEXT NULL,
    datum TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_filmmaker (filmmaker_id),
    INDEX idx_admin (admin_id),
    INDEX idx_datum (datum)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Voeg index toe voor snellere queries
CREATE INDEX idx_portfolio_status ON gebruikers(portfolio_status);
CREATE INDEX idx_portfolio_moderatie_datum ON gebruikers(portfolio_moderatie_datum);
```

### 2. Bestaande Filmmakers
Voor bestaande filmmakers kun je kiezen om ze automatisch goed te keuren:

```sql
-- Optioneel: Keur alle bestaande filmmakers goed
UPDATE gebruikers SET portfolio_status = 'approved' WHERE rol = 'filmmaker' AND portfolio_status = 'pending';
```

## 📋 Hoe het Werkt

### Voor Filmmakers

1. **Portfolio Bewerken**: Wanneer een filmmaker zijn profiel bewerkt, wordt de status automatisch op 'pending' gezet
2. **Status Indicator**: Filmmakers zien een status indicator op hun dashboard:
   - 🟡 **Pending**: Wacht op goedkeuring
   - 🟢 **Approved**: Goedgekeurd en zichtbaar
   - 🔴 **Rejected**: Afgewezen met opmerkingen

3. **Feedback**: Bij afwijzing krijgen filmmakers te zien waarom hun portfolio is afgewezen

### Voor Admins

1. **Moderatie Pagina**: Ga naar `admin/portfolio_moderatie.php`
2. **Portfolio Overzicht**: Zie alle portfolios die moderatie nodig hebben
3. **Goedkeuren/Afwijzen**: Klik op de knoppen om portfolios goed te keuren of af te wijzen
4. **Opmerkingen**: Geef feedback bij afwijzing
5. **Log**: Alle moderatie acties worden gelogd

### Voor Bezoekers

1. **Alleen Goedgekeurde Portfolios**: Alleen portfolios met status 'approved' zijn zichtbaar
2. **Geen Pending Content**: Bezoekers zien geen portfolios die nog in moderatie zijn

## 🎨 Nieuwe Bestanden

### 1. `admin/portfolio_moderatie.php`
- Moderatie interface voor admins
- Overzicht van alle portfolios
- Goedkeuren/afwijzen functionaliteit
- Opmerkingen systeem

### 2. `database_update.sql`
- Database schema updates
- Nieuwe tabellen en velden

### 3. Aangepaste Bestanden

#### `filmmaker/dashboard.php`
- Status indicator toegevoegd
- Automatische 'pending' status bij wijzigingen
- Feedback weergave

#### `filmmakers.php`
- Filter op alleen goedgekeurde portfolios
- Geen pending content zichtbaar

#### `filmmaker_detail.php`
- Controle op portfolio status
- Afgewezen portfolios niet toegankelijk

#### `admin/dashboard.php`
- Link naar moderatie pagina toegevoegd

## 🔍 Database Structuur

### Nieuwe Velden in `gebruikers` tabel:

- `portfolio_status`: ENUM('pending', 'approved', 'rejected')
- `portfolio_moderatie_datum`: TIMESTAMP
- `portfolio_moderatie_opmerking`: TEXT
- `portfolio_laatste_wijziging`: TIMESTAMP

### Nieuwe Tabel `portfolio_moderatie_log`:

- Log van alle moderatie acties
- Wie heeft wat gemodereerd
- Wanneer en waarom

## 🚀 Workflow

### 1. Filmmaker maakt/bewerkt portfolio
```
Filmmaker bewerkt profiel → Status wordt 'pending' → Admin krijgt notificatie
```

### 2. Admin modereert portfolio
```
Admin bekijkt portfolio → Besluit goedkeuren/afwijzen → Status wordt bijgewerkt
```

### 3. Resultaat
```
Goedgekeurd → Portfolio zichtbaar voor bezoekers
Afgewezen → Filmmaker krijgt feedback en kan aanpassen
```

## 📊 Status Betekenis

- **Pending**: Portfolio wacht op moderatie
- **Approved**: Portfolio is goedgekeurd en zichtbaar
- **Rejected**: Portfolio is afgewezen, filmmaker krijgt feedback

## 🔧 Configuratie Opties

### Automatische Goedkeuring (Optioneel)
Als je automatische goedkeuring wilt voor bepaalde filmmakers:

```sql
-- Keur specifieke filmmakers automatisch goed
UPDATE gebruikers SET portfolio_status = 'approved' 
WHERE gebruikersnaam IN ('trusted_filmmaker1', 'trusted_filmmaker2');
```

### Email Notificaties (Toekomstig)
Je kunt email notificaties toevoegen voor:
- Admins wanneer nieuwe portfolios wachten op moderatie
- Filmmakers wanneer hun portfolio is goedgekeurd/afgewezen

## 🛡️ Beveiliging

- Alleen admins kunnen modereren
- Alle acties worden gelogd
- Geen directe toegang tot afgewezen portfolios
- Input validatie en sanitization

## 📱 Gebruikerservaring

### Filmmakers
- Duidelijke status indicator
- Feedback bij afwijzing
- Eenvoudig herindienen na aanpassingen

### Admins
- Overzichtelijk moderatie interface
- Sorteer op prioriteit (pending eerst)
- Snelle goedkeuring/afwijzing

### Bezoekers
- Alleen kwaliteitscontent zien
- Geen verwarring door incomplete portfolios

## 🔄 Onderhoud

### Dagelijkse Controles
- Check voor nieuwe pending portfolios
- Moderatie binnen 24 uur

### Maandelijkse Reviews
- Bekijk moderatie statistieken
- Evalueer moderatie criteria

### Log Analyse
- Bekijk moderatie patterns
- Identificeer veelvoorkomende afwijzingen

## 🎯 Voordelen

1. **Kwaliteitscontrole**: Alleen goedgekeurde content online
2. **Beveiliging**: Voorkom ongepaste content
3. **Professionaliteit**: Zorgt voor consistente kwaliteit
4. **Feedback**: Filmmakers krijgen constructieve feedback
5. **Transparantie**: Duidelijke status voor alle gebruikers

## 🚨 Troubleshooting

### Portfolio niet zichtbaar?
- Controleer of status 'approved' is
- Check of filmmaker rol correct is

### Moderatie werkt niet?
- Controleer database velden
- Verifieer admin rechten
- Check error logs

### Performance issues?
- Database indexes zijn toegevoegd
- Queries zijn geoptimaliseerd
- Caching kan worden toegevoegd

---

**🎬 Het moderatie systeem is nu actief! Filmmakers kunnen hun portfolios bewerken, maar alleen goedgekeurde content wordt getoond aan bezoekers.**

