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

<div class="container mt-4">
    <h2>✏️ Video Bewerken</h2>

    <?php if ($fout): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
    <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Titel</label>
            <input type="text" name="titel" class="form-control" value="<?= htmlspecialchars($video['titel']) ?>"
                required>
        </div>
        <div class="mb-3">
            <label class="form-label">Beschrijving</label>
            <textarea name="beschrijving" class="form-control"
                rows="4"><?= htmlspecialchars($video['beschrijving']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Embed-code</label>
            <textarea name="embed_code" class="form-control" rows="3"
                required><?= htmlspecialchars($video['embed_code']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tag (selecteer één)</label>
            <select name="tag" class="form-select" required>
                <option value="">-- Kies een tag --</option>
                <?php
                $tags_opties = ['Casting', 'Production', 'Foundation'];
                foreach ($tags_opties as $optie) {
                    $selected = ($video['tags'] === $optie) ? 'selected' : '';
                    echo "<option value=\"$optie\" $selected>$optie</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>
        <a href="../index.php" class="btn btn-secondary">Annuleren</a>
    </form>
</div>

<?php include '../inc/footer.php'; ?>