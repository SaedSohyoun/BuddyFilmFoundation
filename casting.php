<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';

$zoekterm = trim($_GET['zoekterm'] ?? '');
$vasteTag = 'Casting';
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
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.page-container {
    flex: 1;
    padding: 2rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem 0;
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
}

.page-header h1 {
    color: rgba(0, 130, 137, 1);
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.page-header p {
    color: #ccc;
    font-size: 1.2rem;
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.search-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.search-form {
    display: flex;
    gap: 1rem;
    align-items: center;
    max-width: 600px;
    margin: 0 auto;
}

.form-control {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    flex: 1;
}

.form-control:focus {
    background-color: #2a2a2a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #00676d;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
}

.btn-secondary {
    background-color: #444;
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background-color: #666;
    transform: translateY(-2px);
}

.video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.video-card {
    background-color: #1a1a1a;
    border: 1px solid #333;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    border-color: rgba(0, 130, 137, 0.5);
}

.video-content {
    padding: 1.5rem;
}

.video-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.video-description {
    color: #ccc;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    white-space: pre-line;
}

.video-embed {
    margin-bottom: 1rem;
    border-radius: 8px;
    overflow: hidden;
}

.video-link {
    display: inline-block;
    background-color: rgba(0, 130, 137, 1);
    color: white;
    text-decoration: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-bottom: 1rem;
    text-align: center;
    width: 100%;
}

.video-link:hover {
    background-color: #00676d;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
    color: white;
    text-decoration: none;
}



.no-video {
    color: rgba(0, 130, 137, 1);
    font-style: italic;
    text-align: center;
    padding: 1rem;
    background-color: #2a2a2a;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.video-tags {
    color: #888;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.admin-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}

.btn-warning {
    background-color: #ffc107;
    border: none;
    color: #000;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background-color: #e0a800;
    transform: translateY(-2px);
}

.btn-danger {
    background-color: #dc3545;
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    background-color: #c82333;
    transform: translateY(-2px);
}

.no-results {
    text-align: center;
    padding: 3rem;
    color: #ccc;
    font-size: 1.1rem;
}

.no-results i {
    font-size: 3rem;
    color: rgba(0, 130, 137, 1);
    margin-bottom: 1rem;
    display: block;
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 2rem;
    }
    
    .search-form {
        flex-direction: column;
        gap: 1rem;
    }
    
    .video-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .page-container {
        padding: 1rem;
    }
}
</style>

<div class="page-container">
    <div class="page-header">
        <h1><i class="fas fa-users me-3"></i>Casting</h1>
        <p>Discover casting opportunities and talent showcases from our network of actors and performers.</p>
    </div>

    <div class="container">
        <div class="search-section">
            <form method="get" class="search-form">
                <input type="text" name="zoekterm" class="form-control" 
                       placeholder="Search Casting videos..." 
                       value="<?= htmlspecialchars($zoekterm) ?>">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search me-2"></i>Search
                </button>
                <button type="button" class="btn btn-secondary" 
                        onclick="window.location.href=window.location.pathname;">
                    <i class="fas fa-undo me-2"></i>Reset
                </button>
            </form>
        </div>

        <?php if ($result->num_rows === 0): ?>
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h3>No videos found</h3>
            <p><?= $zoekterm ? 'No Casting videos match your search criteria.' : 'No Casting videos available yet.' ?></p>
        </div>
        <?php else: ?>
        <div class="video-grid">
            <?php while ($video = $result->fetch_assoc()): ?>
            <div class="video-card">
                <div class="video-content">
                    <h3 class="video-title"><?= htmlspecialchars($video['titel']) ?></h3>
                    <p class="video-description"><?= nl2br(htmlspecialchars($video['beschrijving'])) ?></p>

                    <?php if (!empty($video['embed_code'])): ?>
                        <?php if (strpos($video['embed_code'], 'NPO_LINK:') === 0):
                            $npoUrl = substr($video['embed_code'], strlen('NPO_LINK:')); ?>
                        <a href="<?= htmlspecialchars($npoUrl) ?>" target="_blank" rel="noopener noreferrer" class="video-link">
                            <i class="fas fa-play me-2"></i>Watch NPO Video
                        </a>
                        <?php else: ?>
                        <div class="video-embed"><?= $video['embed_code'] ?></div>
                        <?php endif; ?>
                    <?php elseif (!empty($video['video_link'])): ?>
                    <a href="<?= htmlspecialchars($video['video_link']) ?>" class="video-link" target="_blank">
                        <i class="fas fa-play me-2"></i>Watch Video
                    </a>
                    <?php else: ?>
                    <div class="no-video">
                        <i class="fas fa-video-slash me-2"></i>No video available
                    </div>
                    <?php endif; ?>

                    <div class="video-tags">
                        <i class="fas fa-tags me-1"></i><?= htmlspecialchars($video['tags'] ?? '') ?>
                    </div>

                    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                    <div class="admin-actions">
                        <a href="admin/bewerk_video.php?id=<?= $video['id'] ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="admin/verwijder_video.php?id=<?= $video['id'] ?>" class="btn btn-danger"
                           onclick="return confirm('Are you sure you want to delete this video?');">
                            <i class="fas fa-trash me-1"></i>Delete
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>