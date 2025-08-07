<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

// Alleen admin mag dit
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Check of er een video ID is opgegeven
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>Geen geldig video-ID opgegeven.</div>";
    include '../inc/footer.php';
    exit;
}

$id = $_GET['id'];
$fout = '';
$succes = '';

// Haal huidige videogegevens op
$stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$video = $result->fetch_assoc();

if (!$video) {
    echo "<div class='alert alert-danger'>Video niet gevonden.</div>";
    include '../inc/footer.php';
    exit;
}

// Verwerken van update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titel = $_POST['titel'] ?? '';
    $beschrijving = $_POST['beschrijving'] ?? '';
    $embed_code = $_POST['embed_code'] ?? '';
    $tag = $_POST['tag'] ?? '';

    if (empty($titel) || empty($embed_code)) {
        $fout = "Titel en embed-code zijn verplicht.";
    } else {
        $stmt = $conn->prepare("UPDATE videos SET titel = ?, beschrijving = ?, embed_code = ?, tags = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $titel, $beschrijving, $embed_code, $tag, $id);

        if ($stmt->execute()) {
            $succes = "Video succesvol bijgewerkt!";
            // Refresh data
            $video['titel'] = $titel;
            $video['beschrijving'] = $beschrijving;
            $video['embed_code'] = $embed_code;
            $video['tags'] = $tag;
        } else {
            $fout = "Er ging iets mis: " . $conn->error;
        }
    }
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
    max-width: 800px;
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

/* Select Styling */
.form-select {
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

.form-select:focus {
    background-color: #333;
    border-color: rgba(0, 130, 137, 1);
    box-shadow: 0 0 0 3px rgba(0, 130, 137, 0.1);
    outline: none;
}

.form-select option {
    background-color: #2a2a2a;
    color: white;
    padding: 0.5rem;
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

/* Form Actions */
.form-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #555;
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

/* Video Preview */
.video-preview {
    background-color: #2a2a2a;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1.5rem;
    border: 1px solid #555;
}

.preview-title {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.preview-embed {
    background-color: #1a1a1a;
    border-radius: 8px;
    padding: 1rem;
    border: 1px solid #555;
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
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">✏️ Video Bewerken</h1>
            <p class="page-subtitle">Update video informatie en instellingen</p>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <h2 class="section-title">📝 Video Details</h2>

        <?php if ($fout): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($fout) ?>
        </div>
        <?php endif; ?>

        <?php if ($succes): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?= htmlspecialchars($succes) ?>
        </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label class="form-label">Titel *</label>
                <input type="text" name="titel" class="form-control" 
                    value="<?= htmlspecialchars($video['titel']) ?>" 
                    placeholder="Voer de video titel in" required>
            </div>

            <div class="form-group">
                <label class="form-label">Beschrijving</label>
                <textarea name="beschrijving" class="form-control" 
                    placeholder="Voer een beschrijving in voor de video"
                    rows="4"><?= htmlspecialchars($video['beschrijving']) ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Embed Code *</label>
                <textarea name="embed_code" class="form-control" 
                    placeholder="Voer de embed code in (YouTube, Vimeo, etc.)"
                    rows="3" required><?= htmlspecialchars($video['embed_code']) ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Categorie *</label>
                <select name="tag" class="form-select" required>
                    <option value="">-- Kies een categorie --</option>
                    <?php
                    $tags_opties = ['Casting', 'Production', 'Foundation'];
                    foreach ($tags_opties as $optie) {
                        $selected = ($video['tags'] === $optie) ? 'selected' : '';
                        echo "<option value=\"$optie\" $selected>$optie</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Video Preview -->
            <div class="video-preview">
                <div class="preview-title">🎬 Video Preview</div>
                <div class="preview-embed">
                    <?= $video['embed_code'] ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Opslaan
                </button>
                <a href="../index.php" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Annuleren
                </a>
            </div>
        </form>
    </div>
</div>

<?php include '../inc/footer.php'; ?>