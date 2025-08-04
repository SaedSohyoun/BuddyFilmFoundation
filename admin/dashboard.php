<?php
include '../inc/header.php';

// Alleen admin toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!-- STYLING -->
<style>
body {
    background-color: black;
    color: white;
}

h1 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
    margin-bottom: 1.5rem;
}

p {
    font-size: 1rem;
    margin-bottom: 1.5rem;
}

.btn {
    padding: 0.75rem;
    font-weight: bold;
    font-size: 1rem;
    border-radius: 8px;
    border: none;
}

.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    color: white;
}

.btn-primary:hover {
    background-color: #00676d;
}

.btn-success {
    background-color: rgba(0, 130, 137, 1);
    color: white;
}

.btn-success:hover {
    background-color: #00676d;
}

.btn-info {
    background-color: rgba(0, 130, 137, 1);
    color: white;
}

.btn-info:hover {
    background-color: #00676d;
}

.btn-danger {
    background-color: rgba(0, 130, 137, 1);
    color: white;
}

.btn-danger:hover {
    background-color: #00676d;
}

.btn-warning {
    background-color: rgba(0, 130, 137, 1);
    color: black;
}

.btn-warning:hover {
    background-color: #00676d;
    color: white;
}

.container {
    max-width: 960px;
    margin: 2rem auto;
    padding: 1rem;
}

.row {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.col-md-6 {
    flex: 0 0 calc(50% - 0.5rem);
}

.mb-3 {
    margin-bottom: 1rem;
}

.w-100 {
    width: 100%;
}
</style>

<!-- INHOUD -->
<div class="container">
    <h1>Welkom, <?= htmlspecialchars($_SESSION['gebruikersnaam']) ?> (Admin)</h1>

    <p>Gebruik de knoppen hieronder om de website te beheren:</p>

    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="beheer_filmmakers.php" class="btn btn-primary w-100">👥 Beheer Filmmakers</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="voeg_video_toe.php" class="btn btn-success w-100">🎬 Voeg Video Toe</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="../filmmakers.php" class="btn btn-info w-100">📺 Bekijk Filmmakerspagina</a>
        </div>
        <div class="col-md-6 mb-3">
            <a href="../logout.php" class="btn btn-danger w-100">🚪 Uitloggen</a>
        </div>
        <div class="col-md-12 mb-3">
            <a href="admin_statistieken.php" class="btn btn-warning w-100">📊 Statistieken & Analytics</a>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>