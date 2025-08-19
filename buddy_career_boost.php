<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';
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
    overflow-x: hidden;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%), url('uploads/BCB/BCB.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 0;
    position: relative;
    overflow: hidden;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-top: -50px;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
}

.hero-title {
    color: rgba(0, 130, 137, 1);
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
}

.hero-subtitle {
    color: #e0e0e0;
    font-size: 1.5rem;
    margin-bottom: 2rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

/* What is Buddy Career Boost Section */
.buddy-career-section {
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%), url('uploads/BCB/BCB.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 0;
    position: relative;
    overflow: hidden;
    height: 100vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

.buddy-career-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
}

.buddy-career-title {
    color: rgba(0, 130, 137, 1);
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
}

.buddy-career-text {
    color: #e0e0e0;
    font-size: 1.5rem;
    margin-bottom: 2rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

/* Features Grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.feature-card {
    background-color: #2a2a2a;
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid #444;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
}

.feature-card:nth-child(1) {
    background-color: #d3d3d3;
    color: #333;
}

.feature-card:nth-child(2) {
    background-color: #a0a0a0;
    color: #333;
}

.feature-card:nth-child(3) {
    background-color: #808080;
    color: #333;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.feature-icon {
    font-size: 3rem;
    color: rgba(0, 130, 137, 1);
    margin-bottom: 1rem;
}

.feature-title {
    color: #333;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.feature-text {
    color: #333;
    font-size: 1rem;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 768px) {

    .hero-title,
    .buddy-career-title {
        font-size: 2rem;
    }

    .hero-subtitle,
    .buddy-career-text {
        font-size: 1.1rem;
    }

    .features-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .feature-card {
        padding: 1.5rem;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Buddy Career Boost</h1>
        <p class="hero-subtitle">A training program for newcomer film & TV professionals in the Netherlands.</p>
    </div>
</div>

<?php include 'inc/footer.php'; ?>