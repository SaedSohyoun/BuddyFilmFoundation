<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Verwijderen
if (isset($_GET['verwijder'])) {
    $id = intval($_GET['verwijder']);
    $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
    if ($res && $row = $res->fetch_assoc()) {
        $bestandsnaam = $row['foto'];
        if ($bestandsnaam && file_exists('../uploads/team/' . $bestandsnaam)) {
            unlink('../uploads/team/' . $bestandsnaam);
        }
    }
    $conn->query("DELETE FROM teamleden WHERE id = $id");
    header("Location: teambeheer.php");
    exit;
}

// Toevoegen of bewerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $functie = $_POST['functie'];
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null;

    $fotoNaam = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmpNaam = $_FILES['foto']['tmp_name'];
        $origineleNaam = basename($_FILES['foto']['name']);
        $ext = strtolower(pathinfo($origineleNaam, PATHINFO_EXTENSION));
        $toegestaneExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $toegestaneExt)) {
            $fotoNaam = uniqid('team_', true) . '.' . $ext;
            move_uploaded_file($tmpNaam, '../uploads/team/' . $fotoNaam);

            if ($id) {
                $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
                if ($res && $row = $res->fetch_assoc()) {
                    $oudeFoto = $row['foto'];
                    if ($oudeFoto && file_exists('../uploads/team/' . $oudeFoto)) {
                        unlink('../uploads/team/' . $oudeFoto);
                    }
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Ongeldig bestandsformaat. Alleen jpg, jpeg, png, gif toegestaan.</div>";
        }
    } elseif ($id) {
        $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
        if ($res && $row = $res->fetch_assoc()) {
            $fotoNaam = $row['foto'];
        }
    } else {
        echo "<div class='alert alert-danger'>Je moet een foto uploaden.</div>";
    }

    if ($fotoNaam) {
        if ($id) {
            $stmt = $conn->prepare("UPDATE teamleden SET naam=?, functie=?, foto=? WHERE id=?");
            $stmt->bind_param("sssi", $naam, $functie, $fotoNaam, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO teamleden (naam, functie, foto) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $naam, $functie, $fotoNaam);
        }
        $stmt->execute();
        header("Location: teambeheer.php");
        exit;
    }
}

$bewerk = null;
if (isset($_GET['bewerk'])) {
    $id = intval($_GET['bewerk']);
    $res = $conn->query("SELECT * FROM teamleden WHERE id = $id");
    $bewerk = $res->fetch_assoc();
}
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 3rem 0;
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

/* Form Section */
.form-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 0.5rem;
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    color: #ccc;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 8px;
    color: white;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    background-color: #333;
    border-color: rgba(0, 130, 137, 1);
    box-shadow: 0 0 0 3px rgba(0, 130, 137, 0.1);
    outline: none;
}

.form-control::placeholder {
    color: #888;
}

/* File Input Styling */
.file-input-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.file-input {
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 8px;
    color: white;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    cursor: pointer;
}

.file-input:focus {
    background-color: #333;
    border-color: rgba(0, 130, 137, 1);
    box-shadow: 0 0 0 3px rgba(0, 130, 137, 0.1);
    outline: none;
}

.file-input::file-selector-button {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 1rem;
}

.file-input::file-selector-button:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-1px);
}

