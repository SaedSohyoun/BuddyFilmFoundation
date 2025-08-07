<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

// Alleen filmmaker toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'filmmaker') {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['gebruikersnaam'];
$uploadPad = "../uploads/profielfotos/";
if (!is_dir($uploadPad)) {
    mkdir($uploadPad, 0777, true);
}

$fout = $succes = "";

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Foto uploaden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_foto'])) {
    if (isset($_FILES['profielfoto']) && $_FILES['profielfoto']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['profielfoto']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $allowed_ext)) {
            $fout = "Ongeldig bestandstype.";
        } else {
            $bestandsnaam = uniqid('foto_') . "." . $ext;
            $pad = $uploadPad . $bestandsnaam;

            if (move_uploaded_file($_FILES['profielfoto']['tmp_name'], $pad)) {
                $stmtOld = $conn->prepare("SELECT profielfoto FROM gebruikers WHERE gebruikersnaam = ?");
                $stmtOld->bind_param("s", $user);
                $stmtOld->execute();
                $stmtOld->bind_result($oudeFoto);
                $stmtOld->fetch();
                $stmtOld->close();

                if ($oudeFoto && file_exists($uploadPad . $oudeFoto)) {
                    @unlink($uploadPad . $oudeFoto);
                }

                $stmt = $conn->prepare("UPDATE gebruikers SET profielfoto = ? WHERE gebruikersnaam = ?");
                $stmt->bind_param("ss", $bestandsnaam, $user);
                if ($stmt->execute()) {
                    $succes = "Profielfoto geüpload.";
                    $profielfoto = $bestandsnaam;
                } else {
                    $fout = "Databasefout.";
                }
                $stmt->close();
            } else {
                $fout = "Upload mislukt.";
            }
        }
    } else {
        $fout = "Geen geldig bestand geüpload.";
    }
}

// Profielgegevens ophalen
$stmtProfile = $conn->prepare("SELECT naam, story, werkervaring, profielfoto, email, telefoon, stad FROM gebruikers WHERE gebruikersnaam = ?");
$stmtProfile->bind_param("s", $user);
$stmtProfile->execute();
$profileResult = $stmtProfile->get_result();
$profile = $profileResult->fetch_assoc();
$stmtProfile->close();

if (!isset($profielfoto)) {
    $profielfoto = $profile['profielfoto'] ?? '';
}

// Contactgegevens bijwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact'])) {
    $email = trim($_POST['email'] ?? '');
    $telefoon = trim($_POST['telefoon'] ?? '');

    $stmt = $conn->prepare("UPDATE gebruikers SET email = ?, telefoon = ? WHERE gebruikersnaam = ?");
    $stmt->bind_param("sss", $email, $telefoon, $user);
    if ($stmt->execute()) {
        $succes = "Contactgegevens opgeslagen.";
    } else {
        $fout = "Fout bij opslaan.";
    }
    $stmt->close();
}

// Profiel bijwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profiel'])) {
    $story = trim($_POST['story'] ?? '');
    $werkervaring = trim($_POST['werkervaring'] ?? '');
    $stad = trim($_POST['stad'] ?? '');

    $stmt = $conn->prepare("UPDATE gebruikers SET story = ?, werkervaring = ?, stad = ? WHERE gebruikersnaam = ?");
    $stmt->bind_param("ssss", $story, $werkervaring, $stad, $user);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $fout = "Fout bij bijwerken profiel.";
    }
    $stmt->close();
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

/* Dashboard Container */
.dashboard-container {
    max-width: 1000px;
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

/* Form Sections */
.form-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 2rem;
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
    font-family: inherit;
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

textarea.form-control {
    resize: vertical;
    min-height: 100px;
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

/* Profile Image */
.profile-image-container {
    text-align: center;
    margin-bottom: 2rem;
}

.profile-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    border: 4px solid rgba(0, 130, 137, 0.3);
    transition: all 0.3s ease;
}

.profile-image:hover {
    transform: scale(1.05);
    border-color: rgba(0, 130, 137, 1);
    box-shadow: 0 12px 35px rgba(0, 130, 137, 0.4);
}

.no-photo {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border: 4px solid rgba(0, 130, 137, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: rgba(0, 130, 137, 1);
    font-size: 3rem;
    opacity: 0.5;
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

/* Form Actions */
.form-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #555;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .page-header {
        padding: 2rem 0;
    }

    .page-title {
        font-size: 2rem;
    }

    .form-section {
        padding: 1.5rem;
    }

    .btn {
        margin-bottom: 0.5rem;
        margin-right: 0;
        width: 100%;
    }

    .form-actions {
        text-align: center;
    }

    .profile-image,
    .no-photo {
        width: 120px;
        height: 120px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <p class="page-subtitle">Welkom terug, <?= esc($profile['naam'] ?? $user) ?></p>
        </div>
    </div>

    <?php if ($fout): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i> <?= esc($fout) ?>
    </div>
    <?php endif; ?>

    <?php if ($succes): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= esc($succes) ?>
    </div>
    <?php endif; ?>

    <!-- Profile Photo Section -->
    <div class="form-section">
        <h2 class="section-title">📸 Profielfoto</h2>

        <div class="profile-image-container">
            <?php if (!empty($profielfoto) && file_exists($uploadPad . $profielfoto)): ?>
            <img src="../uploads/profielfotos/<?= esc($profielfoto) ?>?v=<?= filemtime($uploadPad . $profielfoto) ?>"
                alt="Profielfoto" class="profile-image">
            <?php else: ?>
            <div class="no-photo">
                <i class="fas fa-user"></i>
            </div>
            <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload_foto" value="1">
            <div class="form-group">
                <label class="form-label">Nieuwe profielfoto *</label>
                <input type="file" name="profielfoto" class="file-input" accept="image/*" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Uploaden
                </button>
            </div>
        </form>
    </div>

    <!-- Contact Information Section -->
    <div class="form-section">
        <h2 class="section-title">📞 Contactgegevens</h2>

        <form method="post">
            <input type="hidden" name="update_contact" value="1">
            <div class="form-group">
                <label class="form-label">E-mailadres</label>
                <input type="email" name="email" class="form-control" value="<?= esc($profile['email'] ?? '') ?>"
                    placeholder="voorbeeld@mail.com">
            </div>
            <div class="form-group">
                <label class="form-label">Telefoonnummer</label>
                <input type="text" name="telefoon" class="form-control" value="<?= esc($profile['telefoon'] ?? '') ?>"
                    placeholder="06-12345678">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-save"></i> Opslaan
                </button>
            </div>
        </form>
    </div>

    <!-- Profile Information Section -->
    <div class="form-section">
        <h2 class="section-title">📝 Profiel Informatie</h2>

        <form method="post">
            <input type="hidden" name="update_profiel" value="1">
            <div class="form-group">
                <label class="form-label">Story</label>
                <textarea name="story" class="form-control"
                    placeholder="Vertel over jezelf en je passie voor filmmaken..."
                    rows="5"><?= esc($profile['story'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Werkervaring</label>
                <textarea name="werkervaring" class="form-control"
                    placeholder="Beschrijf je ervaring en specialisaties..."
                    rows="5"><?= esc($profile['werkervaring'] ?? '') ?></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Stad</label>
                <input type="text" name="stad" class="form-control" value="<?= esc($profile['stad'] ?? '') ?>"
                    placeholder="Woonplaats">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-edit"></i> Profiel Bijwerken
                </button>
            </div>
        </form>
    </div>
</div>

<?php include '../inc/footer.php'; ?>