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
    background-image: url('uploads/STM/STM.jpg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    height: 100vh !important;
    width: 116% !important;
    position: relative;
    overflow: hidden;
    margin-left: -88px !important;
    margin-top: -50px !important;
    border-radius: 0 !important;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header-content {
    text-align: center;
    z-index: 2;
    position: relative;
}

.header-content h1 {
    color: white;
    font-size: 3rem;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-top: -180px;
}

.about-project {
    padding: 4rem 0;
    margin-top: -30px;
    position: relative;
    z-index: 1;
}

.about-project .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.about-project h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.about-project p {
    color: #ccc;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.our-purpose {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.our-purpose .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.our-purpose h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.our-purpose p {
    color: #ccc;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.purpose-images {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 2rem;
    margin-top: 3rem;
    flex-wrap: wrap;
}

.image-item {
    flex: 1;
    max-width: 300px;
    min-width: 250px;
}

.purpose-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
}

.purpose-image:hover {
    transform: scale(1.05);
}

.collaborators {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.collaborators .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.collaborators h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.collaborator-grid {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.collaborator-item {
    display: flex;
    align-items: center;
    gap: 3rem;
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.2);
    transition: all 0.3s ease;
}

.collaborator-item:hover {
    background-color: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 130, 137, 0.4);
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.collaborator-logo {
    flex: 0 0 200px;
    text-align: center;
}

.logo-image {
    max-width: 100%;
    height: auto;
    max-height: 120px;
    object-fit: contain;
    filter: brightness(0) invert(1);
    transition: filter 0.3s ease;
}

.collaborator-item:hover .logo-image {
    filter: brightness(1) invert(0);
}

.collaborator-content {
    flex: 1;
}

.collaborator-content h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.collaborator-content p {
    color: #ccc;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.learn-more-btn {
    display: inline-block;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 0.5rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.learn-more-btn:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
    color: white;
    text-decoration: none;
}

@media (max-width: 1200px) {
    .stories-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .collaborator-item {
        flex-direction: column;
        text-align: center;
        gap: 2rem;
    }

    .collaborator-logo {
        flex: none;
        width: 100%;
    }
}

@media (max-width: 600px) {
    .stories-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 2rem 1rem;
    }

    .collaborator-item {
        padding: 1.5rem;
        gap: 1.5rem;
    }

    .collaborator-content h3 {
        font-size: 1.3rem;
    }

    .collaborator-content p {
        font-size: 0.9rem;
    }

    .logo-image {
        max-height: 80px;
    }
}

