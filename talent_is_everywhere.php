<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';
?>
<style>
@font-face {
    font-family: 'Prism';
    src: url('Prism-Regular.otf') format('opentype');
    font-weight: normal;
    font-style: normal;
}

body {
    background-color: black;
    color: white;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    font-size: 1rem;
    line-height: 1.5;
}

/* Heading Styles */
h1, h2, h3 {
    font-family: 'Prism', 'Segoe UI', sans-serif;
    font-weight: normal;
    font-style: normal;
}

h1 {
    font-size: 3rem;
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 3px;
}

h2 {
    font-size: 2.5rem;
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 1px;
}

h3 {
    font-size: 2rem;
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Hero Section */
.hero-section {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 0;
    margin: 0;
    position: relative;
    overflow: hidden;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.4;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.hero-title {
    color: rgba(0, 130, 137, 1);
    font-size: 3rem;
    font-weight: bold;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 3px;
}

.hero-subtitle {
    color: #e0e0e0;
    font-size: 1.5rem;
    font-weight: 300;
    line-height: 1.6;
}

.hero-description {
    color: #ccc;
    font-size: 1.2rem;
    font-style: italic;
}

/* Content Section */
.content-section {
    background-color: black;
    padding: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.content-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    text-align: justify;
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Video Section */
.video-section {
    background-color: black;
    padding: 3rem;
    margin-bottom: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.video-container {
    position: relative;
    width: 100%;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.video-container iframe {
    border-radius: 10px;
    transition: transform 0.3s ease;
}

.video-container iframe:hover {
    transform: scale(1.02);
}

/* Responsive Design */
@media (max-width: 768px) {
    h1 {
        font-size: 2.5rem;
    }
    
    h2 {
        font-size: 2rem;
    }
    
    h3 {
        font-size: 1.5rem;
    }

    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .hero-description {
        font-size: 1rem;
    }

    .content-section {
        padding: 2rem;
        margin: 1rem;
    }

    .section-title {
        font-size: 2rem;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">TALENT IS EVERYWHERE</h1>
    </div>
</div>

<!-- Content Section -->
<div class="content-section">
    <div class="content-text">
        <p>
            We believe that by helping our members slip directly into paid jobs in their domain of interest, is the best
            way to assimilate and have a meaningful journey into full integration. Work offers a person stability,
            income, social contacts, development and a certain social status. Especially when you find work in the field
            you actually want to work in; it gives an extra motivation, it creates positive energy and we get to hear
            and see the stories that only they can tell. It really is a win-win. Talent is everywhere.
        </p>
    </div>
</div>

<!-- Video Section -->
<div class="video-section">
    <div class="video-container">
        <iframe width="100%" height="500" src="https://www.youtube.com/embed/kBRr5_mirSM"
            title="Talent is Everywhere Video" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen>
        </iframe>
    </div>
</div>

<?php include 'inc/footer.php'; ?>