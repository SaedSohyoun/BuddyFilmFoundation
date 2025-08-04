<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';

$zoekterm = trim($_GET['zoekterm'] ?? '');
$vasteTag = 'Production';
$zoekterm_sql = "%" . $zoekterm . "%";

if ($zoekterm !== '') {
    $sql = "SELECT * FROM videos WHERE (titel LIKE ? OR beschrijving LIKE ?) AND tags = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $zoekterm_sql, $zoekterm_sql, $vasteTag);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM videos WHERE tags = ? ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $vasteTag);
    $stmt->execute();
    $result = $stmt->get_result();
}
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

.form-control {
    background-color: #2a2a2aff;
    color: white;
    border: 1px solid rgba(0, 130, 137, 0.8);
    border-radius: 0.25rem;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

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

.card {
    background-color: #2a2a2aff;
    color: white;
    border: none;
}

.card-title {
    font-weight: 600;
}

.card-text {
    white-space: pre-line;
}

.ratio {
    margin-bottom: 1rem;
}

.text-muted {
    color: rgba(0, 130, 137, 1) !important;
}
</style>

<div class="container mt-4">
    <h1>Production Video's</h1>

    <form method="get" class="mb-4 d-flex gap-2" style="max-width:600px;">
        <input type="text" name="zoekterm" class="form-control" placeholder="Zoek video in Production..."
            value="<?= htmlspecialchars($zoekterm) ?>">
        <button type="submit" class="btn btn-primary">Zoeken</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href=window.location.pathname;">
            Reset
        </button>
    </form>

    <?php if ($result->num_rows === 0): ?>
    <p>Er zijn geen video's gevonden in Production.</p>
    <?php else: ?>
    <div class="row">
        <?php while ($video = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($video['titel']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($video['beschrijving'])) ?></p>

                    <?php if (!empty($video['embed_code'])): ?>
                    <?php if (strpos($video['embed_code'], 'NPO_LINK:') === 0):
                                    $npoUrl = substr($video['embed_code'], strlen('NPO_LINK:')); ?>
                    <a href="<?= htmlspecialchars($npoUrl) ?>" target="_blank" rel="noopener noreferrer"
                        class="btn btn-primary w-100 mb-2">
                        🔗 Bekijk video op NPO.nl
                    </a>
                    <?php else: ?>
                    <div class="ratio ratio-16x9 mb-2"><?= $video['embed_code'] ?></div>
                    <?php endif; ?>
                    <?php elseif (!empty($video['video_link'])): ?>
                    <a href="<?= htmlspecialchars($video['video_link']) ?>" class="btn btn-primary w-100 mb-2"
                        target="_blank">
                        🔗 Bekijk video
                    </a>
                    <?php else: ?>
                    <p class="text-muted">Geen video of link beschikbaar.</p>
                    <?php endif; ?>

                    <p><strong>Tags:</strong> <?= htmlspecialchars($video['tags'] ?? '') ?></p>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <a href="admin/bewerk_video.php?id=<?= $video['id'] ?>" class="btn btn-warning btn-sm">✏️
                        Bewerken</a>
                    <a href="admin/verwijder_video.php?id=<?= $video['id'] ?>" class="btn btn-danger btn-sm"
                        onclick="return confirm('Weet je zeker dat je deze video wilt verwijderen?');">🗑️
                        Verwijderen</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>