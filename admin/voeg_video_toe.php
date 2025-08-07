<?php
session_start();
include '../inc/connectie.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$fout = '';
$succes = '';

function genereerEmbedCode($url) {
    $url = trim($url);

    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        $videoId = $matches[1];
        return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" frameborder="0" allowfullscreen></iframe>';
    }

    if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
        $videoId = $matches[1];
        return '<iframe src="https://player.vimeo.com/video/' . htmlspecialchars($videoId) . '" width="640" height="360" frameborder="0" allowfullscreen></iframe>';
    }

    if (preg_match('/npo\.nl|npostart\.nl/', $url)) {
        return 'NPO_LINK:' . htmlspecialchars($url);
    }

    return false;
}

// Verwerk formulier hier voor HTML output
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = trim($_POST['titel'] ?? '');
    $beschrijving = trim($_POST['beschrijving'] ?? '');
    $videolink = trim($_POST['videolink'] ?? '');
    $tag = trim($_POST['tag'] ?? '');

    if (empty($titel) || empty($beschrijving) || empty($videolink) || empty($tag)) {
        $fout = "Vul alle velden in.";
    } else {
        $embed_code = genereerEmbedCode($videolink);
        if (!$embed_code) {
            $fout = "Ongeldige link. Alleen YouTube, Vimeo of NPO wordt ondersteund.";
        } else {
            $tag = preg_replace('/[^a-zA-Z0-9 ]/', '', $tag);
            
            $stmt = $conn->prepare("INSERT INTO videos (titel, beschrijving, embed_code, tags) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $titel, $beschrijving, $embed_code, $tag);

            if ($stmt->execute()) {
                header("Location: ../" . strtolower($tag) . ".php");
                exit;
            } else {
                $fout = "Fout bij toevoegen: " . $conn->error;
            }
            $stmt->close();
        }
    }
}

include '../inc/header.php';
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
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 0.5rem;
}

/* Form Controls */
.form-group {
    margin-bottom: 2rem;
}

.form-label {
    color: white;
    font-weight: 600;
    margin-bottom: 0.8rem;
    display: block;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-control, .form-select {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 1rem 1.2rem;
    border-radius: 10px;
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

textarea.form-control {
    resize: vertical;
    min-height: 120px;
}

/* Buttons */
.btn {
    padding: 1rem 2rem;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
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
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

/* Video Preview */
.video-preview {
    background-color: #2a2a2a;
    border-radius: 10px;
    padding: 1.5rem;
    margin-top: 1rem;
    border: 1px solid #555;
    display: none;
}

.preview-title {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.preview-description {
    color: #ccc;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.preview-embed {
    background-color: #1a1a1a;
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    color: #888;
    font-style: italic;
}

/* Supported Platforms */
.supported-platforms {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(0, 130, 137, 0.3);
}

.platforms-title {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.platforms-list {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.platform-badge {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        text-align: center;
    }
    
    .platforms-list {
        flex-direction: column;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">🎬 Video Toevoegen</h1>
            <p class="page-subtitle">Upload nieuwe video's naar het platform</p>
        </div>
    </div>

    <!-- Supported Platforms Info -->
    <div class="supported-platforms">
        <div class="platforms-title">Ondersteunde Platforms</div>
        <div class="platforms-list">
            <span class="platform-badge">YouTube</span>
            <span class="platform-badge">Vimeo</span>
            <span class="platform-badge">NPO</span>
        </div>
    </div>

    <!-- Alerts -->
    <?php if ($fout): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
    <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <!-- Video Form Section -->
    <div class="form-section">
        <h2 class="section-title">Video Informatie</h2>
        <form method="post" id="videoForm">
            <div class="form-group">
                <label for="titel" class="form-label">Titel *</label>
                <input type="text" name="titel" id="titel" class="form-control" required
                    value="<?= htmlspecialchars($_POST['titel'] ?? '') ?>" placeholder="Voer de titel van de video in">
            </div>

            <div class="form-group">
                <label for="beschrijving" class="form-label">Beschrijving *</label>
                <textarea name="beschrijving" id="beschrijving" class="form-control" rows="4" required
                    placeholder="Beschrijf de video inhoud"><?= htmlspecialchars($_POST['beschrijving'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="videolink" class="form-label">Video Link *</label>
                <input type="url" name="videolink" id="videolink" class="form-control" 
                    placeholder="https://www.youtube.com/watch?v=..." required 
                    value="<?= htmlspecialchars($_POST['videolink'] ?? '') ?>">
                <small style="color: #888; font-size: 0.8rem; margin-top: 0.5rem; display: block;">
                    Ondersteunde formaten: YouTube, Vimeo, NPO Start
                </small>
            </div>

            <div class="form-group">
                <label for="tag" class="form-label">Categorie *</label>
                <select name="tag" id="tag" class="form-select" required>
                    <option value="">-- Selecteer een categorie --</option>
                    <?php
                    $tags_opties = ['Casting', 'Production', 'Foundation'];
                    $geselecteerd = $_POST['tag'] ?? '';
                    foreach ($tags_opties as $optie) {
                        $selected = ($geselecteerd === $optie) ? 'selected' : '';
                        echo "<option value=\"$optie\" $selected>$optie</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Video Preview -->
            <div class="video-preview" id="videoPreview">
                <div class="preview-title">Video Preview</div>
                <div class="preview-description" id="previewDescription"></div>
                <div class="preview-embed" id="previewEmbed">
                    Video preview wordt hier getoond
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Video Toevoegen
                </button>
                <a href="dashboard.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Terug naar Dashboard
                </a>
            </div>
        </form>
    </div>
</div>

<script>
// Real-time preview functionality
document.getElementById('videolink').addEventListener('input', function() {
    const link = this.value;
    const preview = document.getElementById('videoPreview');
    const embed = document.getElementById('previewEmbed');
    
    if (link) {
        if (link.includes('youtube.com') || link.includes('youtu.be')) {
            embed.innerHTML = '<i class="fab fa-youtube"></i> YouTube Video';
        } else if (link.includes('vimeo.com')) {
            embed.innerHTML = '<i class="fab fa-vimeo-v"></i> Vimeo Video';
        } else if (link.includes('npo.nl') || link.includes('npostart.nl')) {
            embed.innerHTML = '<i class="fas fa-play"></i> NPO Video';
        } else {
            embed.innerHTML = '<i class="fas fa-question"></i> Onbekend platform';
        }
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
});

document.getElementById('beschrijving').addEventListener('input', function() {
    const description = this.value;
    const previewDesc = document.getElementById('previewDescription');
    
    if (description) {
        previewDesc.textContent = description.length > 100 ? 
            description.substring(0, 100) + '...' : description;
    } else {
        previewDesc.textContent = '';
    }
});

// Form validation
document.getElementById('videoForm').addEventListener('submit', function(e) {
    const link = document.getElementById('videolink').value;
    const supportedPlatforms = ['youtube.com', 'youtu.be', 'vimeo.com', 'npo.nl', 'npostart.nl'];
    const isSupported = supportedPlatforms.some(platform => link.includes(platform));
    
    if (!isSupported) {
        e.preventDefault();
        alert('Alleen YouTube, Vimeo en NPO links worden ondersteund.');
        return false;
    }
});
</script>

<?php include '../inc/footer.php'; ?>