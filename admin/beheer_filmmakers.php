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
    font-family: 'Segoe UI', sans-serif;
}

h1,
h2 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

/* Zwarte achtergrond voor het formulier */
form {
    background-color: black;
    padding: 15px;
    border: 1px solid white;
    border-radius: 0.5rem;
    color: white;
}

/* Input en select stijlen */
.form-control,
.form-select {
    background-color: #2a2a2a;
    color: white;
    border: 1px solid white;
    border-radius: 0.25rem;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

/* Buttons */
.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    border-color: rgba(0, 130, 137, 1);
}

.btn-primary:hover {
    background-color: rgba(0, 130, 137, 0.8);
    border-color: rgba(0, 130, 137, 0.8);
}

.btn-secondary {
    background-color: #444;
    border-color: #444;
    color: white;
}

.btn-secondary:hover {
    background-color: #666;
    border-color: #666;
    color: white;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Tabel basisstijl */
.table {
    color: white;
    background-color: #2a2a2a;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #ffffffff;
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffffff;
}

.alert-danger {
    background-color: #721c24;
    border-color: #f5c6cb;
}

.alert-success {
    background-color: #155724;
    border-color: #c3e6cb;
}

/* ───────────── EXTRA STIJLEN ───────────── */

/* Tabel-cellen en randen */
.table td,
.table th {
    border: 1px solid white;
    vertical-align: middle;
    background-color: #000;
}

/* Inputvelden en textarea's binnen de tabel */
.table .form-control,
.table .form-select,
.table textarea {
    background-color: #2a2a2a;
    color: white;
    border: 1px solid white;
}

.table .form-control::placeholder,
.table textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

/* Tekstgebieden binnen tabel netjes */
.table textarea {
    resize: vertical;
}

/* Responsive aanpassing */
@media (max-width: 768px) {
    .table {
        font-size: 14px;
    }

    .form-control,
    .form-select,
    textarea {
        font-size: 14px;
    }
}

/* ID kolom titel wit */
.table thead th {
    color: white;
    font-weight: bold;
    text-align: center;
    border: 1px solid white;
}
</style>
<div class="container my-4">
    <h1>Beheer Filmmakers</h1>

    <?php if ($fout): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
    <?php endif; ?>
    <?php if ($succes): ?>
    <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <h2>Nieuwe Filmmaker Toevoegen</h2>
    <form method="post" class="mb-4">
        <div class="mb-3">
            <label>Gebruikersnaam *</label>
            <input type="text" name="gebruikersnaam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Naam *</label>
            <input type="text" name="naam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Wachtwoord *</label>
            <input type="password" name="wachtwoord" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telefoon</label>
            <input type="text" name="telefoon" class="form-control">
        </div>
        <div class="mb-3">
            <label>Story</label>
            <textarea name="story" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3" style="position: relative;">
            <label>Werkervaring</label><br>
            <div id="werkervaring-container">
                <div id="selected-werkervaring" style="margin-bottom: 5px;"></div>
                <button type="button" id="toggleDropdown"
                    style="font-weight:bold; font-size: 16px; cursor: pointer; background-color:rgba(0, 130, 137, 1);">+</button>
                <div id="werkervaring-dropdown"
                    style="display:none; border:1px solid #ccc; max-height:150px; overflow-y:auto; margin-top:5px; padding:5px; background:#2a2a2a; position:absolute; z-index:100;">

                    <label><input type="checkbox" value="1e AC"> 1e AC</label><br>
                    <label><input type="checkbox" value="2e AC"> 2e AC</label><br>
                    <label><input type="checkbox" value="3D-artiest"> 3D-artiest</label><br>
                    <label><input type="checkbox" value="Acteur"> Acteur</label><br>
                    <label><input type="checkbox" value="Acteurcoach"> Acteurcoach</label><br>
                    <label><input type="checkbox" value="Actrice"> Actrice</label><br>
                    <label><input type="checkbox" value="Activist"> Activist</label><br>
                    <label><input type="checkbox" value="Administrateur"> Administrateur</label><br>
                    <label><input type="checkbox" value="Animator"> Animator</label><br>
                    <label><input type="checkbox" value="Architect"> Architect</label><br>
                    <label><input type="checkbox" value="Artdirector"> Artdirector</label><br>
                    <label><input type="checkbox" value="Assistent artdirector"> Assistent artdirector</label><br>
                    <label><input type="checkbox" value="Assistent-regisseur"> Assistent-regisseur</label><br>
                    <label><input type="checkbox" value="Audiovisueel technicus"> Audiovisueel technicus</label><br>
                    <label><input type="checkbox" value="Beginnende acteur"> Beginnende acteur</label><br>
                    <label><input type="checkbox" value="Beginnende actrice"> Beginnende actrice</label><br>
                    <label><input type="checkbox" value="Beeldhouwer"> Beeldhouwer</label><br>
                    <label><input type="checkbox" value="Bliksemoperator"> Bliksemoperator</label><br>
                    <label><input type="checkbox" value="Businesscoach"> Businesscoach</label><br>
                    <label><input type="checkbox" value="Cameraman"> Cameraman</label><br>
                    <label><input type="checkbox" value="Coach"> Coach</label><br>
                    <label><input type="checkbox" value="Colorist"> Colorist</label><br>
                    <label><input type="checkbox" value="Communicatiecoach"> Communicatiecoach</label><br>
                    <label><input type="checkbox" value="Conceptueel kunstenaar"> Conceptueel kunstenaar</label><br>
                    <label><input type="checkbox" value="Contentmaker"> Contentmaker</label><br>
                    <label><input type="checkbox" value="Copywriter"> Copywriter</label><br>
                    <label><input type="checkbox" value="Creatief directeur"> Creatief directeur</label><br>
                    <label><input type="checkbox" value="Curator"> Curator</label><br>
                    <label><input type="checkbox" value="Danser"> Danser</label><br>
                    <label><input type="checkbox" value="Danschoreograaf"> Danschoreograaf</label><br>
                    <label><input type="checkbox" value="Datahandler"> Datahandler</label><br>
                    <label><input type="checkbox" value="Dichter"> Dichter</label><br>
                    <label><input type="checkbox" value="DIT (Digital Imaging Technician)"> DIT (Digital Imaging
                        Technician)</label><br>
                    <label><input type="checkbox" value="DJ"> DJ</label><br>
                    <label><input type="checkbox" value="Documentaireregisseur"> Documentaireregisseur</label><br>
                    <label><input type="checkbox" value="Drone-operator"> Drone-operator</label><br>
                    <label><input type="checkbox" value="Extra"> Extra</label><br>
                    <label><input type="checkbox" value="Extra figurant"> Extra figurant</label><br>
                    <label><input type="checkbox" value="Filmcriticus"> Filmcriticus</label><br>
                    <label><input type="checkbox" value="Filmjournalist"> Filmjournalist</label><br>
                    <label><input type="checkbox" value="Fotograaf"> Fotograaf</label><br>
                    <label><input type="checkbox" value="Freerunner"> Freerunner</label><br>
                    <label><input type="checkbox" value="Geluidstechnicus"> Geluidstechnicus</label><br>
                    <label><input type="checkbox" value="Geluidsontwerper"> Geluidsontwerper</label><br>
                    <label><input type="checkbox" value="Goochelaar"> Goochelaar</label><br>
                    <label><input type="checkbox" value="Grafisch ontwerper"> Grafisch ontwerper</label><br>
                    <label><input type="checkbox" value="Graffitischrijver"> Graffitischrijver</label><br>
                    <label><input type="checkbox" value="Haarstylist"> Haarstylist</label><br>
                    <label><input type="checkbox" value="Illustrator"> Illustrator</label><br>
                    <label><input type="checkbox" value="Influencer"> Influencer</label><br>
                    <label><input type="checkbox" value="Interieurontwerper"> Interieurontwerper</label><br>
                    <label><input type="checkbox" value="Journalist"> Journalist</label><br>
                    <label><input type="checkbox" value="Key Grip"> Key Grip</label><br>
                    <label><input type="checkbox" value="Kindacteur"> Kindacteur</label><br>
                    <label><input type="checkbox" value="Kindactrice"> Kindactrice</label><br>
                    <label><input type="checkbox" value="Kleermaker"> Kleermaker</label><br>
                    <label><input type="checkbox" value="Komiek"> Komiek</label><br>
                    <label><input type="checkbox" value="Kostuumontwerper"> Kostuumontwerper</label><br>
                    <label><input type="checkbox" value="Kunstenaar"> Kunstenaar</label><br>
                    <label><input type="checkbox" value="Kunstdocent"> Kunstdocent</label><br>
                    <label><input type="checkbox" value="Manager creatieve marketingcommunicatie"> Manager creatieve
                        marketingcommunicatie</label><br>
                    <label><input type="checkbox" value="Marketingmanager"> Marketingmanager</label><br>
                    <label><input type="checkbox" value="Model"> Model</label><br>
                    <label><input type="checkbox" value="Musical"> Musical</label><br>
                    <label><input type="checkbox" value="Muziekcomponist"> Muziekcomponist</label><br>
                    <label><input type="checkbox" value="Muziekdocent"> Muziekdocent</label><br>
                    <label><input type="checkbox" value="Muzikant"> Muzikant</label><br>
                    <label><input type="checkbox" value="Nederlands Leraar"> Nederlands Leraar</label><br>
                    <label><input type="checkbox" value="Officemanager"> Officemanager</label><br>
                    <label><input type="checkbox" value="Paardenruiter"> Paardenruiter</label><br>
                    <label><input type="checkbox" value="Pianist"> Pianist</label><br>
                    <label><input type="checkbox" value="Presentator"> Presentator</label><br>
                    <label><input type="checkbox" value="Producent"> Producent</label><br>
                    <label><input type="checkbox" value="Productieassistent"> Productieassistent</label><br>
                    <label><input type="checkbox" value="Productiecoördinator"> Productiecoördinator</label><br>
                    <label><input type="checkbox"
                            value="Productiegeluidstechnicus">Productiegeluidstechnicus</label><br>
                    <label><input type="checkbox" value="Productieontwerper"> Productieontwerper</label><br>
                    <label><input type="checkbox" value="Psycholoog"> Psycholoog</label><br>
                    <label><input type="checkbox" value="Radiopresentator"> Radiopresentator</label><br>
                    <label><input type="checkbox" value="Rapper"> Rapper</label><br>
                    <label><input type="checkbox" value="Regieassistent"> Regieassistent</label><br>
                    <label><input type="checkbox" value="Regisseur"> Regisseur</label><br>
                    <label><input type="checkbox" value="Rekwisietontwerper"> Rekwisietontwerper</label><br>
                    <label><input type="checkbox" value="Scenarioschrijver"> Scenarioschrijver</label><br>
                    <label><input type="checkbox" value="Schermmediabeoefenaar"> Schermmediabeoefenaar</label><br>
                    <label><input type="checkbox" value="Schilder"> Schilder</label><br>
                    <label><input type="checkbox" value="Schrijver"> Schrijver</label><br>
                    <label><input type="checkbox" value="Setontwerper"> Setontwerper</label><br>
                    <label><input type="checkbox" value="Spreker"> Spreker</label><br>
                    <label><input type="checkbox" value="Stemacteur"> Stemacteur</label><br>
                    <label><input type="checkbox" value="Stemactrice"> Stemactrice</label><br>
                    <label><input type="checkbox" value="Studiomanager"> Studiomanager</label><br>
                    <label><input type="checkbox" value="Theater"> Theater</label><br>
                    <label><input type="checkbox" value="Theaterdocent"> Theaterdocent</label><br>
                    <label><input type="checkbox" value="Theatermaker"> Theatermaker</label><br>
                    <label><input type="checkbox" value="Toneelontwerper"> Toneelontwerper</label><br>
                    <label><input type="checkbox" value="Uitvoerend kunstenaar"> Uitvoerend kunstenaar</label><br>
                    <label><input type="checkbox" value="Uitvoerend producent"> Uitvoerend producent</label><br>
                    <label><input type="checkbox" value="Vertaler"> Vertaler</label><br>
                    <label><input type="checkbox" value="VFX-artiest"> VFX-artiest</label><br>
                    <label><input type="checkbox" value="Video-editor"> Video-editor</label><br>
                    <label><input type="checkbox" value="Videograaf"> Videograaf</label><br>
                    <label><input type="checkbox" value="Videojournalist"> Videojournalist</label><br>
                    <label><input type="checkbox" value="Visagist"> Visagist</label><br>
                    <label><input type="checkbox" value="Zanger"> Zanger</label><br>
                    <label><input type="checkbox" value="D.O.P. (Director of Photography)"> D.O.P. (Director of
                        Photography)</label><br>


                </div>
                <input type="hidden" name="werkervaring" id="werkervaring-input"
                    value="<?php echo isset($bewerkenWerkervaring) ? htmlspecialchars($bewerkenWerkervaring) : ''; ?>">
            </div>
        </div>

        <button type="submit" name="toevoegen" class="btn btn-primary">Toevoegen</button>
    </form>

    <h2>Huidige Filmmakers</h2>
    <table class="table table-striped align-middle">
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
                    <td style="color: white; font-weight: bold;"><?= $row['id'] ?></td>
                    <td><input type="text" name="gebruikersnaam" class="form-control"
                            value="<?= htmlspecialchars($row['gebruikersnaam']) ?>" required></td>
                    <td><input type="text" name="naam" class="form-control"
                            value="<?= htmlspecialchars($row['naam']) ?>" required></td>
                    <td>
                        <select name="rol" class="form-select" required>
                            <option value="filmmaker" <?= $row['rol'] === 'filmmaker' ? 'selected' : '' ?>>Filmmaker
                            </option>
                            <option value="admin" <?= $row['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </td>
                    <td><input type="email" name="email" class="form-control"
                            value="<?= htmlspecialchars($row['email'] ?? '') ?>"></td>
                    <td><input type="text" name="telefoon" class="form-control"
                            value="<?= htmlspecialchars($row['telefoon'] ?? '') ?>"></td>
                    <td><textarea name="story" class="form-control"
                            rows="3"><?= htmlspecialchars($row['story'] ?? '') ?></textarea></td>
                    <td><textarea name="werkervaring" class="form-control"
                            rows="3"><?= htmlspecialchars($row['werkervaring'] ?? '') ?></textarea></td>
                    <td>
                        <input type="password" name="wachtwoord" class="form-control mb-1"
                            placeholder="Nieuw wachtwoord (optioneel)">
                        <button type="submit" name="bewerken" class="btn btn-success btn-sm mb-1 w-100">Opslaan</button>
                        <a href="?verwijder=<?= $row['id'] ?>" class="btn btn-danger btn-sm w-100"
                            onclick="return confirm('Weet je zeker dat je deze filmmaker wilt verwijderen?');">Verwijder</a>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
            span.textContent = cb.value;
            span.style.marginRight = '8px';
            span.style.padding = '2px 5px';
            span.style.background = '#007bff';
            span.style.color = '#fff';
            span.style.borderRadius = '3px';
            span.style.fontSize = '0.9em';
            span.style.display = 'inline-block';

            const closeBtn = document.createElement('span');
            closeBtn.textContent = ' ×';
            closeBtn.style.cursor = 'pointer';
            closeBtn.style.marginLeft = '5px';
            closeBtn.onclick = () => {
                cb.checked = false;
                updateSelected();
            };
            span.appendChild(closeBtn);
            selectedContainer.appendChild(span);
        }
    });
    hiddenInput.value = selectedValues.join(',');
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