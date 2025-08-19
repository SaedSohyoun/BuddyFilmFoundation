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
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 4rem 0;
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.hero-title {
    color: rgba(0, 130, 137, 1);
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 3px;
}

.hero-subtitle {
    color: #e0e0e0;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 300;
    line-height: 1.6;
}

.hero-description {
    color: #ccc;
    font-size: 1.2rem;
    margin-bottom: 2rem;
    font-style: italic;
}

/* Content Sections */
.content-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.content-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.section-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1rem;
}

/* Image Grid */
.image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.image-card {
    background-color: #2a2a2a;
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #444;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.image-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.project-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    background-color: #1a1a1a;
}

.image-content {
    padding: 1.5rem;
}

.image-title {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.image-description {
    color: #ccc;
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Logline Section */
.logline-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border-radius: 15px;
    padding: 3rem;
    border: 1px solid rgba(0, 130, 137, 0.3);
    margin-bottom: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.logline-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.logline-text {
    color: #e0e0e0;
    font-size: 1.3rem;
    line-height: 1.8;
    font-style: italic;
    text-align: center;
    margin-bottom: 2rem;
}

.logline-reference {
    color: #ccc;
    font-size: 1rem;
    text-align: center;
    font-style: italic;
}

/* Two Column Layout */
.two-column {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
    margin-top: 2rem;
}

.text-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.image-column {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.single-image {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.single-image:hover {
    transform: scale(1.02);
}

.single-image img {
    width: 100%;
    height: auto;
    display: block;
}

/* Newsletter Section */
.newsletter-section {
    background: linear-gradient(135deg, rgba(226, 0, 185, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border-radius: 15px;
    padding: 3rem;
    border: 1px solid rgba(226, 0, 185, 0.3);
    margin-bottom: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
}

.newsletter-title {
    color: rgba(226, 0, 185, 1);
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.newsletter-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.newsletter-form {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    max-width: 500px;
    margin: 0 auto;
}

.newsletter-input {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 30px;
    font-size: 1rem;
    flex: 1;
    min-width: 250px;
    transition: all 0.3s ease;
}

.newsletter-input:focus {
    outline: none;
    border-color: rgba(226, 0, 185, 1);
    box-shadow: 0 0 0 0.2rem rgba(226, 0, 185, 0.25);
}

.newsletter-btn {
    background: linear-gradient(135deg, rgba(226, 0, 185, 1) 0%, rgba(180, 0, 150, 1) 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 30px;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    white-space: nowrap;
}

.newsletter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(226, 0, 185, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .hero-description {
        font-size: 1rem;
    }

    .content-section,
    .logline-section,
    .newsletter-section {
        padding: 2rem;
        margin: 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .two-column {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .image-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .newsletter-form {
        flex-direction: column;
        align-items: center;
    }

    .newsletter-input {
        min-width: 200px;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">WELKOM</h1>
        <p class="hero-description">A film about loss, hope, starting over and love<br>(lots of love)</p>
    </div>
</div>

<!-- Main Content -->
<div class="content-section">
    <div class="two-column">
        <div class="text-column">
            <h2 class="section-title">About the Film</h2>
            <p class="section-text">WELCOME is a light-hearted coming-of-age film that takes place in a dull Dutch
                village and revolves around the lives of the five main characters Tara, Hassan, Wilma, Shilêr and
                Ronnie.</p>
            <p class="section-text">When the local supermarket starts a work experience project for refugees and shortly
                afterwards it is announced that the local asylum seekers center is going to close, everyone is
                confronted with their status in life and all the characters have to reinvent themselves.</p>
        </div>
        <div class="image-column">
            <div class="single-image">
                <img src="uploads/welkom/w.png" alt="Welkom Film Poster">
            </div>
            <div class="single-image">
                <img src="uploads/welkom/1200x675_edited.jpg" alt="Welkom Film Scene">
            </div>
        </div>
    </div>
</div>

<!-- Logline Section -->
<div class="logline-section">
    <h2 class="logline-title">Logline</h2>
    <p class="logline-text">"A light-hearted coming-of-age film about reinvention and hope in a small Dutch village."
    </p>
    <p class="logline-reference">Inspired by films like 'Sisters' (2015) starring Tina Fey & Amy Poehler</p>
</div>

<!-- Real Life Stories -->
<div class="content-section">
    <h2 class="section-title">Real Life Stories</h2>
    <p class="section-text">The idea for this film is the reason why the Buddy Film Foundation was founded in 2017.</p>
    <p class="section-text">WELCOME is a movie written entirely for the available cast and crew we've met over the
        years. The story for the film is largely based on real stories, real people and real events. A film that brings
        together the stories that we have heard in recent years from our participants, of whose lives we have become a
        part and vice versa.</p>
    <p class="section-text">WELCOME must become a film in which and with which they can show their talents and thereby
        definitively present their business card to the Dutch film sector. In this way we hope that our new film
        colleagues, from thirteen different countries, can continue their career in Dutch film, where their passion
        lies.</p>

    <div class="image-grid">
        <div class="image-card">
            <img src="uploads/welkom/aliswedding1.jpg" alt="Ali's Wedding" class="project-image">
            <div class="image-content">
                <h3 class="image-title">Helana Sawires & Osamah Sami</h3>
                <p class="image-description">in 'Ali's Wedding' (2017)</p>
            </div>
        </div>
        <div class="image-card">
            <img src="uploads/welkom/636491022696321825-LADYBIRD-1-.jpg.webp" alt="Lady Bird" class="project-image">
            <div class="image-content">
                <h3 class="image-title">Saoirse Ronan</h3>
                <p class="image-description">in 'Lady Bird' (2017)</p>
            </div>
        </div>
    </div>
</div>

<!-- Stories That Never Make the News -->
<div class="content-section">
    <h2 class="section-title">The Stories That Never Make the News</h2>
    <p class="section-text">WELCOME is a film in which the diversity and ethnicity of the characters sometimes play a
        role and sometimes are just a given. Whether it concerns the larger or supporting roles, or even at the
        figurative level: it is a palette of the diversity that the Netherlands has to offer: young, old, disabled,
        LGBTQ+, migrant, refugee, immigrant, and native and from almost every conceivable cultural and ethnic
        background.</p>
    <p class="section-text">With WELCOME we want to offer a window to the stories that never make the news: the real
        world, in which people have to survive together, build their lives, make friends, fall in love, be angry and sad
        and come to unexpected insights into themselves.</p>
    <p class="section-text">The script for WELCOME was written by Dennis Overeem from an idea of filmmaker Beri
        Shalmashi and Dennis.</p>

    <div class="image-grid">
        <div class="image-card">
            <img src="uploads/welkom/arabi_ghibeh_welkom.jpg" alt="Actor Arabi Ghibeh" class="project-image">
            <div class="image-content">
                <h3 class="image-title">Actor Arabi Ghibeh from Syria</h3>
                <p class="image-description">photographed by Bert Nijman</p>
            </div>
        </div>
        <div class="image-card">
            <img src="uploads/welkom/filmrecensie-samba--olivier-nakache-en-eric-toledano.jpg" alt="Samba Film"
                class="project-image">
            <div class="image-content">
                <h3 class="image-title">Actor Omar Sy</h3>
                <p class="image-description">in 'Samba' (2014)</p>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
