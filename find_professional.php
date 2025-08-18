<?php
include 'inc/header.php';
?>

<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

.page-header {
    background-image: url('uploads/findprof.jpg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    height: 95vh !important;
    width: 116% !important;
    position: relative;
    overflow: hidden;
    margin-left: -88px !important;
    margin-top: -45px !important;
    border-radius: 0 !important;
}

.content-text {
    text-align: center;
    padding: 3rem 2rem;
    max-width: 1100px;
    margin: 0 auto;
    line-height: 1.25;
    font-size: 1rem;
}

.content-text p {
    margin-bottom: 1rem;
}

.content-text strong {
    color: rgba(0, 130, 137, 1);
}

.professionals-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 2rem;
    padding: 3rem 2rem;
    max-width: 2000px;
    margin: 0 auto;
}

.professional-card {
    background-color: #1a1a1a;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.professional-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.card-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #333;
}

.card-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    height: 55%;
}

.card-content h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.skills {
    color: #ccc;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    line-height: 1.4;
    text-align: left;
}

.skills-container {
    margin-bottom: 1rem;
    flex-grow: 1;
    min-height: 0;
}

.details-btn {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    flex-shrink: 0;
}

.details-btn:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
}

@media (max-width: 1200px) {
    .professionals-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 900px) {
    .professionals-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 600px) {
    .professionals-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        padding: 2rem 1rem;
    }
}

