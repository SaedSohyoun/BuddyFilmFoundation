<?php
include '../inc/connectie.php';
include '../inc/header.php';

// ✅ Voeg jezelf (Saed) eenmalig toe als admin als je nog niet bestaat
$admin_gebruiker = 'saed';
$admin_naam = 'Saed Admin';
$admin_wachtwoord = password_hash('wachtwoord123', PASSWORD_DEFAULT);
$check = $conn->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = ?");
$check->bind_param("s", $admin_gebruiker);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {
    $voegAdminToe = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord, naam, rol) VALUES (?, ?, ?, 'admin')");
    $voegAdminToe->bind_param("sss", $admin_gebruiker, $admin_wachtwoord, $admin_naam);
    $voegAdminToe->execute();
    $voegAdminToe->close();
}
$check->close();

// Alleen admin toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$fout = $succes = "";

// Verwerken van toevoegen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toevoegen'])) {
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    $naam = trim($_POST['naam']);
    $rol = 'filmmaker';
    $story = $_POST['story'] ?? '';
    $werkervaring = $_POST['werkervaring'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefoon = $_POST['telefoon'] ?? '';

    if ($gebruikersnaam && $wachtwoord && $naam) {
        $stmt = $conn->prepare("INSERT INTO gebruikers (gebruikersnaam, wachtwoord, naam, rol, story, werkervaring, email, telefoon) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $gebruikersnaam, $wachtwoord, $naam, $rol, $story, $werkervaring, $email, $telefoon);
        if ($stmt->execute()) {
            $succes = "Filmmaker succesvol toegevoegd.";
        } else {
            $fout = "Fout bij toevoegen.";
        }
        $stmt->close();
    } else {
        $fout = "Vul alle verplichte velden in.";
    }
}

// Verwerken van verwijderen
if (isset($_GET['verwijder'])) {
    $id = intval($_GET['verwijder']);
    $stmt = $conn->prepare("DELETE FROM gebruikers WHERE id = ? AND rol = 'filmmaker'");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $succes = "Filmmaker verwijderd.";
    } else {
        $fout = "Kon filmmaker niet verwijderen.";
    }
    $stmt->close();
}

// Verwerken van bewerken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bewerken'])) {
    $id = intval($_POST['id']);
    $gebruikersnaam = trim($_POST['gebruikersnaam']);
    $naam = trim($_POST['naam']);
    $rol = $_POST['rol'];
    $story = $_POST['story'] ?? '';
    $werkervaring = $_POST['werkervaring'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefoon = $_POST['telefoon'] ?? '';

    if (!empty($_POST['wachtwoord'])) {
        $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE gebruikers SET gebruikersnaam = ?, naam = ?, rol = ?, story = ?, werkervaring = ?, email = ?, telefoon = ?, wachtwoord = ? WHERE id = ?");
        $stmt->bind_param("ssssssssi", $gebruikersnaam, $naam, $rol, $story, $werkervaring, $email, $telefoon, $wachtwoord, $id);
    } else {
        $stmt = $conn->prepare("UPDATE gebruikers SET gebruikersnaam = ?, naam = ?, rol = ?, story = ?, werkervaring = ?, email = ?, telefoon = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $gebruikersnaam, $naam, $rol, $story, $werkervaring, $email, $telefoon, $id);
    }
    if ($stmt->execute()) {
        $succes = "Filmmaker succesvol bijgewerkt.";
    } else {
        $fout = "Fout bij bijwerken.";
    }
    $stmt->close();
}

// Ophalen filmmakers
$result = $conn->query("SELECT id, gebruikersnaam, naam, rol, story, werkervaring, email, telefoon FROM gebruikers WHERE rol = 'filmmaker' OR rol = 'admin' ORDER BY id ASC");
?>

<style>
body {
    background-color: black;
    color: white;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    font-size: 1rem;
    line-height: 1.5;
}

/* Admin Container */
.admin-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 2rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(0,130,137,0.08)" stroke-width="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
}

.page-header-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.page-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.page-subtitle {
    color: #ccc;
    font-size: 1.1rem;
    font-weight: 300;
}

