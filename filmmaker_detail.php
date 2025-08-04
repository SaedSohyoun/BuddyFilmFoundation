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

// Haal filmmaker gegevens op
$stmt = $conn->prepare("SELECT id, gebruikersnaam, naam, story, werkervaring, email, telefoon, profielfoto, stad FROM gebruikers WHERE id = ? AND rol = 'filmmaker'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container my-4 text-white'><p>Filmmaker niet gevonden.</p></div>";
    include 'inc/footer.php';
    exit;
}

$filmmaker = $result->fetch_assoc();
$stmt->close();

$profielfotoPad = 'uploads/profielfotos/' . $filmmaker['profielfoto'];
$profielfoto = (empty($filmmaker['profielfoto']) || !file_exists($profielfotoPad))
    ? 'uploads/profielfotos/default.png'
    : $profielfotoPad;

$huidigeGebruikerId = $_SESSION['gebruiker_id'] ?? null;
?>

<!-- STYLING -->
<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

h1,
h3 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

p,
a {
    color: white;
}

a {
    text-decoration: underline;
}

.btn-secondary {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    color: white;
    font-weight: 600;
}

.btn-secondary:hover {
    background-color: #005d61;
}

.rounded-circle {
    border: 4px solid rgba(0, 130, 137, 1);
}

.container {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}
</style>

<!-- CONTENT -->
<div class="container my-5">
    <div class="text-center mb-4">
        <img src="<?= htmlspecialchars($profielfoto) ?>" alt="Profielfoto" class="rounded-circle shadow"
            style="width: 150px; height: 150px; object-fit: cover;">
        <h1 class="mt-3"><?= htmlspecialchars($filmmaker['naam']) ?></h1>
    </div>

    <p><strong>Gebruikersnaam:</strong> <?= htmlspecialchars($filmmaker['gebruikersnaam']) ?></p>

    <?php if ((isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin') || $huidigeGebruikerId == $id): ?>
    <?php if (!empty($filmmaker['stad'])): ?>
    <p><strong>Stad:</strong> <?= htmlspecialchars($filmmaker['stad']) ?></p>
    <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($filmmaker['email'])): ?>
    <p><strong>E-mail:</strong>
        <a href="mailto:<?= htmlspecialchars($filmmaker['email']) ?>"><?= htmlspecialchars($filmmaker['email']) ?></a>
    </p>
    <?php endif; ?>

    <?php if (!empty($filmmaker['telefoon'])): ?>
    <p><strong>Telefoon:</strong> <?= htmlspecialchars($filmmaker['telefoon']) ?></p>
    <?php endif; ?>

    <h3>Verhaal</h3>
    <?php if (!empty($filmmaker['story'])): ?>
    <p><?= nl2br(htmlspecialchars($filmmaker['story'])) ?></p>
    <?php else: ?>
    <p><em>Deze filmmaker heeft nog geen story toegevoegd.</em></p>
    <?php endif; ?>

    <h3>Werkervaring</h3>
    <?php if (!empty($filmmaker['werkervaring'])): ?>
    <p><?= nl2br(htmlspecialchars($filmmaker['werkervaring'])) ?></p>
    <?php else: ?>
    <p><em>Deze filmmaker heeft nog geen werkervaring toegevoegd.</em></p>
    <?php endif; ?>

    <a href="filmmakers.php" class="btn btn-secondary mt-4">← Terug naar filmmakers</a>
</div>

<?php include 'inc/footer.php'; ?>