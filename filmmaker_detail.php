<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container my-4 text-white'><p>Ongeldige filmmaker.</p></div>";
    include 'inc/footer.php';
    exit;
}

$id = intval($_GET['id']);

// Haal filmmaker gegevens op - alleen goedgekeurde portfolios
$stmt = $conn->prepare("SELECT id, gebruikersnaam, naam, story, werkervaring, email, telefoon, profielfoto, stad, portfolio_status FROM gebruikers WHERE id = ? AND rol = 'filmmaker'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container my-4 text-white'><p>Filmmaker niet gevonden.</p></div>";
    include 'inc/footer.php';
    exit;
}

$filmmaker = $result->fetch_assoc();

// Controleer of portfolio is goedgekeurd
if ($filmmaker['portfolio_status'] !== 'approved') {
    echo "<div class='container my-4 text-white'><p>Dit portfolio is nog niet goedgekeurd of is afgewezen.</p></div>";
    include 'inc/footer.php';
    exit;
}
$stmt->close();

$profielfotoPad = 'uploads/profielfotos/' . $filmmaker['profielfoto'];
$profielfoto = (empty($filmmaker['profielfoto']) || !file_exists($profielfotoPad))
    ? 'uploads/profielfotos/default.png'
    : $profielfotoPad;

$huidigeGebruikerId = $_SESSION['gebruiker_id'] ?? null;
?>

<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
    font-size: 1rem;
    line-height: 1.5;
}

.hero-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 3rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(0,130,137,0.08)" stroke-width="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.profile-image {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(0, 130, 137, 1);
    box-shadow: 0 10px 30px rgba(0, 130, 137, 0.3);
    margin-bottom: 1.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-image:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 130, 137, 0.4);
}

.filmmaker-name {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.filmmaker-username {
    color: #ccc;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: 300;
}

.content-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.content-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 0.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.info-item {
    background-color: #2a2a2a;
    border-radius: 10px;
    padding: 1.5rem;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

.info-item:hover {
    background-color: #333;
    border-color: rgba(0, 130, 137, 0.5);
}

.info-label {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.info-value {
    color: white;
    font-size: 1rem;
    line-height: 1.6;
}

.info-value a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    transition: color 0.3s ease;
}

.info-value a:hover {
    color: white;
    text-decoration: underline;
}

.story-content,
.experience-content {
    color: #e0e0e0;
    font-size: 1rem;
    line-height: 1.8;
    margin-top: 1rem;
}

.empty-content {
    color: #888;
    font-style: italic;
    font-size: 1rem;
    margin-top: 1rem;
}

.back-button {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
}

.back-button:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
}

.back-button i {
    font-size: 0.9rem;
}

.contact-button {
    background: linear-gradient(135deg, rgba(0, 0, 0, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.6rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0, 130, 137, 0.3);
    font-size: 0.9rem;
}

.contact-button:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.4);
}

.contact-button i {
    font-size: 0.8rem;
}

@media (max-width: 768px) {
    .filmmaker-name {
        font-size: 2rem;
    }

    .content-section {
        padding: 1.5rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .profile-image {
        width: 150px;
        height: 150px;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <img src="<?= htmlspecialchars($profielfoto) ?>" alt="Profielfoto" class="profile-image">
        <h1 class="filmmaker-name"><?= htmlspecialchars($filmmaker['naam']) ?></h1>
        <p class="filmmaker-username">@<?= htmlspecialchars($filmmaker['gebruikersnaam']) ?></p>
    </div>
</div>

<!-- Contact Information -->
<div class="container">
    <div class="content-section">
        <h2 class="section-title">Contact Informatie</h2>
        <div class="info-grid">
            <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') || $huidigeGebruikerId == $id): ?>
            <?php if (!empty($filmmaker['stad'])): ?>
            <div class="info-item">
                <div class="info-label">Stad</div>
                <div class="info-value"><?= htmlspecialchars($filmmaker['stad']) ?></div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($filmmaker['email'])): ?>
            <div class="info-item">
                <div class="info-label">Contact</div>
                <div class="info-value">
                    <a href="mailto:<?= htmlspecialchars($filmmaker['email']) ?>,info@buddyfilmfoundation.com?subject=Contact via BuddyFilmFoundation - <?= htmlspecialchars($filmmaker['naam']) ?>" class="contact-button">
                        <i class="fas fa-envelope"></i> Neem Contact
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($filmmaker['telefoon'])): ?>
            <div class="info-item">
                <div class="info-label">Telefoon</div>
                <div class="info-value"><?= htmlspecialchars($filmmaker['telefoon']) ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Story Section -->
    <div class="content-section">
        <h2 class="section-title">Verhaal</h2>
        <?php if (!empty($filmmaker['story'])): ?>
        <div class="story-content"><?= nl2br(htmlspecialchars($filmmaker['story'])) ?></div>
        <?php else: ?>
        <div class="empty-content">Deze filmmaker heeft nog geen story toegevoegd.</div>
        <?php endif; ?>
    </div>

    <!-- Experience Section -->
    <div class="content-section">
        <h2 class="section-title">Werkervaring</h2>
        <?php if (!empty($filmmaker['werkervaring'])): ?>
        <div class="experience-content"><?= nl2br(htmlspecialchars($filmmaker['werkervaring'])) ?></div>
        <?php else: ?>
        <div class="empty-content">Deze filmmaker heeft nog geen werkervaring toegevoegd.</div>
        <?php endif; ?>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-5">
        <a href="filmmakers.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Terug naar filmmakers
        </a>
    </div>
    <br><br>
</div>

<?php include 'inc/footer.php'; ?>