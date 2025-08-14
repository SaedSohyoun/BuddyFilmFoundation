# NPO Video Thumbnail Systeem - Gebruikersgids

## 📋 Overzicht

Het NPO Video Thumbnail systeem vervangt de gewone knoppen voor NPO video's met mooie thumbnail afbeeldingen. Dit zorgt ervoor dat bezoekers direct kunnen zien waar de video over gaat voordat ze erop klikken.

## 🎯 Voordelen

- **Visuele aantrekkelijkheid**: Thumbnails zijn veel aantrekkelijker dan gewone knoppen
- **Betere gebruikerservaring**: Bezoekers weten direct waar de video over gaat
- **Professionele uitstraling**: Geeft je website een meer professionele look
- **Hogere klikfrequentie**: Mensen klikken eerder op een aantrekkelijke thumbnail

## 🔧 Hoe het werkt

### Voor Bezoekers
1. **Met Thumbnail**: Als er een thumbnail is geüpload, zie je een mooie afbeelding met een play-knop overlay
2. **Zonder Thumbnail**: Als er geen thumbnail is, zie je een standaard gradient achtergrond met een play-icoon
3. **Hover Effect**: Bij het over de thumbnail bewegen met je muis, zie je een mooie animatie

### Voor Admins
1. **Bij het toevoegen van nieuwe video's**: Als je een NPO link invoert, verschijnt automatisch een thumbnail upload veld
2. **Bij het bewerken van video's**: Je kunt bestaande thumbnails bekijken en nieuwe uploaden
3. **Automatische validatie**: Alleen afbeeldingen (JPG, PNG, GIF, WebP) worden geaccepteerd

## 📁 Bestanden die zijn aangepast

### Frontend Pagina's
- `casting.php` - Casting video's pagina
- `production.php` - Production video's pagina  
- `foundation.php` - Foundation video's pagina

### Admin Pagina's
- `admin/voeg_video_toe.php` - Video toevoegen formulier
- `admin/bewerk_video.php` - Video bewerken formulier

### Database
- `videos` tabel heeft al een `npo_image` veld

### Upload Directory
- `uploads/npo_thumbnails/` - Nieuwe directory voor thumbnail afbeeldingen

## 🎨 CSS Styling

Het systeem gebruikt moderne CSS met:
- **Responsive design**: Werkt op alle schermformaten
- **Smooth animaties**: Hover effecten en transitions
- **Gradient fallbacks**: Mooie standaard achtergrond als er geen thumbnail is
- **Play overlay**: Duidelijke play-knop die verschijnt bij hover

## 📱 Responsive Design

De thumbnails passen zich automatisch aan aan verschillende schermformaten:
- **Desktop**: Volledige thumbnail weergave
- **Tablet**: Aangepaste grootte voor touch interfaces
- **Mobile**: Geoptimaliseerd voor kleine schermen

## 🔒 Beveiliging

- **Bestandstype validatie**: Alleen afbeeldingen toegestaan
- **Veilige bestandsnamen**: Unieke namen om conflicten te voorkomen
- **Upload directory beveiliging**: Bestanden worden veilig opgeslagen
- **XSS bescherming**: Alle output wordt geëscaped

## 📏 Aanbevolen Afbeeldingsformaten

Voor de beste resultaten:
- **Formaat**: 400x225 pixels (16:9 aspect ratio)
- **Bestandstypen**: JPG, PNG, GIF, WebP
- **Bestandsgrootte**: Maximaal 2MB
- **Kwaliteit**: Hoog contrast, duidelijke afbeeldingen

## 🚀 Gebruik

### Als Admin - Nieuwe Video Toevoegen
1. Ga naar Admin Dashboard
2. Klik op "Video Toevoegen"
3. Vul de video informatie in
4. **Voor NPO video's**: Upload een thumbnail afbeelding
5. Klik op "Video Toevoegen"

### Als Admin - Video Bewerken
1. Ga naar de video pagina (Casting/Production/Foundation)
2. Klik op "Edit" bij de gewenste video
3. **Voor NPO video's**: Upload een nieuwe thumbnail of bekijk de huidige
4. Klik op "Opslaan"

### Als Bezoeker
1. Ga naar een video pagina (Casting/Production/Foundation)
2. Bekijk de mooie thumbnails in plaats van gewone knoppen
3. Hover over de thumbnails voor mooie effecten
4. Klik op een thumbnail om de NPO video te bekijken

## 🔧 Technische Details

### Database Structuur
```sql
ALTER TABLE videos ADD COLUMN npo_image VARCHAR(255) NULL;
```

### Upload Directory
```
uploads/
└── npo_thumbnails/
    ├── npo_1234567890_abc123.jpg
    ├── npo_1234567891_def456.png
    └── ...
```

### Bestandsnaam Conventie
- Prefix: `npo_`
- Timestamp: Unix timestamp
- Unieke ID: `uniqid()`
- Extensie: Originele bestandsextensie

## 🐛 Troubleshooting

### Thumbnail wordt niet getoond
1. Controleer of de afbeelding correct is geüpload
2. Controleer of het bestandspad correct is
3. Controleer of de afbeelding toegankelijk is

### Upload werkt niet
1. Controleer of de upload directory bestaat
2. Controleer of de directory schrijfrechten heeft
3. Controleer of het bestandstype wordt ondersteund

### CSS styling werkt niet
1. Controleer of de CSS correct is geladen
2. Controleer of er geen conflicten zijn met andere styles
3. Controleer of de browser CSS ondersteunt

## 📈 Toekomstige Verbeteringen

Mogelijke uitbreidingen:
- **Automatische thumbnail generatie** van NPO video's
- **Meerdere thumbnail formaten** voor verschillende schermformaten
- **Thumbnail caching** voor betere prestaties
- **Bulk thumbnail upload** voor meerdere video's tegelijk
- **Thumbnail editing tools** in de admin interface

## 📞 Support

Voor vragen of problemen:
1. Controleer eerst deze gids
2. Test de functionaliteit in verschillende browsers
3. Controleer de server logs voor foutmeldingen
4. Neem contact op met de ontwikkelaar

---

**Laatste update**: December 2024  
**Versie**: 1.0  
**Compatibiliteit**: PHP 7.4+, MySQL 5.7+
