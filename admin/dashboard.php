<?php
include '../inc/header.php';

// Alleen admin toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Hero Section */
.dashboard-hero {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 3rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
}

.dashboard-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(0,130,137,0.08)" stroke-width="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
}

.dashboard-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.dashboard-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.dashboard-subtitle {
    color: #ccc;
    font-size: 1.2rem;
    margin-bottom: 2rem;
    font-weight: 300;
}

.admin-badge {
    display: inline-block;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.dashboard-card {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    text-decoration: none;
    color: white;
    display: block;
    position: relative;
    overflow: hidden;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
    text-decoration: none;
    color: white;
}

.card-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    display: block;
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.3);
}

.card-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: white;
}

.card-description {
    color: #ccc;
    font-size: 0.9rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.card-action {
    color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-action::after {
    content: '→';
    font-size: 1.1rem;
    transition: transform 0.3s ease;
}

.dashboard-card:hover .card-action::after {
    transform: translateX(5px);
}

/* Special Cards */
.card-primary {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-color: rgba(0, 130, 137, 0.5);
}

.card-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-color: rgba(40, 167, 69, 0.5);
}

.card-success .card-icon {
    color: rgba(40, 167, 69, 1);
    text-shadow: 0 0 15px rgba(40, 167, 69, 0.3);
}

.card-success .card-action {
    color: rgba(40, 167, 69, 1);
}

.card-info {
    background: linear-gradient(135deg, rgba(23, 162, 184, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-color: rgba(23, 162, 184, 0.5);
}

.card-info .card-icon {
    color: rgba(23, 162, 184, 1);
    text-shadow: 0 0 15px rgba(23, 162, 184, 0.3);
}

.card-info .card-action {
    color: rgba(23, 162, 184, 1);
}

.card-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-color: rgba(220, 53, 69, 0.5);
}

.card-danger .card-icon {
    color: rgba(220, 53, 69, 1);
    text-shadow: 0 0 15px rgba(220, 53, 69, 0.3);
}

.card-danger .card-action {
    color: rgba(220, 53, 69, 1);
}

.card-warning {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-color: rgba(255, 193, 7, 0.5);
}

.card-warning .card-icon {
    color: rgba(255, 193, 7, 1);
    text-shadow: 0 0 15px rgba(255, 193, 7, 0.3);
}

.card-warning .card-action {
    color: rgba(255, 193, 7, 1);
}

/* Stats Section */
.stats-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 1.5rem;
    background-color: #2a2a2a;
    border-radius: 10px;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

.stat-item:hover {
    background-color: #333;
    border-color: rgba(0, 130, 137, 0.5);
    transform: translateY(-2px);
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: rgba(0, 130, 137, 1);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #ccc;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .dashboard-hero {
        padding: 2rem 0;
    }

    .dashboard-title {
        font-size: 2rem;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-item {
        padding: 1rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Dashboard Content -->
<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="dashboard-hero">
        <div class="dashboard-hero-content">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <p class="dashboard-subtitle">Welkom terug, <?= htmlspecialchars($_SESSION['gebruikersnaam']) ?></p>
            <span class="admin-badge">Administrator</span>
        </div>
    </div>



    <!-- Dashboard Grid -->
    <div class="dashboard-grid">
        <a href="beheer_filmmakers.php" class="dashboard-card card-primary">
            <span class="card-icon">👥</span>
            <h3 class="card-title">Beheer Filmmakers</h3>
            <p class="card-description">Beheer filmmaker accounts, profielen en toegangsrechten. Bekijk en bewerk
                filmmaker informatie.</p>
            <span class="card-action">Beheer filmmakers</span>
        </a>

        <a href="voeg_video_toe.php" class="dashboard-card card-success">
            <span class="card-icon">🎬</span>
            <h3 class="card-title">Voeg Video Toe</h3>
            <p class="card-description">Upload nieuwe video's naar het platform. Ondersteunt YouTube, Vimeo en NPO
                links.</p>
            <span class="card-action">Video toevoegen</span>
        </a>

        <a href="../filmmakers.php" class="dashboard-card card-info">
            <span class="card-icon">📺</span>
            <h3 class="card-title">Bekijk Filmmakerspagina</h3>
            <p class="card-description">Bekijk hoe de filmmakerspagina eruit ziet voor bezoekers van de website.</p>
            <span class="card-action">Bekijk pagina</span>
        </a>

        <a href="portfolio_moderatie.php" class="dashboard-card card-warning">
            <span class="card-icon">✅</span>
            <h3 class="card-title">Portfolio Moderatie</h3>
            <p class="card-description">Controleer en keur filmmaker portfolios goed voordat ze online gaan.
            </p>
            <span class="card-action">Modereer portfolios</span>
        </a>

        <a href="admin_statistieken.php" class="dashboard-card card-info">
            <span class="card-icon">📊</span>
            <h3 class="card-title">Statistieken & Analytics</h3>
            <p class="card-description">Bekijk gedetailleerde statistieken, gebruikersanalytics en platform prestaties.
            </p>
            <span class="card-action">Bekijk statistieken</span>
        </a>

        <a href="../logout.php" class="dashboard-card card-danger">
            <span class="card-icon">🚪</span>
            <h3 class="card-title">Uitloggen</h3>
            <p class="card-description">Log uit van het admin dashboard en ga terug naar de hoofdpagina.</p>
            <span class="card-action">Uitloggen</span>
        </a>

    </div>
    <br><br>
</div>

<?php include '../inc/footer.php'; ?>