.winners {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.winners .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.winners h2 {
    color: rgba(0, 0, 0, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.winners-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
}

.winner-item {
    background-color: rgba(0, 130, 137, 1);
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.5);
    overflow: hidden;
    transition: all 0.3s ease;
}

.winner-item:hover {
    background-color: rgba(0, 130, 137, 0.8);
    border-color: rgba(0, 130, 137, 0.4);
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
}

.winner-image {
    width: 100%;
    height: 300px;
    overflow: hidden;
}

.winner-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.winner-item:hover .winner-photo {
    transform: scale(1.05);
}

.winner-content {
    padding: 2rem;
}

.winner-content h3 {
    color: rgba(0, 0, 0, 1);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.winner-content p {
    color: #ccc;
    font-size: 0.7rem;
    line-height: 1.6;
    margin-bottom: 0;
}

@media (max-width: 1200px) {
    .winners-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .winners-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 600px) {
    .winner-content {
        padding: 1.5rem;
    }

    .winner-content h3 {
        font-size: 1.3rem;
    }

    .winner-content p {
        font-size: 0.9rem;
    }

    .winner-image {
        height: 250px;
    }
}

.jury {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.jury .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.jury h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.jury-gallery {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    background-color: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(0, 130, 137, 0.2);
}

.jury-slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 400%;
}

.jury-item {
    width: 25%;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 3rem;
    min-height: 400px;
}

.jury-image {
    flex: 0 0 200px;
    height: 200px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid rgba(0, 130, 137, 0.3);
}

.jury-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.jury-item:hover .jury-photo {
    transform: scale(1.1);
}

.jury-content {
    flex: 1;
}

.jury-content h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.jury-content p {
    color: #ccc;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 0;
}

.gallery-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 130, 137, 0.8);
    border: none;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.gallery-nav:hover {
    background: rgba(0, 130, 137, 1);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
}

.prev-btn {
    left: 20px;
}

.next-btn {
    right: 20px;
}

@media (max-width: 1200px) {
    .jury-item {
        flex-direction: column;
        text-align: center;
        gap: 2rem;
        min-height: 500px;
    }

    .jury-image {
        flex: none;
        width: 150px;
        height: 150px;
    }
}

@media (max-width: 768px) {
    .jury-item {
        padding: 1.5rem;
        min-height: 450px;
    }

    .jury-content h3 {
        font-size: 1.3rem;
    }

    .jury-content p {
        font-size: 0.9rem;
    }

    .gallery-nav {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }
}

.winners-2022 {
    background-color: black;
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.winners-2022 .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.winners-2022 h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.winners-2022-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 3rem;
}

.winner-2022-item {
    background-color: transparent;
    border-radius: 0;
    border: none;
    overflow: hidden;
    transition: all 0.3s ease;
}

.winner-2022-item:hover {
    transform: translateY(-5px);
}

.winner-2022-image {
    width: 100%;
    height: 350px;
    overflow: hidden;
}

.winner-2022-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.winner-2022-item:hover .winner-2022-photo {
    transform: scale(1.05);
}

.winner-2022-content {
    padding: 2rem;
}

.winner-2022-content h3 {
    color: white;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.winner-2022-content p {
    color: white;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.winner-2022-content p:last-child {
    margin-bottom: 0;
}

@media (max-width: 1200px) {
    .winners-2022-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .winner-2022-content {
        padding: 1.5rem;
    }

    .winner-2022-content h3 {
        font-size: 1.3rem;
    }

    .winner-2022-content p {
        font-size: 0.9rem;
    }

         .winner-2022-image {
         height: 250px;
     }
 }
 
 .photo-gallery {
     background-color: black;
     padding: 4rem 0;
     position: relative;
     z-index: 1;
 }
 
 .photo-gallery .container {
     max-width: 1200px;
     margin: 0 auto;
     padding: 0 2rem;
 }
 
 .photo-gallery h2 {
     color: rgba(0, 130, 137, 1);
     font-size: 2.5rem;
     margin-bottom: 3rem;
     text-transform: uppercase;
     letter-spacing: 2px;
     text-align: center;
 }
 
 .photo-gallery-container {
     position: relative;
     overflow: hidden;
     border-radius: 15px;
     background-color: rgba(255, 255, 255, 0.05);
     border: 1px solid rgba(0, 130, 137, 0.2);
 }
 
 .photo-gallery-slider {
     display: flex;
     transition: transform 0.5s ease-in-out;
     width: 3100%;
 }
 
 .photo-gallery-item {
     width: 3.2258%;
     padding: 0.5rem;
     display: flex;
     align-items: center;
     justify-content: center;
 }
 
 .photo-gallery-image {
     width: 100%;
     height: 300px;
     object-fit: cover;
     border-radius: 10px;
     transition: transform 0.3s ease;
     cursor: pointer;
 }
 
 .photo-gallery-item:hover .photo-gallery-image {
     transform: scale(1.05);
     box-shadow: 0 10px 25px rgba(0, 130, 137, 0.3);
 }
 
 .photo-gallery-nav {
     position: absolute;
     top: 50%;
     transform: translateY(-50%);
     background: rgba(0, 130, 137, 0.8);
     border: none;
     color: white;
     width: 50px;
     height: 50px;
     border-radius: 50%;
     cursor: pointer;
     transition: all 0.3s ease;
     z-index: 10;
     display: flex;
     align-items: center;
     justify-content: center;
     font-size: 1.2rem;
 }
 
 .photo-gallery-nav:hover {
     background: rgba(0, 130, 137, 1);
     transform: translateY(-50%) scale(1.1);
     box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
 }
 
 .prev-photo-btn {
     left: 20px;
 }
 
 .next-photo-btn {
     right: 20px;
 }
 
 @media (max-width: 768px) {
     .photo-gallery-image {
         height: 200px;
     }
     
     .photo-gallery-nav {
         width: 40px;
         height: 40px;
         font-size: 1rem;
     }
     
     .prev-photo-btn {
         left: 10px;
     }
     
     .next-photo-btn {
         right: 10px;
     }
 }
 
 @media (max-width: 480px) {
     .photo-gallery-image {
         height: 150px;
     }
 }
 </style>

<div class="page-header">
    <div class="header-content">
        <h1>STORIES THAT MATTER</h1>
    </div>
</div>

<div class="about-project">
    <div class="container">
        <h2>About the project</h2>
        <p>We believe in a world where everybody should have an equal opportunity to tell their story.</p>
        <p>Together with Movies That Matter Film Festival and ReFOCUS Media Labs we developed Stories That Matter. We
            want to give starting and experienced film- and acting talents with a refugee background a chance to develop
            professionally.</p>
        <p>In 2020, our three organizations were ready to launch a two week Medialab for status holders and asylum
            seekers in The Netherlands and Camp Moria in Lesbos, Greece but Corona happened so we had to cancel the
            whole project. In April of 2022, we picked up where we left of.</p>
        <p>We celebrated their hard work and created a screening for cast and crew during the Movies That Matter Film
            Festival. We submitted the films to international film festivals. Because of the success of the 2022 pilot
            edition we aim to take 'Stories That Matter 2' to a next level in 2023.</p>
    </div>
</div>

<div class="our-purpose">
    <div class="container">
        <h2>Our purpose</h2>
        <p>4 short films will be produced which the participants can add to their portfolio.</p>
        <p>The one thing the participants have in common is that they are all filmmakers with a refugee background,
            located in various countries in Europe.</p>

        <div class="purpose-images">
            <div class="image-item">
                <img src="uploads/STM/Revenge.jpg" alt="Revenge Poster" class="purpose-image">
            </div>
            <div class="image-item">
                <img src="uploads/STM/Asmile.jpg" alt="Asmile Poster" class="purpose-image">
            </div>
        </div>
    </div>
</div>

<div class="collaborators">
    <div class="container">
        <h2>Collaborators</h2>

        <div class="collaborator-grid">
            <div class="collaborator-item">
                <div class="collaborator-logo">
                    <img src="uploads/STM/MTM.jpg" alt="Movies that Matter" class="logo-image">
                </div>
                <div class="collaborator-content">
                    <h3>Movies that Matter</h3>
                    <p>Movies that Matter wants to open people's eyes for human rights. They achieve their goal through
                        their annual Movies that Matter film festival, educational work, organizing events, with advice
                        inland and abroad, and the support of festivals worldwide.</p>
                    <a href="https://moviesthatmatter.nl/?gclid=CjwKCAjwiuuRBhBvEiwAFXKaNMbvVQsubnxefpd0035lhHGsEXSLqkt1QhjK1kFq90KDleHEAlwB_BoCrDcQAvD_BwE"
                        class="learn-more-btn" target="_blank">Learn more</a>
                </div>
            </div>

            <div class="collaborator-item">
                <div class="collaborator-content">
                    <h3>Buddy Film Foundation</h3>
                    <p>Buddy Film Foundation is a stepping stone for professional filmmakers with a refugee background
                        and gives assistance by expanding their professional network and supports by finding paid work
                        in the film industry through workshops, coaching and concrete film projects</p>
                    <a href="index.php" class="learn-more-btn">Learn more</a>
                </div>
                <div class="collaborator-logo">
                    <img src="uploads/STM/BFF.jpg" alt="Buddy Film Foundation" class="logo-image">
                </div>
            </div>

            <div class="collaborator-item">
                <div class="collaborator-logo">
                    <img src="uploads/STM/RML.jpg" alt="ReFOCUS Media Labs" class="logo-image">
                </div>
                <div class="collaborator-content">
                    <h3>ReFOCUS Media Labs</h3>
                    <p>ReFOCUS Media Labs is dedicated to creating a global network of media labs to equip asylum
                        seekers with modern media creation skills, engaging in school communities with interactive
                        events and media art installations, and has also produced feature-length documentary films with
                        their students.</p>
                    <a href="https://refocusmedialabs.org/refocus" class="learn-more-btn" target="_blank">Learn more</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="winners">
    <div class="container">
        <h2>Winners</h2>

        <div class="winners-grid">
            <div class="winner-item">
                <div class="winner-image">
                    <img src="uploads/STM/Atifa.jpg" alt="Atifa Akbari" class="winner-photo">
                </div>
                <div class="winner-content">
                    <h3>Atifa Akbari</h3>
                    <p>Atifa is 21 years old and was born in Mazar Sharif, Afghanistan. She is living in Stuttgart in
                        Germany for two years now and soon she will start her studies in directing. She is passionate
                        about photography, painting and lives an active life outdoors. Because she found it difficult to
                        express herself in the past, she started by writing in her journal and later illustrate her
                        ideas. With the help of Refocus Media labs, she will soon start directing her very first short
                        film.</p>
                </div>
            </div>

            <div class="winner-item">
                <div class="winner-image">
                    <img src="uploads/STM/Mohamad-Alzhouri.jpg" alt="Mohamad Alzhouri" class="winner-photo">
                </div>
                <div class="winner-content">
                    <h3>Mohamad Alzhouri</h3>
                    <p>Mohamad is 28 years old, born in Homs, Syria, and lived with his family in Damascus. He found his
                        love for the film when he worked for the first time on a set in 2009. Since then, he kept on
                        working in the industry as a make-up assistant, grip assistant, 2nd and 1st AC, and decoration
                        assistant. In 2010 he found a job opportunity in Lebanon where he improved his skills
                        considerably. In 2012 he decided to flee Syria together with his mother and sister to Lebanon.
                        In 2016 he migrated to the Netherlands. There he got in touch with the Buddy Film Foundation,
                        expanded his network, and worked on sets of movies like Toen Ik Je zag, Marokkaanse Bruiloft,
                        Boy Muts Gun, and others.</p>
                </div>
            </div>

            <div class="winner-item">
                <div class="winner-image">
                    <img src="uploads/STM/Tetiana.jpg" alt="Tetiana Komchatnykh" class="winner-photo">
                </div>
                <div class="winner-content">
                    <h3>Tetiana Komchatnykh</h3>
                    <p>Tetiana was born in the city of Sevastopol. She studied at the Crimean art school. She worked as
                        a florist almost all her life. In 2014, in connection with the occupation of Crimea by Russia,
                        she left for Kyiv, and in 2022 she fled to Krakow, Poland. Tetiana has a daughter. The last 3
                        years she's been learning about photography and editing at ReFocus Medialab.</p>
                </div>
            </div>

            <div class="winner-item">
                <div class="winner-image">
                    <img src="uploads/STM/Elham.jpg" alt="Elham Ghoreishi" class="winner-photo">
                </div>
                <div class="winner-content">
                    <h3>Elham Ghoreishi</h3>
                    <p>Elham Ghoreishi was born in 1980 in Tehran, Iran. She published an audiobook in Farsi based on
                        her ideologies-women, life, and freedom. In 2022 she had several exhibitions as a fine artist in
                        Eindhoven and Almere Bibliotek where she will exhibit again at the end of March 2023. Next to
                        that, she works as an equestrian, loves adrenaline and everything about horses.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="jury">
    <div class="container">
        <h2>Jury</h2>

        <div class="jury-gallery">
            <button class="gallery-nav prev-btn" onclick="slideGallery('prev')">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="jury-slider">
                <div class="jury-item">
                    <div class="jury-image">
                        <img src="uploads/STM/Lance.jpg" alt="Lance Hossein Tangestani" class="jury-photo">
                    </div>
                    <div class="jury-content">
                        <h3>Lance Hossein Tangestani</h3>
                        <p>Lance Hossein Tangestani started to develop his passion for film through internships as a
                            production and lighting assistant when he was 20 years old. As he was looking for his niche
                            during his studies at the Netherlands Film Academy, Lance found himself interested in
                            directing fiction. In his movies, like Qiyama (2018), Shalky (2019), or Buurt Tories (2021),
                            we can observe the echoes of his own experience as an immigrant and the individual looking
                            for his calling in the society.</p>
                    </div>
                </div>

                <div class="jury-item">
                    <div class="jury-image">
                        <img src="uploads/STM/Joan.jpg" alt="Jury Member 2" class="jury-photo">
                    </div>
                    <div class="jury-content">
                        <h3>Joan Nederlof</h3>
                        <p>Joan Nederlof is a Dutch actress, screenwriter, and co-founder of Mugmetdegoudentand theatre.
                            She is known for numerous series she debuted over the past decades including Bitches (2004),
                            Gooische Vrouwen (2008), and Floor Faber (2009). Joan was awarded a Golden Statue and a
                            Golden Calf for 'Best Actress' in 2000 and 2001 for her role of Grace Keeley in Hertenkamp.
                            In 2008, together with the writing team of the television series Gooische Vrouwen, she wins
                            the Zilveren Krulstaart award.</p>
                    </div>
                </div>

                <div class="jury-item">
                    <div class="jury-image">
                        <img src="uploads/STM/Nafiss.jpg" alt="Jury Member 3" class="jury-photo">
                    </div>
                    <div class="jury-content">
                        <h3>Nafiss Nia (Isfahan)</h3>
                        <p>Nafiss Nia (Isfahan) is an Iranian-Dutch poet, filmmaker, and cultural entrepreneur. Since
                            she made her debut in 2004 at Uitgeverij Bornmeer with the collection Esfahan, she continued
                            to publish her poetry regularly over the next years. Poems by Nafiss Nia have been included
                            in about thirty anthologies, such as De Beste Poems of 2002 (De Arbeiderspers, 2003), Blauw
                            Goud (Nieuw Amsterdam, 2013) and many more. Nafiss Nia is a member of the Authors' Union and
                            the Schrijvers Centrale Foundation. Her autobiographical documentary A, B, C,... premiered
                            in February 2011. In 2015, Dance Iranian Style premiered her debut feature as a screenwriter
                            and producer in Eye Amsterdam.
                        </p>
                    </div>
                </div>

                <div class="jury-item">
                    <div class="jury-image">
                        <img src="uploads/STM/Rosh.jpg" alt="Jury Member 4" class="jury-photo">
                    </div>
                    <div class="jury-content">
                        <h3>Rosh Abdelfatah</h3>
                        <p>Rosh Abdelfatah is a filmmaker and director of the Arab Film Festival. Together with the
                            organization, Rosh emphasizes that the Middle East community is not only about war and
                            violence as is mostly portrayed in the media. There are talented and creative professionals
                            and through this organization, they create space for an open dialogue about art, human
                            rights, emancipation, and political freedom in Arab countries, in Europe, and the
                            Netherlands in particular. In 2011, at his initiative, the “Jasmijnplein” was realized in
                            Rotterdam, together with the help of friends and the support of political parties in
                            Rotterdam. It was a meeting place, where they brought attention to the conflict in Syria,
                            with art, poetry, and film screenings.</p>
                    </div>
                </div>
            </div>

            <button class="gallery-nav next-btn" onclick="slideGallery('next')">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<div class="winners-2022">
    <div class="container">
        <h2>2022 Winners</h2>

        <div class="winners-2022-grid">
            <div class="winner-2022-item">
                <div class="winner-2022-image">
                    <img src="uploads/STM/Yaser.jpg" alt="Yaser Taheri" class="winner-2022-photo">
                </div>
                <div class="winner-2022-content">
                    <h3>Yaser Taheri</h3>
                    <p>YASER TAHERI has been a member of the ReFOCUS Collective since arriving on Lesvos, Greece in
                        2019. During the most turbulent phases of our program, Yaser was a lead member of our Citizen
                        Journalism program that chronicled the struggles asylum seekers trapped in Moria camp faced on
                        Lesvos. His work has been part of numerous international reports including major works by BBC
                        Newsnight, BBC Panorama, Aljazeera, Der Spiegel, CNN and The Wall Street Journal.</p>
                    <p>"Dancing Bells", depicting the under-reported issue of child abuse in Northern Afghanistan, is
                        Yaser's writing and directing debut. ReFOCUS is actively seeking financing to produce a feature
                        film based upon this short narrative.</p>
                </div>
            </div>

            <div class="winner-2022-item">
                <div class="winner-2022-image">
                    <img src="uploads/STM/Zahra.jpg" alt="Zahra Gardi" class="winner-2022-photo">
                </div>
                <div class="winner-2022-content">
                    <h3>Zahra Gardi</h3>
                    <p>ZAHRA GARDI developed her skills in photography and documentary filmmaking in the ReFOCUS
                        Collective since 2018. Her early short films centered upon issues dealing with gender inequality
                        and challenges faced by young children at risk in her home country of Afghanistan. In 2019-20
                        Zahra was a critical member of the crew that made "Even After Death", the first feature by
                        ReFOCUS which dealt with those who didn't survive the crossings to Europe from Turkey and
                        Africa. Zahra was also part of the team that produced the 1000 Dreams photography series, which
                        has been widely published and featured in National Geographic.</p>
                    <p>"Stitches", based on lived experiences in navigating the asylum process in Greece, is her writing
                        and directorial debut. ReFOCUS is actively seeking financing to produce a feature film based
                        upon this short narrative.</p>
                </div>
            </div>

            <div class="winner-2022-item">
                <div class="winner-2022-image">
                    <img src="uploads/STM/Walid.jpg" alt="Walid Taher" class="winner-2022-photo">
                </div>
                <div class="winner-2022-content">
                    <h3>Walid Taher</h3>
                    <p>Walid is a participant of the Buddy Career Boost, a project created by Buddy Film Foundation. He
                        is 48 years old, coming from Iraq. He started in 1996 at the Academy of Fine Arts and in the
                        years that followed, he proved himself as a determined filmmaker, actor, and director in Iraq
                        and the Netherlands.</p>
                    <p>With his latest film 'Pako' he made an international name for himself and won several awards.</p>
                </div>
            </div>

            <div class="winner-2022-item">
                <div class="winner-2022-image">
                    <img src="uploads/STM/Filmon.jpg" alt="Filmon Kiros" class="winner-2022-photo">
                </div>
                <div class="winner-2022-content">
                    <h3>Filmon Kiros</h3>
                    <p>During his participation in the Buddy Career Boost project by Buddy Film Foundation, Filmon
                        exuded a great interest in developing his skills as a creative maker. He is 32 years old and
                        comes from Eritrea. In Eritrea he wrote, directed and shot several video clips and long and
                        short films. In the Netherlands he worked as an assistant director with director Teddy Cherim
                        and worked on several film sets in the camera team.</p>
                </div>
            </div>
                 </div>
     </div>
 </div>
 
 <div class="photo-gallery">
     <div class="container">
         <h2>Photo Gallery</h2>
         
         <div class="photo-gallery-container">
             <button class="photo-gallery-nav prev-photo-btn" onclick="slidePhotoGallery('prev')">
                 <i class="fas fa-chevron-left"></i>
             </button>
             
             <div class="photo-gallery-slider">
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/1.jpg" alt="Gallery Image 1" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/2.jpg" alt="Gallery Image 2" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/3.jpg" alt="Gallery Image 3" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/4.jpg" alt="Gallery Image 4" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/5.jpg" alt="Gallery Image 5" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/6.jpg" alt="Gallery Image 6" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/7.jpg" alt="Gallery Image 7" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/8.jpg" alt="Gallery Image 8" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/9.jpg" alt="Gallery Image 9" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/10.jpg" alt="Gallery Image 10" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/11.jpg" alt="Gallery Image 11" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/12.jpg" alt="Gallery Image 12" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/13.jpg" alt="Gallery Image 13" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/14.jpg" alt="Gallery Image 14" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/15.jpg" alt="Gallery Image 15" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/16.jpg" alt="Gallery Image 16" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/17.jpg" alt="Gallery Image 17" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/18.jpg" alt="Gallery Image 18" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/19.jpg" alt="Gallery Image 19" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/20.jpg" alt="Gallery Image 20" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/21.jpg" alt="Gallery Image 21" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/22.jpg" alt="Gallery Image 22" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/23.jpg" alt="Gallery Image 23" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/24.jpg" alt="Gallery Image 24" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/25.jpg" alt="Gallery Image 25" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/26.jpg" alt="Gallery Image 26" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/27.jpg" alt="Gallery Image 27" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/28.jpg" alt="Gallery Image 28" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/29.jpg" alt="Gallery Image 29" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/30.jpg" alt="Gallery Image 30" class="photo-gallery-image">
                 </div>
                 <div class="photo-gallery-item">
                     <img src="uploads/STM/31.jpg" alt="Gallery Image 31" class="photo-gallery-image">
                 </div>
             </div>
             
                          <button class="photo-gallery-nav next-photo-btn" onclick="slidePhotoGallery('next')">
                 <i class="fas fa-chevron-right"></i>
             </button>
         </div>
     </div>
 </div>
 </div>
 
  <script>
 let currentSlide = 0;
 const totalSlides = 4;
 
 function slideGallery(direction) {
     const slider = document.querySelector('.jury-slider');
     const slideWidth = 100 / totalSlides;
 
     if (direction === 'next') {
         currentSlide = (currentSlide + 1) % totalSlides;
     } else {
         currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
     }
 
     const translateX = -currentSlide * slideWidth;
     slider.style.transform = `translateX(${translateX}%)`;
 }
 
 // Auto-slide every 5 seconds
 setInterval(() => {
     slideGallery('next');
 }, 5000);
 
 // Photo Gallery Slider
 let currentPhotoSlide = 0;
 const totalPhotoSlides = 31;
 const photosPerView = 4;
 const maxPhotoSlides = totalPhotoSlides - photosPerView;
 
 function slidePhotoGallery(direction) {
     const photoSlider = document.querySelector('.photo-gallery-slider');
     const slideWidth = 100 / totalPhotoSlides;
 
     if (direction === 'next') {
         currentPhotoSlide = Math.min(currentPhotoSlide + 1, maxPhotoSlides);
     } else {
         currentPhotoSlide = Math.max(currentPhotoSlide - 1, 0);
     }
 
     const translateX = -currentPhotoSlide * slideWidth;
     photoSlider.style.transform = `translateX(${translateX}%)`;
 }
 
 // Auto-slide photo gallery every 3 seconds
 setInterval(() => {
     if (currentPhotoSlide < maxPhotoSlides) {
         slidePhotoGallery('next');
     } else {
         currentPhotoSlide = 0;
         slidePhotoGallery('next');
     }
 }, 3000);
 </script>

<?php include 'inc/footer.php'; ?>