/* Alerts */
.alert {
    border-radius: 10px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    border: none;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.2) 0%, rgba(40, 167, 69, 0.1) 100%);
    border-left: 4px solid rgba(40, 167, 69, 1);
    color: #d4edda;
}

.alert-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.2) 0%, rgba(220, 53, 69, 0.1) 100%);
    border-left: 4px solid rgba(220, 53, 69, 1);
    color: #f8d7da;
}

/* Form Sections */
.form-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 0.5rem;
}

/* Form Controls */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    color: white;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control, .form-select {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus, .form-select:focus {
    background-color: #2a2a2a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
    outline: none;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

/* Buttons */
.btn {
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 1) 0%, rgba(30, 120, 50, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, rgba(30, 120, 50, 1) 0%, rgba(40, 167, 69, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.btn-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 1) 0%, rgba(180, 40, 50, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, rgba(180, 40, 50, 1) 0%, rgba(220, 53, 69, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

/* Table Styles */
.table-container {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    overflow-x: auto;
}

.table {
    color: white;
    background-color: transparent;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.table th {
    background-color: #2a2a2a;
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    border: 1px solid #444;
    text-align: center;
    font-size: 0.9rem;
}

.table td {
    padding: 1rem;
    border: 1px solid #444;
    background-color: #1a1a1a;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: #2a2a2a;
}

.table .form-control, .table .form-select {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    font-size: 0.9rem;
    padding: 0.5rem;
}

.table .form-control:focus, .table .form-select:focus {
    border-color: rgba(0, 130, 137, 1);
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
}

/* Work Experience Dropdown */
.work-exp-container {
    position: relative;
}

.work-exp-toggle {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
}

.work-exp-toggle:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
}

.work-exp-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 8px;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    display: none;
}

.work-exp-dropdown label {
    display: block;
    padding: 0.5rem 1rem;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-bottom: 1px solid #444;
}

.work-exp-dropdown label:hover {
    background-color: #333;
}

.work-exp-dropdown input[type="checkbox"] {
    margin-right: 0.5rem;
}

.selected-tags {
    margin-bottom: 1rem;
}

.selected-tag {
    display: inline-block;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    margin: 0.2rem;
    position: relative;
}

.selected-tag .remove-tag {
    margin-left: 0.5rem;
    cursor: pointer;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .table-container {
        overflow-x: auto;
    }
    
    .table {
        min-width: 1000px;
    }
}

@media (max-width: 768px) {
    .admin-container {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .form-section, .table-container {
        padding: 1.5rem;
    }
    
    .btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.8rem;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">Beheer Filmmakers</h1>
            <p class="page-subtitle">Beheer filmmaker accounts en profielen</p>
        </div>
    </div>

    <!-- Alerts -->
    <?php if ($fout): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
    <?php endif; ?>
    <?php if ($succes): ?>
    <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <!-- Add New Filmmaker Section -->
    <div class="form-section">
        <h2 class="section-title">Nieuwe Filmmaker Toevoegen</h2>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Gebruikersnaam *</label>
                        <input type="text" name="gebruikersnaam" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Naam *</label>
                        <input type="text" name="naam" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Wachtwoord *</label>
                        <input type="password" name="wachtwoord" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Telefoon</label>
                        <input type="text" name="telefoon" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Story</label>
                        <textarea name="story" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Werkervaring</label>
                <div class="work-exp-container">
                    <div class="selected-tags" id="selected-werkervaring"></div>
                    <button type="button" id="toggleDropdown" class="work-exp-toggle">+ Selecteer Werkervaring</button>
                    <div id="werkervaring-dropdown" class="work-exp-dropdown">
                        <label><input type="checkbox" value="1e AC"> 1e AC</label>
                        <label><input type="checkbox" value="2e AC"> 2e AC</label>
                        <label><input type="checkbox" value="3D-artiest"> 3D-artiest</label>
                        <label><input type="checkbox" value="Acteur"> Acteur</label>
                        <label><input type="checkbox" value="Acteurcoach"> Acteurcoach</label>
                        <label><input type="checkbox" value="Actrice"> Actrice</label>
                        <label><input type="checkbox" value="Activist"> Activist</label>
                        <label><input type="checkbox" value="Administrateur"> Administrateur</label>
                        <label><input type="checkbox" value="Animator"> Animator</label>
                        <label><input type="checkbox" value="Architect"> Architect</label>
                        <label><input type="checkbox" value="Artdirector"> Artdirector</label>
                        <label><input type="checkbox" value="Assistent artdirector"> Assistent artdirector</label>
                        <label><input type="checkbox" value="Assistent-regisseur"> Assistent-regisseur</label>
                        <label><input type="checkbox" value="Audiovisueel technicus"> Audiovisueel technicus</label>
                        <label><input type="checkbox" value="Beginnende acteur"> Beginnende acteur</label>
                        <label><input type="checkbox" value="Beginnende actrice"> Beginnende actrice</label>
                        <label><input type="checkbox" value="Beeldhouwer"> Beeldhouwer</label>
                        <label><input type="checkbox" value="Bliksemoperator"> Bliksemoperator</label>
                        <label><input type="checkbox" value="Businesscoach"> Businesscoach</label>
                        <label><input type="checkbox" value="Cameraman"> Cameraman</label>
                        <label><input type="checkbox" value="Coach"> Coach</label>
                        <label><input type="checkbox" value="Colorist"> Colorist</label>
                        <label><input type="checkbox" value="Communicatiecoach"> Communicatiecoach</label>
                        <label><input type="checkbox" value="Conceptueel kunstenaar"> Conceptueel kunstenaar</label>
                        <label><input type="checkbox" value="Contentmaker"> Contentmaker</label>
                        <label><input type="checkbox" value="Copywriter"> Copywriter</label>
                        <label><input type="checkbox" value="Creatief directeur"> Creatief directeur</label>
                        <label><input type="checkbox" value="Curator"> Curator</label>
                        <label><input type="checkbox" value="Danser"> Danser</label>
                        <label><input type="checkbox" value="Danschoreograaf"> Danschoreograaf</label>
                        <label><input type="checkbox" value="Datahandler"> Datahandler</label>
                        <label><input type="checkbox" value="Dichter"> Dichter</label>
                        <label><input type="checkbox" value="DIT (Digital Imaging Technician)"> DIT (Digital Imaging Technician)</label>
                        <label><input type="checkbox" value="DJ"> DJ</label>
                        <label><input type="checkbox" value="Documentaireregisseur"> Documentaireregisseur</label>
                        <label><input type="checkbox" value="Drone-operator"> Drone-operator</label>
                        <label><input type="checkbox" value="Extra"> Extra</label>
                        <label><input type="checkbox" value="Extra figurant"> Extra figurant</label>
                        <label><input type="checkbox" value="Filmcriticus"> Filmcriticus</label>
                        <label><input type="checkbox" value="Filmjournalist"> Filmjournalist</label>
                        <label><input type="checkbox" value="Fotograaf"> Fotograaf</label>
                        <label><input type="checkbox" value="Freerunner"> Freerunner</label>
                        <label><input type="checkbox" value="Geluidstechnicus"> Geluidstechnicus</label>
                        <label><input type="checkbox" value="Geluidsontwerper"> Geluidsontwerper</label>
                        <label><input type="checkbox" value="Goochelaar"> Goochelaar</label>
                        <label><input type="checkbox" value="Grafisch ontwerper"> Grafisch ontwerper</label>
                        <label><input type="checkbox" value="Graffitischrijver"> Graffitischrijver</label>
                        <label><input type="checkbox" value="Haarstylist"> Haarstylist</label>
                        <label><input type="checkbox" value="Illustrator"> Illustrator</label>
                        <label><input type="checkbox" value="Influencer"> Influencer</label>
                        <label><input type="checkbox" value="Interieurontwerper"> Interieurontwerper</label>
                        <label><input type="checkbox" value="Journalist"> Journalist</label>
                        <label><input type="checkbox" value="Key Grip"> Key Grip</label>
                        <label><input type="checkbox" value="Kindacteur"> Kindacteur</label>
                        <label><input type="checkbox" value="Kindactrice"> Kindactrice</label>
                        <label><input type="checkbox" value="Kleermaker"> Kleermaker</label>
                        <label><input type="checkbox" value="Komiek"> Komiek</label>
                        <label><input type="checkbox" value="Kostuumontwerper"> Kostuumontwerper</label>
                        <label><input type="checkbox" value="Kunstenaar"> Kunstenaar</label>
                        <label><input type="checkbox" value="Kunstdocent"> Kunstdocent</label>
                        <label><input type="checkbox" value="Manager creatieve marketingcommunicatie"> Manager creatieve marketingcommunicatie</label>
                        <label><input type="checkbox" value="Marketingmanager"> Marketingmanager</label>
                        <label><input type="checkbox" value="Model"> Model</label>
                        <label><input type="checkbox" value="Musical"> Musical</label>
                        <label><input type="checkbox" value="Muziekcomponist"> Muziekcomponist</label>
                        <label><input type="checkbox" value="Muziekdocent"> Muziekdocent</label>
                        <label><input type="checkbox" value="Muzikant"> Muzikant</label>
                        <label><input type="checkbox" value="Nederlands Leraar"> Nederlands Leraar</label>
                        <label><input type="checkbox" value="Officemanager"> Officemanager</label>
                        <label><input type="checkbox" value="Paardenruiter"> Paardenruiter</label>
                        <label><input type="checkbox" value="Pianist"> Pianist</label>
                        <label><input type="checkbox" value="Presentator"> Presentator</label>
                        <label><input type="checkbox" value="Producent"> Producent</label>
                        <label><input type="checkbox" value="Productieassistent"> Productieassistent</label>
                        <label><input type="checkbox" value="Productiecoördinator"> Productiecoördinator</label>
                        <label><input type="checkbox" value="Productiegeluidstechnicus">Productiegeluidstechnicus</label>
                        <label><input type="checkbox" value="Productieontwerper"> Productieontwerper</label>
                        <label><input type="checkbox" value="Psycholoog"> Psycholoog</label>
                        <label><input type="checkbox" value="Radiopresentator"> Radiopresentator</label>
                        <label><input type="checkbox" value="Rapper"> Rapper</label>
                        <label><input type="checkbox" value="Regieassistent"> Regieassistent</label>
                        <label><input type="checkbox" value="Regisseur"> Regisseur</label>
                        <label><input type="checkbox" value="Rekwisietontwerper"> Rekwisietontwerper</label>
                        <label><input type="checkbox" value="Scenarioschrijver"> Scenarioschrijver</label>
                        <label><input type="checkbox" value="Schermmediabeoefenaar"> Schermmediabeoefenaar</label>
                        <label><input type="checkbox" value="Schilder"> Schilder</label>
                        <label><input type="checkbox" value="Schrijver"> Schrijver</label>
                        <label><input type="checkbox" value="Setontwerper"> Setontwerper</label>
                        <label><input type="checkbox" value="Spreker"> Spreker</label>
                        <label><input type="checkbox" value="Stemacteur"> Stemacteur</label>
                        <label><input type="checkbox" value="Stemactrice"> Stemactrice</label>
                        <label><input type="checkbox" value="Studiomanager"> Studiomanager</label>
                        <label><input type="checkbox" value="Theater"> Theater</label>
                        <label><input type="checkbox" value="Theaterdocent"> Theaterdocent</label>
                        <label><input type="checkbox" value="Theatermaker"> Theatermaker</label>
                        <label><input type="checkbox" value="Toneelontwerper"> Toneelontwerper</label>
                        <label><input type="checkbox" value="Uitvoerend kunstenaar"> Uitvoerend kunstenaar</label>
                        <label><input type="checkbox" value="Uitvoerend producent"> Uitvoerend producent</label>
                        <label><input type="checkbox" value="Vertaler"> Vertaler</label>
                        <label><input type="checkbox" value="VFX-artiest"> VFX-artiest</label>
                        <label><input type="checkbox" value="Video-editor"> Video-editor</label>
                        <label><input type="checkbox" value="Videograaf"> Videograaf</label>
                        <label><input type="checkbox" value="Videojournalist"> Videojournalist</label>
                        <label><input type="checkbox" value="Visagist"> Visagist</label>
                        <label><input type="checkbox" value="Zanger"> Zanger</label>
                        <label><input type="checkbox" value="D.O.P. (Director of Photography)"> D.O.P. (Director of Photography)</label>
                    </div>
                    <input type="hidden" name="werkervaring" id="werkervaring-input" value="">
                </div>
            </div>
            <button type="submit" name="toevoegen" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>

    <!-- Current Filmmakers Section -->
    <div class="table-container">
        <h2 class="section-title">Huidige Filmmakers</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Gebruikersnaam</th>
                    <th>Naam</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Story</th>
                    <th>Werkervaring</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <td style="color: rgba(0, 130, 137, 1); font-weight: bold;"><?= $row['id'] ?></td>
                        <td><input type="text" name="gebruikersnaam" class="form-control" value="<?= htmlspecialchars($row['gebruikersnaam']) ?>" required></td>
                        <td><input type="text" name="naam" class="form-control" value="<?= htmlspecialchars($row['naam']) ?>" required></td>
                        <td>
                            <select name="rol" class="form-select" required>
                                <option value="filmmaker" <?= $row['rol'] === 'filmmaker' ? 'selected' : '' ?>>Filmmaker</option>
                                <option value="admin" <?= $row['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </td>
                        <td><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email'] ?? '') ?>"></td>
                        <td><input type="text" name="telefoon" class="form-control" value="<?= htmlspecialchars($row['telefoon'] ?? '') ?>"></td>
                        <td><textarea name="story" class="form-control" rows="3"><?= htmlspecialchars($row['story'] ?? '') ?></textarea></td>
                        <td><textarea name="werkervaring" class="form-control" rows="3"><?= htmlspecialchars($row['werkervaring'] ?? '') ?></textarea></td>
                        <td>
                            <input type="password" name="wachtwoord" class="form-control mb-2" placeholder="Nieuw wachtwoord (optioneel)">
                            <button type="submit" name="bewerken" class="btn btn-success btn-sm mb-2 w-100">Opslaan</button>
                            <a href="?verwijder=<?= $row['id'] ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Weet je zeker dat je deze filmmaker wilt verwijderen?');">Verwijder</a>
                        </td>
                    </form>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('toggleDropdown').addEventListener('click', function() {
    const dropdown = document.getElementById('werkervaring-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
});

const checkboxes = document.querySelectorAll('#werkervaring-dropdown input[type=checkbox]');
const selectedContainer = document.getElementById('selected-werkervaring');
const hiddenInput = document.getElementById('werkervaring-input');

function updateSelected() {
    selectedContainer.innerHTML = '';
    let selectedValues = [];
    checkboxes.forEach(cb => {
        if (cb.checked) {
            selectedValues.push(cb.value);
            const span = document.createElement('span');
            span.className = 'selected-tag';
            span.innerHTML = cb.value + '<span class="remove-tag" onclick="removeTag(\'' + cb.value + '\')">×</span>';
            selectedContainer.appendChild(span);
        }
    });
    hiddenInput.value = selectedValues.join(',');
}

function removeTag(value) {
    const checkbox = document.querySelector('#werkervaring-dropdown input[value="' + value + '"]');
    if (checkbox) {
        checkbox.checked = false;
        updateSelected();
    }
}

checkboxes.forEach(cb => {
    cb.addEventListener('change', updateSelected);
});

// Klik buiten dropdown sluit dropdown
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('werkervaring-dropdown');
    const button = document.getElementById('toggleDropdown');
    if (!dropdown.contains(event.target) && event.target !== button) {
        dropdown.style.display = 'none';
    }
});

// Bij laden evt. al geselecteerde werkervaring tonen (bij bewerken)
window.addEventListener('load', () => {
    const initVal = hiddenInput.value;
    if (initVal) {
        const values = initVal.split(',');
        checkboxes.forEach(cb => {
            cb.checked = values.includes(cb.value);
        });
        updateSelected();
    }
});
</script>

<?php include '../inc/footer.php'; ?>