@media (max-width: 400px) {
    .professionals-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="page-header">
</div>

<div class="content-text">
    <p>Discover our talented pool of professionals in the film industry.</p>
    <p>Browse their impressive portfolios and connect directly with actors, production assistants, photographers,
        designers, and more.</p>
    <p>The BFF portfolios are supported by Foundation Dichter bij Huis.</p>
    <br>
    <p><strong>Crew connection:</strong> Everyone on this page can be contacted without mediation costs. In addition to
        these 50 participants, we have another 200 people in our database with a background in the film sector from
        beginners to very experienced professionals. If you want custom crew, this is possible for a handling fee of
        10%. This goes entirely to the foundation. We have a non-profit focus at Buddy Film Foundation.</p>
    <p><strong>More information:</strong> info@buddyfilmfoundation.com & 020 2441080</p>
</div>

<div class="professionals-grid">
    <!-- Row 1 -->
    <div class="professional-card">
        <img src="uploads/prof/Wael-Kadlo.jpg" alt="Wael Kadlo" class="card-image">
        <div class="card-content">
            <h3>Wael Kadlo</h3>
            <div class="skills-container">
                <p class="skills">•Actor</p>
                <p class="skills">• Filmmaker</p>
                <p class="skills">• Film Editor</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Kataryna-Golovina.jpg" alt="Kataryna Golovina" class="card-image">
        <div class="card-content">
            <h3>Kataryna Golovina</h3>
            <div class="skills-container">
                <p class="skills">• Makeup Artist</p>
                <p class="skills">• Hairstylist</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Ferhad-Vilkiji.jpg" alt="Farhad Vilkiji" class="card-image">
        <div class="card-content">
            <h3>Farhad Vilkiji</h3>
            <div class="skills-container">
                <p class="skills">• Costume Designer</p>
                <p class="skills">• Production Designer</p>
                <p class="skills">• Art Director</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Issam-Almiski.jpg" alt="Issam Almiski" class="card-image">
        <div class="card-content">
            <h3>Issam Almiski</h3>
            <div class="skills-container">
                <p class="skills">• Actor</p>
                <p class="skills">• Writer</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Arya-Jalili.jpg" alt="Arya Jalili" class="card-image">
        <div class="card-content">
            <h3>Arya Jalili</h3>
            <div class="skills-container">
                <p class="skills">• Videographer</p>
                <p class="skills">• Video Editor</p>
                <p class="skills">• Drone Operator</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 2 -->
    <div class="professional-card">
        <img src="uploads/prof/samer-abdul-fattah.jpg" alt="Samer Abdul Fattah" class="card-image">
        <div class="card-content">
            <h3>Samer Abdul Fattah</h3>
            <div class="skills-container">
                <p class="skills">• Screen Writer</p>
                <p class="skills">• Actor</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/julie-nakzi.jpg" alt="Julie Nakzi" class="card-image">
        <div class="card-content">
            <h3>Julie Nakzi</h3>
            <div class="skills-container">
                <p class="skills">• Photographer</p>
                <p class="skills">• Filmmaker</p>
            </div>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Shaba-Namdar.jpg" alt="Shaba Namdar" class="card-image">
        <div class="card-content">
            <h3>Shaba Namdar</h3>
            <p class="skills">• Screenwriter</p>
            <p class="skills">• Director</p>
            <p class="skills">• Editor</p>
            <p class="skills">• Actor • Animator</p>
            <p class="skills">• Music maker</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Reza-Golestani.jpg" alt="Reza Golestani" class="card-image">
        <div class="card-content">
            <h3>Reza Golestani</h3>
            <p class="skills">• Writer</p>
            <p class="skills">• Director</p>
            <p class="skills">• Actor</p>
            <p class="skills">• Editor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Maya-Jaber.jpg" alt="Maya Jaber" class="card-image">
        <div class="card-content">
            <h3>Maya Jaber</h3>
            <p class="skills">• Actress</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 3 -->
    <div class="professional-card">
        <img src="uploads/prof/Omar-Mohammad.jpg" alt="Omar Mohammad" class="card-image">
        <div class="card-content">
            <h3>Omar Mohammad</h3>
            <p class="skills">• Screen Writer</p>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Amin-Talaei.jpg" alt="Amin Talaei" class="card-image">
        <div class="card-content">
            <h3>Amin Talaei</h3>
            <p class="skills">• Cameraman</p>
            <p class="skills">• Lights Assistant</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Nour-Mardini.jpg" alt="Nour Mardini" class="card-image">
        <div class="card-content">
            <h3>Nour Mardini</h3>
            <p class="skills">• Actor</p>
            <p class="skills">• Director</p>
            <p class="skills">• Musician</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Maen-Sawwan.jpg" alt="Maen Sawwan" class="card-image">
        <div class="card-content">
            <h3>Maen Sawwan</h3>
            <p class="skills">• 3D Generalist</p>
            <p class="skills">• 2D Motion Designer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Elham-Ghoreishi.jpg" alt="Elham Ghoreishi" class="card-image">
        <div class="card-content">
            <h3>Elham Ghoreishi</h3>
            <p class="skills">• Writer</p>
            <p class="skills">• Painter</p>
            <p class="skills">• Actress</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 4 -->
    <div class="professional-card">
        <img src="uploads/prof/Alaa-Shehada.jpg" alt="Alaa Shehada" class="card-image">
        <div class="card-content">
            <h3>Alaa Shehada</h3>
            <p class="skills">• Actor</p>
            <p class="skills">• Theater Maker</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Slava-Garmash.jpg" alt="Slava Garmash" class="card-image">
        <div class="card-content">
            <h3>Slava Garmash</h3>
            <p class="skills">• Director</p>
            <p class="skills">• Producer</p>
            <p class="skills">• Writer</p>
            <p class="skills">• TV host</p>
            <p class="skills">• Journalist</p>
            <p class="skills">• Teacher</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Thaeer-Muhreez.jpg" alt="Thaeer Muhreez" class="card-image">
        <div class="card-content">
            <h3>Thaeer Muhreez</h3>
            <p class="skills">• Filmmaker</p>
            <p class="skills">• Content Creator</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Saeed-Alhammad.jpg" alt="Saeed Alhammad" class="card-image">
        <div class="card-content">
            <h3>Saeed Alhammad</h3>
            <p class="skills">• Director of Photography</p>
            <p class="skills">• Photographer</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Filmon-Kiros.jpg" alt="Filmon Kiros" class="card-image">
        <div class="card-content">
            <h3>Filmon Kiros</h3>
            <p class="skills">• Writer</p>
            <p class="skills">• Director</p>
            <p class="skills">• Camera Assistant</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 5 -->
    <div class="professional-card">
        <img src="uploads/prof/Kimo-Kamiran-Sindi.jpg" alt="Kimo Kamiran Sindi" class="card-image">
        <div class="card-content">
            <h3>Kimo Kamiran Sindi</h3>
            <p class="skills">• Camera Operator</p>
            <p class="skills">• Editor</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Eugene-Kuzmenko.jpg" alt="Eugene Kuzmenko" class="card-image">
        <div class="card-content">
            <h3>Eugene Kuzmenko</h3>
            <p class="skills">• Camera Operator</p>
            <p class="skills">• Lightening</p>
            <p class="skills">• Editor</p>
            <p class="skills">• Recording</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Frere-Remi.jpg" alt="Frere Remi" class="card-image">
        <div class="card-content">
            <h3>Frere Remi</h3>
            <p class="skills">• Singer</p>
            <p class="skills">• Song-writer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Yazan-Al-Hakim.jpg" alt="Yazan Al Hakim" class="card-image">
        <div class="card-content">
            <h3>Yazan Al Hakim</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Kabir-Tarak.jpg" alt="Kabir Tarak" class="card-image">
        <div class="card-content">
            <h3>Kabir Tarak</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 6 -->
    <div class="professional-card">
        <img src="uploads/prof/Tarek-Al-Muazen.jpg" alt="Tarek Al Muazen" class="card-image">
        <div class="card-content">
            <h3>Tarek Al Muazen</h3>
            <p class="skills">• Editor</p>
            <p class="skills">• Sound Designer</p>
            <p class="skills">• Music Producer</p>
            <p class="skills">• Live Musician</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Milena-Kompaniiets.jpg" alt="Milena Kompaniiets" class="card-image">
        <div class="card-content">
            <h3>Milena Kompaniiets</h3>
            <p class="skills">• Actress</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Zanyar-Mohammadi.jpg" alt="Zanyar Mohammadi" class="card-image">
        <div class="card-content">
            <h3>Zanyar Mohammadi</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Ahmed-AlAmoudi.jpg" alt="Ahmed AlAmoudi" class="card-image">
        <div class="card-content">
            <h3>Ahmed AlAmoudi</h3>
            <p class="skills">• Director of Photography</p>
            <p class="skills">• Camera Operator</p>
            <p class="skills">• 1st & 2nd Assistant Camera</p>
            <p class="skills">• Lighting Technician</p>
            <p class="skills">• Gripper</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Said-Rasouli.jpg" alt="Said Rasouli" class="card-image">
        <div class="card-content">
            <h3>Said Rasouli</h3>
            <p class="skills">• Photographer</p>
            <p class="skills">• Videographer</p>
            <p class="skills">• Actor</p>

            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 7 -->
    <div class="professional-card">
        <img src="uploads/prof/Koorosh-Cyrus-Esfandiari.jpg" alt="Koorosh Cyrus Esfandiari" class="card-image">
        <div class="card-content">
            <h3>Koorosh Cyrus Esfandiari</h3>
            <p class="skills">• Actor</p>
            <p class="skills">• Writer</p>
            <p class="skills">• Director</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Sally-Jabour.jpg" alt="Sally Jabour" class="card-image">
        <div class="card-content">
            <h3>Sally Jabour</h3>
            <p class="skills">• Actress</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Ramez-Basheer.jpg" alt="Ramez Basheer" class="card-image">
        <div class="card-content">
            <h3>Ramez Basheer</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Meysam-Forooz.jpg" alt="Meysam Forooz" class="card-image">
        <div class="card-content">
            <h3>Meysam Forooz</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Alka-Sadat.jpg" alt="Alka Sadat" class="card-image">
        <div class="card-content">
            <h3>Alka Sadat</h3>
            <p class="skills">• Filmmaker</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 8 -->
    <div class="professional-card">
        <img src="uploads/prof/Amani-Al-Omaisi.jpg" alt="Amani Al-Omaisi" class="card-image">
        <div class="card-content">
            <h3>Amani Al-Omaisi</h3>
            <p class="skills">• Photographer</p>
            <p class="skills">• Director Assistant</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Ziyod-Yunus.jpg" alt="Ziyod Yunus" class="card-image">
        <div class="card-content">
            <h3>Ziyod Yunus</h3>
            <p class="skills">• Artist</p>
            <p class="skills">• Actor</p>
            <p class="skills">• Dancer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Foad-Dehqanpour.jpg" alt="Foad Dehqanpour" class="card-image">
        <div class="card-content">
            <h3>Foad Dehqanpour</h3>
            <p class="skills">• Writer</p>
            <p class="skills">• Film Producer</p>
            <p class="skills">• Graphic Designer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Somar-Jalbout.jpg" alt="Somar Jalbout" class="card-image">
        <div class="card-content">
            <h3>Somar Jalbout</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Mohamed-Al-Tayeb.jpg" alt="Mohamed Al Tayeb" class="card-image">
        <div class="card-content">
            <h3>Mohamed Al Tayeb</h3>
            <p class="skills">• Musician</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 9 -->
    <div class="professional-card">
        <img src="uploads/prof/Mohammad-Qahees.jpg" alt="Mohammad Qahees" class="card-image">
        <div class="card-content">
            <h3>Mohammad Qahees</h3>
            <p class="skills">• Photographer</p>
            <p class="skills">• Videographer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Yamen-Khalil.jpg" alt="Yamen Khalil" class="card-image">
        <div class="card-content">
            <h3>Yamen Khalil</h3>
            <p class="skills">• Filmmaker</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Mohammad-Turkawi.jpg" alt="Mohammad Turkawi" class="card-image">
        <div class="card-content">
            <h3>Mohammad Turkawi</h3>
            <p class="skills">• Film Director</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Elena-Rechych.jpg" alt="Elena Rechych" class="card-image">
        <div class="card-content">
            <h3>Elena Rechych</h3>
            <p class="skills">• Actress</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Aleksandra-Pershay.jpg" alt="Aleksandra Pershay" class="card-image">
        <div class="card-content">
            <h3>Aleksandra Pershay</h3>
            <p class="skills">• Stage and Costume Designer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 10 -->
    <div class="professional-card">
        <img src="uploads/prof/Leili-Khodae.jpg" alt="Leili Khodae" class="card-image">
        <div class="card-content">
            <h3>Leili Khodae</h3>
            <p class="skills">• Film Director</p>
            <p class="skills">• Writer</p>
            <p class="skills">• Poet</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Parviz-Baveh.jpg" alt="Parviz Baveh" class="card-image">
        <div class="card-content">
            <h3>Parviz Baveh</h3>
            <p class="skills">• Actor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/Mustafa-Staiti.jpg" alt="Mustafa Staiti" class="card-image">
        <div class="card-content">
            <h3>Mustafa Staiti</h3>
            <p class="skills">• Director</p>
            <p class="skills">• Public Speaker</p>
            <p class="skills">• Editor</p>
            <p class="skills">• Cameraman</p>
            <button class="details-btn">More details</button>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>