/* Buttons */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-right: 0.5rem;
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
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: linear-gradient(135deg, rgba(108, 117, 125, 1) 0%, rgba(73, 80, 87, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, rgba(73, 80, 87, 1) 0%, rgba(108, 117, 125, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    color: white;
    text-decoration: none;
}

.btn-warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 1) 0%, rgba(179, 135, 5, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
}

.btn-warning:hover {
    background: linear-gradient(135deg, rgba(179, 135, 5, 1) 0%, rgba(255, 193, 7, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 1) 0%, rgba(154, 37, 48, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, rgba(154, 37, 48, 1) 0%, rgba(220, 53, 69, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    color: white;
    text-decoration: none;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.8rem;
}

/* Current Photo Preview */
.current-photo {
    background-color: #2a2a2a;
    border-radius: 8px;
    padding: 1rem;
    margin-top: 1rem;
    border: 1px solid #555;
}

.current-photo img {
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

/* Table Section */
.table-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.table-container {
    overflow-x: auto;
    border-radius: 10px;
    border: 1px solid #555;
}

.table {
    background-color: #2a2a2a;
    color: white;
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.table th {
    background-color: #333;
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    font-size: 0.9rem;
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid #555;
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: #333;
    transition: background-color 0.3s ease;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

/* Team Member Image */
.team-member-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.team-member-img:hover {
    transform: scale(1.05);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

/* Alert Messages */
.alert {
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    color: white;
}

.alert-danger {
    border-color: rgba(220, 53, 69, 0.5);
    background-color: rgba(220, 53, 69, 0.1);
    color: #ff6b6b;
}

.alert-success {
    border-color: rgba(40, 167, 69, 0.5);
    background-color: rgba(40, 167, 69, 0.1);
    color: #51cf66;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-container {
        padding: 1rem;
    }
    
    .page-header {
        padding: 2rem 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .form-section,
    .table-section {
        padding: 1.5rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .btn {
        margin-bottom: 0.5rem;
        margin-right: 0;
    }
    
    .table-container {
        font-size: 0.9rem;
    }
    
    .table th,
    .table td {
        padding: 0.75rem 0.5rem;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">👥 Teambeheer</h1>
            <p class="page-subtitle">Beheer je teamleden en hun profielen</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <h2 class="section-title"><?= $bewerk ? '📝 Teamlid Bewerken' : '➕ Nieuw Teamlid Toevoegen' ?></h2>
        
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $bewerk['id'] ?? '' ?>">

            <div class="form-group">
                <label class="form-label">Naam *</label>
                <input type="text" name="naam" class="form-control" placeholder="Volledige naam" required
                    value="<?= htmlspecialchars($bewerk['naam'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Functie *</label>
                <input type="text" name="functie" class="form-control" placeholder="Functie of rol" required
                    value="<?= htmlspecialchars($bewerk['functie'] ?? '') ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Foto <?= !$bewerk ? '(verplicht)' : '(laat leeg om huidige te behouden)' ?></label>
                <input type="file" name="foto" accept="image/*" class="file-input" <?= $bewerk ? '' : 'required' ?>>
            </div>

            <?php if ($bewerk && $bewerk['foto'] && file_exists('../uploads/team/' . $bewerk['foto'])): ?>
            <div class="current-photo">
                <label class="form-label">Huidige Foto</label>
                <img src="../uploads/team/<?= htmlspecialchars($bewerk['foto']) ?>" alt="Huidige foto" style="height:100px;">
            </div>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-<?= $bewerk ? 'save' : 'plus' ?>"></i>
                    <?= $bewerk ? 'Bijwerken' : 'Toevoegen' ?>
                </button>
                <?php if ($bewerk): ?>
                <a href="teambeheer.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuleren
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <h2 class="section-title">📋 Bestaande Teamleden</h2>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Naam</th>
                        <th>Functie</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = $conn->query("SELECT * FROM teamleden ORDER BY id ASC");
                    while ($lid = $res->fetch_assoc()):
                    ?>
                    <tr>
                        <td>
                            <?php if ($lid['foto'] && file_exists('../uploads/team/' . $lid['foto'])): ?>
                            <img src="../uploads/team/<?= htmlspecialchars($lid['foto']) ?>" 
                                class="team-member-img"
                                alt="<?= htmlspecialchars($lid['naam']) ?>">
                            <?php else: ?>
                            <img src="../assets/img/default-team.png" 
                                class="team-member-img"
                                alt="Geen foto">
                            <?php endif; ?>
                        </td>
                        <td><strong><?= htmlspecialchars($lid['naam']) ?></strong></td>
                        <td><?= htmlspecialchars($lid['functie']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="?bewerk=<?= $lid['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Bewerk
                                </a>
                                <a href="?verwijder=<?= $lid['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Weet je het zeker? Dit kan niet ongedaan worden gemaakt.');">
                                    <i class="fas fa-trash"></i> Verwijder
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>