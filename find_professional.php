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
        <img src="uploads/prof/default-profile.jpg" alt="Professional 11" class="card-image">
        <div class="card-content">
            <h3>Professional 11</h3>
            <p class="skills">Actor • Voice Over</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/default-profile.jpg" alt="Professional 12" class="card-image">
        <div class="card-content">
            <h3>Professional 12</h3>
            <p class="skills">Editor • Post Production</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/default-profile.jpg" alt="Professional 13" class="card-image">
        <div class="card-content">
            <h3>Professional 13</h3>
            <p class="skills">Cinematographer • DOP</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/default-profile.jpg" alt="Professional 14" class="card-image">
        <div class="card-content">
            <h3>Professional 14</h3>
            <p class="skills">Makeup Artist • Special Effects</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/prof/default-profile.jpg" alt="Professional 15" class="card-image">
        <div class="card-content">
            <h3>Professional 15</h3>
            <p class="skills">Costume Designer • Wardrobe</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 4 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 16" class="card-image">
        <div class="card-content">
            <h3>Professional 16</h3>
            <p class="skills">Set Designer • Art Director</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 17" class="card-image">
        <div class="card-content">
            <h3>Professional 17</h3>
            <p class="skills">Sound Designer • Mixer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 18" class="card-image">
        <div class="card-content">
            <h3>Professional 18</h3>
            <p class="skills">Grip • Electrician</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 19" class="card-image">
        <div class="card-content">
            <h3>Professional 19</h3>
            <p class="skills">Location Manager • Scout</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 20" class="card-image">
        <div class="card-content">
            <h3>Professional 20</h3>
            <p class="skills">Casting Director • Agent</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 5 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 21" class="card-image">
        <div class="card-content">
            <h3>Professional 21</h3>
            <p class="skills">Stunt Coordinator • Performer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 22" class="card-image">
        <div class="card-content">
            <h3>Professional 22</h3>
            <p class="skills">Colorist • Grading</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 23" class="card-image">
        <div class="card-content">
            <h3>Professional 23</h3>
            <p class="skills">VFX Artist • Compositor</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 24" class="card-image">
        <div class="card-content">
            <h3>Professional 24</h3>
            <p class="skills">Animator • Motion Graphics</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 25" class="card-image">
        <div class="card-content">
            <h3>Professional 25</h3>
            <p class="skills">Production Manager • Line Producer</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 6 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 26" class="card-image">
        <div class="card-content">
            <h3>Professional 26</h3>
            <p class="skills">Assistant Director • AD</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 27" class="card-image">
        <div class="card-content">
            <h3>Professional 27</h3>
            <p class="skills">Script Supervisor • Continuity</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 28" class="card-image">
        <div class="card-content">
            <h3>Professional 28</h3>
            <p class="skills">Boom Operator • Audio</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 29" class="card-image">
        <div class="card-content">
            <h3>Professional 29</h3>
            <p class="skills">Key Grip • Rigging</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 30" class="card-image">
        <div class="card-content">
            <h3>Professional 30</h3>
            <p class="skills">Best Boy • Electric</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 7 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 31" class="card-image">
        <div class="card-content">
            <h3>Professional 31</h3>
            <p class="skills">Props Master • Set Dressing</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 32" class="card-image">
        <div class="card-content">
            <h3>Professional 32</h3>
            <p class="skills">Hair Stylist • Wigs</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 33" class="card-image">
        <div class="card-content">
            <h3>Professional 33</h3>
            <p class="skills">Wardrobe Assistant • Costumes</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 34" class="card-image">
        <div class="card-content">
            <h3>Professional 34</h3>
            <p class="skills">Transportation • Driver</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 35" class="card-image">
        <div class="card-content">
            <h3>Professional 35</h3>
            <p class="skills">Catering • Craft Services</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 8 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 36" class="card-image">
        <div class="card-content">
            <h3>Professional 36</h3>
            <p class="skills">Security • Set Protection</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 37" class="card-image">
        <div class="card-content">
            <h3>Professional 37</h3>
            <p class="skills">Medical • First Aid</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 38" class="card-image">
        <div class="card-content">
            <h3>Professional 38</h3>
            <p class="skills">Still Photographer • BTS</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 39" class="card-image">
        <div class="card-content">
            <h3>Professional 39</h3>
            <p class="skills">Drone Pilot • Aerial</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 40" class="card-image">
        <div class="card-content">
            <h3>Professional 40</h3>
            <p class="skills">Steadicam Operator • Stabilization</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 9 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 41" class="card-image">
        <div class="card-content">
            <h3>Professional 41</h3>
            <p class="skills">DIT • Digital Imaging</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 42" class="card-image">
        <div class="card-content">
            <h3>Professional 42</h3>
            <p class="skills">Data Manager • Media</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 43" class="card-image">
        <div class="card-content">
            <h3>Professional 43</h3>
            <p class="skills">Loader • Camera Assistant</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 44" class="card-image">
        <div class="card-content">
            <h3>Professional 44</h3>
            <p class="skills">Focus Puller • 1st AC</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 45" class="card-image">
        <div class="card-content">
            <h3>Professional 45</h3>
            <p class="skills">2nd AC • Clapper</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <!-- Row 10 -->
    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 46" class="card-image">
        <div class="card-content">
            <h3>Professional 46</h3>
            <p class="skills">Trainee • Intern</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 47" class="card-image">
        <div class="card-content">
            <h3>Professional 47</h3>
            <p class="skills">Runner • PA</p>
            <button class="details-btn">More details</button>
        </div>
    </div>

    <div class="professional-card">
        <img src="uploads/profielfotos/default-profile.jpg" alt="Professional 48" class="card-image">
        <div class="card-content">
            <h3>Professional 48</h3>
            <p class="skills">Extra • Background</p>
            <button class="details-btn">More details</button>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>