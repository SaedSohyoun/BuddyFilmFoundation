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
    background: linear-gradient(135deg, rgba(99, 65, 89, 0.7) 0%, rgba(0, 0, 0, 0.5) 100%), url('uploads/WTF/WTF.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 0;
    position: relative;
    overflow: hidden;
    height: 140vh;
    width: 100vw;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-top: -50px;
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

/* Support Section */
.support-section {
    background-color: #000000ff;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    margin-top: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.support-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.support-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.support-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.donate-btn {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
    margin-bottom: 2rem;
    cursor: pointer;
}

.donate-btn:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
}

.payment-methods {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.payment-method {
    height: 30px;
    width: auto;
    filter: grayscale(100%);
    transition: filter 0.3s ease;
}

.payment-method:hover {
    filter: grayscale(0%);
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

/* Real Life Stories Section */
.real-life-stories-section {
    background-color: black;
    padding: 3rem;
    margin-bottom: 3rem;
    margin-top: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.real-life-stories-content {
    text-align: left;
}

.real-life-stories-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    text-align: justify;
}

/* Film References Section */
.film-references-section {
    background-color: black;
    padding: 3rem;
    margin-bottom: 3rem;
    margin-top: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.film-references-content {
    text-align: center;
}

.film-references-grid {
    display: flex;
    width: 100%;
    height: 400px;
    margin-top: 2rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.film-reference-item {
    flex: 1;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
}

.film-reference-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 2px;
    height: 100%;
    background-color: black;
    z-index: 2;
}

.film-reference-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.film-reference-text {
    color: white;
    font-size: 0.8rem;
    text-align: center;
    font-style: italic;
    margin-bottom: 1rem;
    opacity: 0.9;
    z-index: 3;
    position: relative;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 0.5rem;
    border-radius: 5px;
    max-width: 90%;
}

/* Stories Section */
.stories-section {
    background-color: black;
    padding: 3rem;
    margin-bottom: 3rem;
    margin-top: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.stories-content {
    text-align: left;
}

.stories-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    text-align: justify;
}

/* Actor References Section */
.actor-references-section {
    background-color: black;
    padding: 3rem;
    margin-bottom: 3rem;
    margin-top: 3rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
}

.actor-references-content {
    text-align: center;
}

.actor-references-grid {
    display: flex;
    width: 100%;
    height: 700px;
    margin-top: 2rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.actor-reference-item {
    flex: 1;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
}

.actor-reference-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 2px;
    height: 100%;
    background-color: black;
    z-index: 2;
}

.actor-reference-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.actor-reference-text {
    color: white;
    font-size: 0.8rem;
    text-align: center;
    font-style: italic;
    margin-bottom: 1rem;
    opacity: 0.9;
    z-index: 3;
    position: relative;
    background-color: rgba(0, 0, 0, 0.7);
    padding: 0.5rem;
    border-radius: 5px;
    max-width: 90%;
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">WELKOM</h1>
        <p class="hero-description">A film about loss, hope, starting over and love<br>(lots of love)</p>
    </div>
</div>

<!-- Support Us Section -->
<div class="support-section">
    <div class="support-content">
        <div>
            <img src="uploads/WTF/1200x675_edited.jpg" alt="Support Us" class="support-image">
        </div>
        <div>
            <h2 class="section-title">LOGLINE</h2>
            <p class="support-text">
                WELCOME is a light-hearted coming-of-age film that takes place in a dull Dutch village and revolves
                around the lives of the five main characters Tara, Hassan, Wilma, Shilêr and Ronnie.
                When the local supermarket starts a work experience project for refugees and shortly afterwards it is
                announced that the local asylum seekers center is going to close, everyone is confronted with their
                status in life and all the characters have to reinvent themselves.
                <br><br>
                Tina Fey & Amy Poehler in 'Sisters' (2015)
            </p>
        </div>
    </div>
</div>
</div>

<!-- Real Life Stories Section -->
<div class="real-life-stories-section">
    <div class="real-life-stories-content">
        <h2 class="section-title">REAL LIFE STORIES</h2>
        <p class="real-life-stories-text">
            The idea for this film is the reason why the Buddy Film Foundation was founded in 2017.
            <br><br>
            WELCOME is a movie written entirely for the available cast and crew we've met over the years. The story for
            the film is largely based on real stories, real people and real events. A film that brings together the
            stories that we have heard in recent years from our participants, of whose lives we have become a part and
            vice versa. WELCOME must become a film in which and with which they can show their talents and thereby
            definitively present their business card to the Dutch film sector. In this way we hope that our new film
            colleagues, from thirteen different countries, can continue their career in Dutch film, where their passion
            lies.
        </p>
    </div>
</div>

<!-- Film References Section -->
<div class="film-references-section">
    <div class="film-references-content">
        <div class="film-references-grid">
            <div class="film-reference-item">
                <img src="uploads/WTF/aliswedding1 (1).jpg" alt="Ali's Wedding" class="film-reference-image">
                <p class="film-reference-text">Helana Sawires & Osamah Sami in 'Ali's Wedding' (2017)</p>
            </div>

            <div class="film-reference-item">
                <img src="uploads/WTF/636491022696321825-LADYBIRD-1.jpg" alt="Lady Bird" class="film-reference-image">
                <p class="film-reference-text">Saoirse Ronan in 'Lady Bird'</p>
            </div>
        </div>
    </div>
</div>

<!-- Stories That Never Make The News Section -->
<div class="stories-section">
    <div class="stories-content">
        <h2 class="section-title">THE STORIES THAT NEVER MAKE THE NEWS</h2>
        <p class="stories-text">
            WELCOME is a film in which the diversity and ethnicity of the characters sometimes play a role and sometimes
            are just a given. Whether it concerns the larger or supporting roles, or even at the figurative level: it is
            a palette of the diversity that the Netherlands has to offer: young, old, disabled, LGBTQ+, migrant,
            refugee, immigrant, and native and from almost every conceivable cultural and ethnic background.
            <br><br>
            With WELCOME we want to offer a window to the stories that never make the news: the real world, in which
            people have to survive together, build their lives, make friends, fall in love, be angry and sad and come to
            unexpected insights into themselves.
            <br><br>
            The script for WELCOME was written by Dennis Overeem from an idea of filmmaker Beri Shalmashi and Dennis.
        </p>
    </div>
</div>

<!-- Actor References Section -->
<div class="actor-references-section">
    <div class="actor-references-content">
        <div class="actor-references-grid">
            <div class="actor-reference-item">
                <img src="uploads/WTF/arabi_ghibeh_welkom.jpg" alt="Arabi Ghibeh" class="actor-reference-image">
                <p class="actor-reference-text">Actor Arabi Ghibeh from Syria photographed by Bert Nijman</p>
            </div>
        </div>
    </div>
</div>
<!-- Actor References Section -->
<div class="actor-references-section">
    <div class="actor-references-content">
        <div class="actor-references-grid">
            <div class="actor-reference-item">
                <img src="uploads/WTF/filmrecensie-samba--olivier-nakache-en-eric-toledano.jpg" alt="Samba"
                    class="actor-reference-image">
                <p class="actor-reference-text">Actor Omar Sy in 'Samba' (2014)</p>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>