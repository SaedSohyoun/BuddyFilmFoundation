<?php
include '../inc/header.php';

// Alleen admin toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<style>
/* Reset en basis styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    color: #ffffff;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-size: 1rem;
    line-height: 1.6;
    min-height: 100vh;
    overflow-x: hidden;
}

/* Animated background */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    z-index: -1;
    animation: backgroundShift 20s ease-in-out infinite;
}

@keyframes backgroundShift {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    25% {
        transform: translate(-10px, -10px) scale(1.02);
    }

    50% {
        transform: translate(10px, -5px) scale(0.98);
    }

    75% {
        transform: translate(-5px, 10px) scale(1.01);
    }
}

/* Dashboard Container */
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
    min-height: 100vh;
}

/* Hero Section */
.dashboard-hero {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    padding: 4rem 2rem;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.dashboard-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.03) 50%, transparent 70%),
        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse"><path d="M 20 0 L 0 0 0 20" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.6;
    animation: gridMove 30s linear infinite;
}

@keyframes gridMove {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(20px, 20px);
    }
}

.dashboard-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.dashboard-title {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
    animation: titleGlow 3s ease-in-out infinite alternate;
}

@keyframes titleGlow {
    0% {
        filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.3));
    }

    100% {
        filter: drop-shadow(0 0 30px rgba(255, 255, 255, 0.6));
    }
}

.dashboard-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.3rem;
    margin-bottom: 2rem;
    font-weight: 400;
    letter-spacing: 0.01em;
}

.admin-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow:
        0 8px 25px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.admin-badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.6s ease;
}

.admin-badge:hover::before {
    left: 100%;
}

.admin-badge:hover {
    transform: translateY(-2px);
    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

/* Stats Section */
.stats-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.stats-section h2 {
    color: white;
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    letter-spacing: -0.01em;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.stat-item {
    text-align: center;
    padding: 2rem 1.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.03) 100%);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.05) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-4px);
    border-color: rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.stat-item:hover::before {
    opacity: 1;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    display: block;
}

.stat-label {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-top: 2rem;
}

.dashboard-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0.02) 100%);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2.5rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    color: white;
    display: block;
    position: relative;
    overflow: hidden;
    box-shadow:
        0 10px 30px rgba(0, 0, 0, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
    animation: fadeInUp 0.6s ease-out forwards;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.dashboard-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.02) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow:
        0 20px 50px rgba(0, 0, 0, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.3);
    text-decoration: none;
    color: white;
}

.dashboard-card:hover::before {
    transform: scaleX(1);
}

.dashboard-card:hover::after {
    opacity: 1;
}

.card-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    display: block;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.dashboard-card:hover .card-icon {
    transform: scale(1.1);
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
}

.card-title {
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: white;
    letter-spacing: -0.01em;
}

.card-description {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    font-weight: 400;
}

