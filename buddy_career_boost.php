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
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.hero-subtitle {
    color: #e0e0e0;
    font-size: 1.3rem;
    margin-bottom: 2rem;
    font-weight: 300;
    line-height: 1.6;
}

.call-to-action {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
    display: inline-block;
    margin-top: 1rem;
}

.call-to-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
    color: white;
    text-decoration: none;
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
    color: white;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.feature-text {
    color: #ccc;
    font-size: 1rem;
    line-height: 1.6;
}

/* Participants Grid */
.participants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.participant-card {
    background-color: #2a2a2a;
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #444;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.participant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.participant-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    background-color: #1a1a1a;
}

.participant-content {
    padding: 1.5rem;
}

.participant-name {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

/* Program Focus */
.program-focus {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.focus-card {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid rgba(0, 130, 137, 0.3);
    transition: all 0.3s ease;
}

.focus-card:hover {
    transform: translateY(-3px);
    border-color: rgba(0, 130, 137, 0.6);
}

.focus-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.focus-list {
    list-style: none;
    padding: 0;
}

.focus-list li {
    color: #e0e0e0;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.focus-list li::before {
    content: '•';
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
    position: absolute;
    left: 0;
}

/* Application Process */
.application-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.step-card {
    background-color: #2a2a2a;
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid #444;
    transition: all 0.3s ease;
    position: relative;
}

.step-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border-radius: 15px 15px 0 0;
}

.step-number {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.step-title {
    color: white;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.step-text {
    color: #ccc;
    font-size: 1rem;
    line-height: 1.6;
}

/* Contact Info */
.contact-info {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid rgba(0, 130, 137, 0.3);
    margin-top: 2rem;
}

.contact-info h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.contact-info p {
    color: #e0e0e0;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0.5rem;
}

.contact-info a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-info a:hover {
    color: white;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
    }

    .content-section {
        padding: 2rem;
        margin: 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .features-grid,
    .participants-grid,
    .program-focus,
    .application-steps {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .feature-card,
    .participant-card,
    .focus-card,
    .step-card {
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

<!-- What is Buddy Career Boost -->
<div class="content-section">
    <h2 class="section-title">What is Buddy Career Boost?</h2>
    <p class="section-text">The Buddy Career Boost is a training program for newcomers in the Netherlands with a
        background in film and television. Participants take part in workshops, training sessions, language lessons, and
        networking events.</p>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🎬</div>
            <h3 class="feature-title">Workshops & Training</h3>
            <p class="feature-text">Comprehensive workshops covering various aspects of film and television production.
            </p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🤝</div>
            <h3 class="feature-title">Networking Events</h3>
            <p class="feature-text">Connect with industry professionals and build your network in the Dutch film
                industry.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🇳🇱</div>
            <h3 class="feature-title">Dutch Language Lessons</h3>
            <p class="feature-text">Improve your Dutch language skills to better integrate into the local industry.</p>
        </div>
    </div>
</div>

<!-- Who is it for -->
<div class="content-section">
    <h2 class="section-title">Who is it for?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">🎭</div>
            <h3 class="feature-title">Film & TV Professionals</h3>
            <p class="feature-text">Professionals with film & TV experience from their home country.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏠</div>
            <h3 class="feature-title">Newcomers</h3>
            <p class="feature-text">Newcomers living in the Netherlands.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎨</div>
            <h3 class="feature-title">Various Disciplines</h3>
            <p class="feature-text">Open to various disciplines – directing, acting, sound design, editing, etc.</p>
        </div>
    </div>
</div>

<!-- What is the goal -->
<div class="content-section">
    <h2 class="section-title">What is the goal?</h2>
    <p class="section-text">Many people in our community face a knowledge gap due to long waiting periods, uncertainty,
        and a lack of opportunities to practice their craft. The Buddy Career Boost helps accelerate the integration of
        newcomer professionals into Dutch society by providing training in industry knowledge, entrepreneurship skills,
        and cultural adaptation.</p>
    <p class="section-text">The goal is to bridge this knowledge and cultural gap through workshops and training
        sessions while also introducing participants to industry networks and preparing them for the job market.</p>
</div>

<!-- 2024 Participants -->
<div class="content-section">
    <h2 class="section-title">2024 Participants</h2>
    <div class="participants-grid">
        <div class="participant-card">
            <img src="uploads/participants/1920_ayazsaadatpourvahid.jpg" alt="Ayaz Saadatpour Vahid"
                class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Ayaz Saadatpour Vahid</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/Obaid.jpg" alt="Obaid Ba-Obaid" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Obaid Ba-Obaid</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/o_edited.png" alt="Anoud Alhbaidi" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Anoud Alhbaidi</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/o_edited.png" alt="Razzaq Mawda" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Razzaq Mawda</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/Yevghen Kuzmenko by Maria Bodrug-5.jpg" alt="Yevhen Kuzmenko"
                class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Yevhen Kuzmenko</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/myriam_bw-1.jpg" alt="Myriam Bejaoui" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Myriam Bejaoui</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/DSC000001.JPG" alt="Shaba Namdar" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Shaba Namdar</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/Mohammad Turkawi by Maria Bodrug" alt="Mohammad Turkawi"
                class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Mohammad Turkawi</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/o_edited.png" alt="Ramy Azmy" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Ramy Azmy</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/524A9558.jpg" alt="Maen Sawwan" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Maen Sawwan</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/Sabrine Khoury.jpg" alt="Sabrine Khoury" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Sabrine Khoury</h3>
            </div>
        </div>
        <div class="participant-card">
            <img src="uploads/participants/1680047713344.jpeg" alt="Mohammad Alboushi" class="participant-image">
            <div class="participant-content">
                <h3 class="participant-name">Mohammad Alboushi</h3>
            </div>
        </div>
    </div>
</div>

<!-- Program Focus -->
<div class="content-section">
    <h2 class="section-title">Program Focus</h2>
    <p class="section-text">In 2024, the program will focus on post-production, covering areas such as editing, sound
        design, and emerging technologies like Virtual Production and AI.</p>
    <p class="section-text">The curriculum consists of three main themes:</p>

    <div class="program-focus">
        <div class="focus-card">
            <h3 class="focus-title">Post-production Skills</h3>
            <ul class="focus-list">
                <li>Post-production workflow</li>
                <li>VFX workshop</li>
                <li>Sound design workshop</li>
                <li>Virtual production workshop</li>
            </ul>
        </div>
        <div class="focus-card">
            <h3 class="focus-title">Language Proficiency</h3>
            <ul class="focus-list">
                <li>Weekly Dutch language lessons</li>
                <li>Dutch film history</li>
                <li>Cultural adaptation</li>
            </ul>
        </div>
        <div class="focus-card">
            <h3 class="focus-title">Personal Development</h3>
            <ul class="focus-list">
                <li>Entrepreneurship in the Netherlands</li>
                <li>The media industry in the Netherlands</li>
                <li>Networking skills</li>
            </ul>
        </div>
    </div>
</div>

<!-- How to Apply -->
<div class="content-section" id="apply">
    <h2 class="section-title">How to Apply</h2>
    <p class="section-text">The selection process consists of a group workshop and one on one meetings afterwards.</p>

    <div class="application-steps">
        <div class="step-card">
            <div class="step-number">1</div>
            <h3 class="step-title">ROUND 1</h3>
            <p class="step-text">Send a letter (max 1 page) with your motivation and CV (Resume). Or instead of a
                letter, you can choose to send in a recorded video of yourself with your motivation (via WeTransfer or
                Google Drive link).</p>
        </div>
        <div class="step-card">
            <div class="step-number">2</div>
            <h3 class="step-title">Submit Application</h3>
            <p class="step-text">Send it in to ahmed@buddyfilmfoundation.com.</p>
        </div>
        <div class="step-card">
            <div class="step-number">3</div>
            <h3 class="step-title">Questions?</h3>
            <p class="step-text">If you have any questions about the program you can mail Ahmed at his email as well or
                call the office number: +31 (0) 103 077 271</p>
        </div>
    </div>
</div>

<!-- Register for Next Phase -->
<div class="content-section">
    <h2 class="section-title">Register for the next phase of BCB-PRODUCTION!</h2>
    <p class="section-text">Are you an aspiring or emerging producer?</p>

    <p class="section-text">Do you have a passion for:</p>
    <ul class="focus-list">
        <li>Producing</li>
        <li>Production Management</li>
        <li>Line Producing</li>
        <li>Budgeting & Scheduling</li>
        <li>Or any other aspect of film production you'd like to grow in?</li>
    </ul>

    <p class="section-text">Are you new to the Netherlands and looking for guidance as you navigate the local film
        industry?</p>

    <p class="section-text">Then the Buddy Career Program is made for you.</p>

    <h3 style="color: rgba(0, 130, 137, 1); margin-top: 2rem;">Here is a quick sneak peek of the workshops we want to
        offer:</h3>
    <ul class="focus-list">
        <li>Production specific workshops from professionals from the industry</li>
        <li>Language courses</li>
        <li>Dutch Film Industry overview and history</li>
    </ul>

    <h3 style="color: rgba(0, 130, 137, 1); margin-top: 2rem;">Practical Points:</h3>
    <ul class="focus-list">
        <li>The BCB25 period runs from June 2025 to December 2025, 4-6 days per month.</li>
        <li>Participation is free and voluntary, but not without obligation. Therefore, we also ask you to sign a
            participation agreement.</li>
    </ul>

    <div class="contact-info">
        <h3>Contact Information</h3>
        <p><strong>Email:</strong> <a href="mailto:ahmed@buddyfilmfoundation.com">ahmed@buddyfilmfoundation.com</a></p>
        <p><strong>Phone:</strong> <a href="tel:+31103077271">+31 (0) 103 077 271</a></p>
    </div>
</div>

<?php include 'inc/footer.php'; ?>