.card-action {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.card-action::after {
    content: '→';
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.dashboard-card:hover .card-action {
    color: rgba(255, 255, 255, 1);
}

.dashboard-card:hover .card-action::after {
    transform: translateX(8px);
}

/* Special Cards */
.card-primary {
    border-color: rgba(255, 255, 255, 0.3);
}

.card-primary .card-icon {
    color: rgba(255, 255, 255, 0.9);
}

.card-success {
    border-color: rgba(255, 255, 255, 0.3);
}

.card-success .card-icon {
    color: rgba(255, 255, 255, 0.9);
}

.card-success .card-action {
    color: rgba(255, 255, 255, 0.9);
}

.card-info {
    border-color: rgba(255, 255, 255, 0.3);
}

.card-info .card-icon {
    color: rgba(255, 255, 255, 0.9);
}

.card-info .card-action {
    color: rgba(255, 255, 255, 0.9);
}

.card-warning {
    border-color: rgba(255, 255, 255, 0.3);
}

.card-warning .card-icon {
    color: rgba(255, 255, 255, 0.9);
}

.card-warning .card-action {
    color: rgba(255, 255, 255, 0.9);
}

.card-danger {
    border-color: rgba(255, 255, 255, 0.3);
}

.card-danger .card-icon {
    color: rgba(255, 255, 255, 0.9);
}

.card-danger .card-action {
    color: rgba(255, 255, 255, 0.9);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .dashboard-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .dashboard-hero {
        padding: 3rem 1.5rem;
        border-radius: 20px;
    }

    .dashboard-title {
        font-size: 2.5rem;
    }

    .dashboard-subtitle {
        font-size: 1.1rem;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .stat-item {
        padding: 1.5rem 1rem;
    }

    .stat-number {
        font-size: 2rem;
    }

    .dashboard-card {
        padding: 2rem 1.5rem;
    }
}

@media (max-width: 480px) {
    .dashboard-title {
        font-size: 2rem;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .dashboard-card {
        padding: 2rem 1.5rem;
    }
}

/* Loading animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dashboard-card:nth-child(1) {
    animation-delay: 0.1s;
}

.dashboard-card:nth-child(2) {
    animation-delay: 0.2s;
}

.dashboard-card:nth-child(3) {
    animation-delay: 0.3s;
}

.dashboard-card:nth-child(4) {
    animation-delay: 0.4s;
}

.dashboard-card:nth-child(5) {
    animation-delay: 0.5s;
}

.dashboard-card:nth-child(6) {
    animation-delay: 0.6s;
}

.dashboard-card:nth-child(7) {
    animation-delay: 0.7s;
}

.dashboard-card:nth-child(8) {
    animation-delay: 0.8s;
}

.dashboard-card:nth-child(9) {
    animation-delay: 0.9s;
}

/* Hover effects for stats */
.stat-item {
    animation: fadeInUp 0.6s ease-out forwards;
}

.stat-item:nth-child(1) {
    animation-delay: 0.1s;
}

.stat-item:nth-child(2) {
    animation-delay: 0.2s;
}

.stat-item:nth-child(3) {
    animation-delay: 0.3s;
}

.stat-item:nth-child(4) {
    animation-delay: 0.4s;
}
</style>

<!-- Dashboard Content -->
<div class="dashboard-container">
    <!-- Hero Section -->
    <div class="dashboard-hero">
        <div class="dashboard-hero-content">
            <p class="dashboard-subtitle">Welkom terug, <?= htmlspecialchars($_SESSION['gebruikersnaam']) ?></p>
            <span class="admin-badge">
                <span>👑</span>
                Administrator
            </span>
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
            <p class="card-description">Controleer en keur filmmaker portfolios goed voordat ze online gaan.</p>
            <span class="card-action">Modereer portfolios</span>
        </a>

        <a href="teambeheer.php" class="dashboard-card card-primary">
            <span class="card-icon">👥</span>
            <h3 class="card-title">Teambeheer</h3>
            <p class="card-description">Beheer teamleden, voeg nieuwe leden toe, bewerk profielen en verwijder leden.
            </p>
            <span class="card-action">Beheer team</span>
        </a>

        <a href="contact_berichten.php" class="dashboard-card card-info">
            <span class="card-icon">📧</span>
            <h3 class="card-title">Contact Berichten</h3>
            <p class="card-description">Bekijk en beheer alle berichten die via het contactformulier zijn verzonden.</p>
            <span class="card-action">Bekijk berichten</span>
        </a>

        <a href="email_bestanden.php" class="dashboard-card card-warning">
            <span class="card-icon">📁</span>
            <h3 class="card-title">E-mail Bestanden</h3>
            <p class="card-description">Bekijk e-mail bestanden die lokaal zijn opgeslagen tijdens ontwikkeling.</p>
            <span class="card-action">Bekijk bestanden</span>
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
</div>

<?php include '../inc/footer.php'; ?>