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
    background-image: url('uploads/TW/TW.jpg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    height: 110vh !important;
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
    color: rgba(0, 130, 137, 1);
    font-size: 2rem;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-top: 20px;
}

.header-content p {
    color: rgba(255, 255, 255, 1);
    font-size: 0.8rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-top: 20px;
}

.header-logo {
    max-width: 200px;
    height: auto;
    margin-bottom: 20px;
    filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.8));
    transition: transform 0.3s ease;
}

.header-logo:hover {
    transform: scale(1.05);
}

.content-section {
    padding: 4rem 0;
    margin-top: -30px;
    position: relative;
    z-index: 1;
}

.content-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: start;
}

.text-content h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 2rem;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.text-content p {
    color: #ccc;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.flyer-content {
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.flyer-img {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s ease;
}

.flyer-img:hover {
    transform: scale(1.02);
}

@media (max-width: 768px) {
    .content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .text-content h2 {
        font-size: 2rem;
    }

    .text-content p {
        font-size: 1rem;
    }
}

.video-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.video-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.video-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.video-container {
    position: relative;
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.video-container iframe {
    display: block;
    width: 100%;
    height: 500px;
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.video-container:hover iframe {
    transform: scale(1.02);
}

@media (max-width: 768px) {
    .video-section h2 {
        font-size: 2rem;
    }

    .video-container iframe {
        height: 300px;
    }
}

.cast-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.cast-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.cast-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.cast-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    margin-top: 2rem;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.cast-grid .cast-member:nth-child(4),
.cast-grid .cast-member:nth-child(5) {
    grid-column: span 1.5;
}

.cast-member {
    text-align: center;
    transition: transform 0.3s ease;
    position: relative;
}

.cast-member:hover {
    transform: translateY(-10px);
}

.cast-image {
    width: 100%;
    height: 350px;
    overflow: hidden;
    border-radius: 15px;
    margin-bottom: 1rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    position: relative;
}

.cast-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.cast-member:hover .cast-photo {
    transform: scale(1.1);
}

.cast-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    border-radius: 15px;
    text-align: left;
    overflow-y: auto;
}

.cast-member:hover .cast-overlay {
    opacity: 1;
}

.cast-bio {
    font-size: 0.79rem;
    line-height: 1.5;
    color: #fff;
}

.cast-info h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

@media (max-width: 768px) {
    .cast-section h2 {
        font-size: 2rem;
    }

    .cast-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .cast-grid .cast-member:nth-child(4),
    .cast-grid .cast-member:nth-child(5) {
        grid-column: span 1;
    }

    .cast-image {
        height: 250px;
    }

    .cast-info h3 {
        font-size: 1rem;
    }

    .cast-overlay {
        padding: 1rem;
    }

    .cast-bio {
        font-size: 0.5rem;
        line-height: 1;
    }
}

@media (max-width: 480px) {
    .cast-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
}

.crew-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.crew-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.crew-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.crew-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.crew-category {
    background: rgba(255, 255, 255, 0.05);
    padding: 1.5rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.crew-category:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.crew-category h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: bold;
}

.crew-member {
    margin-bottom: 0.5rem;
}

.crew-name {
    color: #fff;
    font-size: 1rem;
    font-weight: 500;
}

.collaboration-section {
    text-align: center;
    margin-top: 3rem;
    padding: 2rem;
    background: rgba(0, 130, 137, 0.1);
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.3);
}

.collaboration-section h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.3rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.collaboration-name {
    color: #fff;
    font-size: 1.2rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .crew-section h2 {
        font-size: 2rem;
    }

    .crew-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .crew-category {
        padding: 1.2rem;
    }

    .crew-category h3 {
        font-size: 1rem;
    }

    .crew-name {
        font-size: 0.9rem;
    }

    .collaboration-section {
        padding: 1.5rem;
    }

    .collaboration-section h3 {
        font-size: 1.1rem;
    }

    .collaboration-name {
        font-size: 1rem;
    }
}

.reviews-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.reviews-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.reviews-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.review-item {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 3rem;
    align-items: center;
    padding: 2.5rem;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.review-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.review-image {
    text-align: center;
    position: relative;
}

.review-photo {
    max-width: 200%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    margin-left: -160px;
}

.review-item:hover .review-photo {
    transform: scale(1.05);
}

.review-title-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
}

.review-title-overlay h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 3rem;
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin: 0;
    text-align: center;
}

.review-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.review-text p {
    color: #fff;
    font-size: 1rem;
    line-height: 1.7;
    font-style: italic;
    margin-left: 120px;
}

.review-source {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-left: 120px;

}

.source-name {
    color: rgba(0, 130, 137, 1);
    font-size: 1.1rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.review-date {
    color: #ccc;
    font-size: 0.9rem;
    font-weight: 500;
}

.review-context {
    color: #ccc;
    font-size: 0.9rem;
    font-style: italic;
}

@media (max-width: 768px) {
    .review-item {
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 2rem;
    }

    .review-title-overlay h2 {
        font-size: 2rem;
    }

    .review-text p {
        font-size: 1.1rem;
        line-height: 1.6;
    }

    .source-name {
        font-size: 1rem;
    }

    .review-date,
    .review-context {
        font-size: 0.85rem;
    }
}

.press-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.press-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.press-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.press-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.press-item {
    background: rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

.press-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.press-logo {
    flex-shrink: 0;
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    padding: 0.5rem;
}

 .press-logo-img {
     max-width: 100%;
     max-height: 100%;
     object-fit: contain;
     filter: brightness(1) invert(0);
     transition: filter 0.3s ease;
 }
 
 .press-item:hover .press-logo-img {
     filter: brightness(1.1) invert(0);
 }

.press-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.press-text p {
    color: #fff;
    font-size: 0.95rem;
    line-height: 1.6;
    font-style: italic;
    margin: 0;
}

.press-source {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
}

.press-source .source-name {
    color: rgba(0, 130, 137, 1);
    font-size: 1rem;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.press-date {
    color: #ccc;
    font-size: 0.85rem;
    font-weight: 500;
}

.read-more {
    color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.read-more:hover {
    color: #fff;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .press-section h2 {
        font-size: 2rem;
    }

    .press-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .press-item {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }

    .press-logo {
        width: 60px;
        height: 60px;
        margin: 0 auto;
    }

    .press-text p {
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .press-source .source-name {
        font-size: 0.9rem;
    }

    .press-date {
        font-size: 0.8rem;
    }

    .read-more {
        font-size: 0.8rem;
    }
}

.tickets-section {
    padding: 4rem 0;
    position: relative;
    z-index: 1;
}

.tickets-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.tickets-section h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    margin-bottom: 3rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    text-align: center;
}

.tickets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.ticket-item {
    background: rgba(255, 255, 255, 0.05);
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid rgba(0, 130, 137, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.ticket-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.ticket-item.special-event {
    border-color: rgba(255, 215, 0, 0.6);
    background: rgba(255, 215, 0, 0.05);
}

.ticket-item.special-event:hover {
    border-color: rgba(255, 215, 0, 0.8);
    box-shadow: 0 15px 40px rgba(255, 215, 0, 0.2);
}

.ticket-location h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-weight: bold;
}

.ticket-item.special-event .ticket-location h3 {
    color: rgba(255, 215, 0, 1);
}

.venue-info h4 {
    color: #fff;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.venue-info p {
    color: #ccc;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
    line-height: 1.4;
}

.ticket-dates {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
}

.date-item {
    background: rgba(0, 130, 137, 0.1);
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid rgba(0, 130, 137, 0.3);
}

.date-item .date {
    color: #fff;
    font-size: 1rem;
    font-weight: 500;
}

.event-schedule {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    margin-top: 1rem;
}

.schedule-item {
    background: rgba(255, 215, 0, 0.1);
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.schedule-item .time {
    color: rgba(255, 215, 0, 1);
    font-size: 0.9rem;
    font-weight: bold;
    min-width: 80px;
    flex-shrink: 0;
}

.schedule-item .activity {
    color: #fff;
    font-size: 0.9rem;
    line-height: 1.4;
}

.ticket-action {
    margin-top: auto;
}

.buy-tickets-btn {
    display: inline-block;
    background: rgba(0, 130, 137, 1);
    color: #fff;
    padding: 1rem 2rem;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-align: center;
    width: 100%;
}

.buy-tickets-btn:hover {
    background: rgba(0, 130, 137, 0.8);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
}

.ticket-item.special-event .buy-tickets-btn {
    background: rgba(255, 215, 0, 1);
    color: #000;
}

.ticket-item.special-event .buy-tickets-btn:hover {
    background: rgba(255, 215, 0, 0.8);
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
}

@media (max-width: 768px) {
    .tickets-section h2 {
        font-size: 2rem;
    }

    .tickets-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .ticket-item {
        padding: 1.5rem;
    }

    .ticket-location h3 {
        font-size: 1.3rem;
    }

    .venue-info h4 {
        font-size: 1.1rem;
    }

    .date-item .date {
        font-size: 0.9rem;
    }

    .schedule-item {
        flex-direction: column;
        gap: 0.5rem;
    }

    .schedule-item .time {
        min-width: auto;
    }

    .buy-tickets-btn {
        padding: 0.8rem 1.5rem;
        font-size: 0.9rem;
    }
}
</style>

<div class="page-header">
    <div class="header-content">
        <img src="uploads/TW/TWlogo.jpg" alt="Trojaanse Wijven Logo" class="header-logo">
        <h1>Trojaanse Wijven / Zwembadtour deel 2 van start!</h1>
        <p>Buddy Film Productions presenteert in samenwerking met Werkplaats Walhalla</p>
        <p>een theaterervaring met verhalen van nu over vrouwen op de vlucht.
            Regiedebuut Dewi Reijs</p>
    </div>
</div>

<div class="content-section">
    <div class="container">
        <div class="content-grid">
            <div class="text-content">
                <h2>Verhaal</h2>
                <p>In april 2022 is actrice en theatermaker Dewi Reijs in première gegaan met een moderne bewerking van
                    Trojaanse Vrouwen van Euripides met verhalen van nu. In december start het 2e gedeelte van de tour.
                </p>
                <p>Geen stoffig geklaag, maar een multiculturele theater experience verteld door een all female cast met
                    roots in Somalië, Syrië, Palestina, Algerije, Marokko, Suriname en Nederlands-Indië. De actrices
                    vertellen over hun familiegeschiedenis, oorlog, vluchten en migratie. De zee, het water is nauw
                    verbonden aan deze voorstelling. Immers kwamen de Grieken aan op schepen en namen hun buit, de
                    vrouwen, mee over water.</p>
                <p>De avondvullende versie van Trojaanse Wijven van 90 minuten wordt Dewi's officiële debuut als
                    theaterregisseur. Het stuk speelt zich af op een drijvend podium in het zwembad en het publiek
                    draagt koptelefoons. Dit is geen standaard voorstelling, maar een intieme beleving.</p>
            </div>
            <div class="flyer-content">
                <img src="uploads/TW/TWflyer.jpg" alt="Trojaanse Wijven Flyer" class="flyer-img">
            </div>
        </div>
    </div>
</div>

<div class="video-section">
    <div class="container">
        <h2>Check de teaser hieronder!</h2>
        <div class="video-container">
            <iframe src="https://player.vimeo.com/video/693879133?h=fl&fe=vl" width="100%" height="500" frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
            </iframe>
        </div>
    </div>
</div>

<div class="cast-section">
    <div class="container">
        <h2>Cast</h2>
        <div class="cast-grid">
            <div class="cast-member">
                <div class="cast-image">
                    <img src="uploads/TW/DSC04370_edited.jpg" alt="Dewi Reijs" class="cast-photo">
                    <div class="cast-overlay">
                        <div class="cast-bio">
                            Dewi studeerde af aan de Toneel & Kleinkunstacademie. Ze werkte bij verschillende
                            gezelschappen onder meer Huis ad Amstel, Theater Rast, Hummelinck en Stuurman en
                            International Theater Amsterdam. Naast haar acteerwerk voor film & theater is ze ook actief
                            als schrijver en regisseur. Ze is founder van Buddy Film Foundation. Dewi heeft Indische
                            roots.
                        </div>
                    </div>
                </div>
                <div class="cast-info">
                    <h3>Dewi Reijs</h3>
                </div>
            </div>

            <div class="cast-member">
                <div class="cast-image">
                    <img src="uploads/TW/DSC04194_edited.png" alt="Khadija Sabriye" class="cast-photo">
                    <div class="cast-overlay">
                        <div class="cast-bio">
                            Khadija is een selfmade stand-upcomedian met Somalische roots. Ze speelde in comedy clubs
                            door heel het land. Khadija is te zien in de documentaire All You See openingsfilm 2022 van
                            IDFA. Naast haar werk in het theater werkt ze ook in de zorg als verpleegkundige. Daarnaast
                            speelde ze de hoofdrol in de commercial voor VluchtelingenWerk Nederland voor hun 40 jarige
                            jubileum.
                        </div>
                    </div>
                </div>
                <div class="cast-info">
                    <h3>Khadija Sabriye</h3>
                </div>
            </div>

            <div class="cast-member">
                <div class="cast-image">
                    <img src="uploads/TW/DSC04428_edited.jpg" alt="Safaa Khelifati" class="cast-photo">
                </div>
                <div class="cast-info">
                    <h3>Safaa Khelifati</h3>
                </div>
            </div>

            <div class="cast-member">
                <div class="cast-image">
                    <img src="uploads/TW/DSC01809.jpg" alt="Samantha Wielkens" class="cast-photo">
                    <div class="cast-overlay">
                        <div class="cast-bio">
                            Samantha Cherish Wielkens is een mix van alles, ze heeft Surinaamse, Indische en Nederlandse
                            roots. Ze acteert, presenteert en creëert zelf online sketches. Ze is bekend van de
                            theatervoorstelling Sixth, maakte programma's voor BNN en was te zien in Spangas. Samantha
                            hoopt ooit met haar eigen show in Carré te staan. Ze is founder van Mom Buddy Movement, een
                            stichting die hulpbehoevende moeders op verschillende vlakken een helpende hand biedt.
                        </div>
                    </div>
                </div>
                <div class="cast-info">
                    <h3>Samantha Wielkens</h3>
                </div>
            </div>

            <div class="cast-member">
                <div class="cast-image">
                    <img src="uploads/TW/DSC01676.jpg" alt="Seweta Zirak" class="cast-photo">
                    <div class="cast-overlay">
                        <div class="cast-bio">
                            Seweta is in Kabul geboren en woont sinds juli 2000 in Nederland. Ze is verpleegkundige en
                            werkt als praktijkopleider. Ze is ondernemer en runt haar eigen auto en motorrijschool.
                            Acteren is iets waar ze als kind altijd al van gedroomd heeft. Ze heeft de zomeropleiding
                            gedaan van theaterschool De Trap en speelde daarna bij ZID Theater. Seweta is een
                            terugkerende gast bij OP1 als Afghaanse ervaringsdeskundige. Met haar eigen stichting
                            Pamiryan zet ze zich in voor onderwijs van meisjes in Afghanistan. Seweta komt tevens op
                            voor de rechten van de Afghaanse LHBTIQ+community.
                        </div>
                    </div>
                </div>
                <div class="cast-info">
                    <h3>Seweta Zirak</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="crew-section">
    <div class="container">
        <h2>Crew</h2>
        <div class="crew-grid">
            <div class="crew-category">
                <h3>Original tekst</h3>
                <div class="crew-member">
                    <span class="crew-name">Euripides</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Dramaturg</h3>
                <div class="crew-member">
                    <span class="crew-name">Celine Buuren</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Coach regie</h3>
                <div class="crew-member">
                    <span class="crew-name">Nanouk Leopold</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Scenografie, lichtontwerp</h3>
                <div class="crew-member">
                    <span class="crew-name">Taciser Sevinç</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Componist</h3>
                <div class="crew-member">
                    <span class="crew-name">Tarek Muazen</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Technische productie</h3>
                <div class="crew-member">
                    <span class="crew-name">Barry van Rooijen</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Zakelijke Leiding</h3>
                <div class="crew-member">
                    <span class="crew-name">Hedi Legerstee</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Social Media</h3>
                <div class="crew-member">
                    <span class="crew-name">Faayyaaz van Dijk</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Drukwerk Studio BLT</h3>
                <div class="crew-member">
                    <span class="crew-name">Barbara Lateur</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Decorbouw</h3>
                <div class="crew-member">
                    <span class="crew-name">David van der Wees</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Kostuums</h3>
                <div class="crew-member">
                    <span class="crew-name">Fares Moses</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Technicus</h3>
                <div class="crew-member">
                    <span class="crew-name">Demi Kortekaas</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Geluid</h3>
                <div class="crew-member">
                    <span class="crew-name">Eric Boxman</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Pre-productie</h3>
                <div class="crew-member">
                    <span class="crew-name">Andrea van Bussel</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Productieleider/tourmanager</h3>
                <div class="crew-member">
                    <span class="crew-name">Chabelle van der Pauw</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Marketing & Communicatie</h3>
                <div class="crew-member">
                    <span class="crew-name">Nadia Doudou</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Photographer & Visual Designer</h3>
                <div class="crew-member">
                    <span class="crew-name">Maria Bodrug</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Publiciteit & Pers</h3>
                <div class="crew-member">
                    <span class="crew-name">Marjo van Lijssel</span>
                </div>
            </div>

            <div class="crew-category">
                <h3>Casting</h3>
                <div class="crew-member">
                    <span class="crew-name">Buddy Film Casting, Tisa de Jong</span>
                </div>
            </div>
        </div>

        <div class="collaboration-section">
            <h3>In samenwerking met:</h3>
            <div class="collaboration-item">
                <span class="collaboration-name">Werkplaats Walhalla</span>
            </div>
        </div>
    </div>
</div>

<div class="reviews-section">
    <div class="container">
        <div class="review-item">
            <div class="review-image">
                <img src="uploads/TW/TWdewi.jpg" alt="NRC Recensie" class="review-photo">
                <div class="review-title-overlay">
                    <h2>Recensies</h2>
                </div>
            </div>
            <div class="review-content">
                <div class="review-text">
                    <p>In Trojaanse Wijven van TG Dewi trekken de vijf actrices het klassieke verhaal van de aloude
                        strijd van de Grieken tegen de Trojanen door naar de hedendaagse problematiek van vrouwen uit
                        Syrië, Nederlands-Indië en Suriname. Dat is knap gedaan. Zo krijgt geschiedenis grote betekenis
                        voor nu.</p>
                </div>
                <div class="review-source">
                    <span class="source-name">NRC - Kester Freriks</span>
                    <span class="review-date">23 juli 2019</span>
                    <span class="review-context">over Trojaanse Wijven op Theaterfestival de Parade</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="press-section">
    <div class="container">
        <h2>Pers</h2>
        <div class="press-grid">
            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/stichting-doen-logo.jpg" alt="Stichting DOEN" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"Dewi Reijs is actrice en producer, maar het liefste vertelt zij verhalen. Met een eigen
                            j stichting doet Dewi wat zij goed kan en graag doet: door middel van workshops, coaching en
                            filmprojecten helpt ze gevluchte filmprofessionals in Nederland aan betaald werk en creëert
                            zo een podium voor de diverse verhalen die verteld moeten worden."</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">Stichting DOEN</span>
                        <span class="press-date">24 maart 2022</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/indebuurt.jpg" alt="IN DE BUURT" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"Vijf vrouwelijke vluchtelingen en derdegeneratiemigranten vwertellen hun verhalen over
                            oorlog, onderdrukking, vluchten en een nieuw leven opbouwen in ons land. Hiermee laten ze
                            zien wat het betekent om hier als niet-westerse vrouw te leven."</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">IN DE BUURT</span>
                        <span class="press-date">7 april 2022</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/ilovetheater.jpg" alt="I LOVE THEATER" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"Het is niet echt een standaard voorstelling, maar echt een totaalbeleving van zang, dans en
                            intense verhalen. Je hebt geen enkel moment het gevoel dat de vijf dames staan te acteren,
                            het is echt hun gevoel en dat gevoel komt bij je binnen."</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">I LOVE THEATER</span>
                        <span class="press-date">11 april 2022</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/dhc.jpg" alt="DEN HAAG CENTRAAL" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"De Rotterdamse Dewi Reijs (1982) maakte met 'Trojaanse Wijven' een moderne bewerking van
                            'Trojaanse vrouwe' van Euripides."</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">DEN HAAG CENTRAAL</span>
                        <span class="press-date">29 april 2022</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/kf.jpg" alt="Koffietijd" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"Dewi wil vooral mensen een onbekend gevoel meegeven en hen hiermee bekend te laten worden.
                            Volgens Dewi hadden al deze vrouwen je buurvrouw, vriendin of collega kunnen zijn. Ze staan
                            niet ver van je af. En dat je misschien op langere termijn je hand uitsteekt om iemand
                            anders te helpen."</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">Koffietijd</span>
                        <span class="press-date">14 april 2022</span>
                        <a href="#" class="read-more">Bekijk de video</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/1200px-NPO_logo_2013_full_svg.jpg" alt="NPO Op de Planken"
                        class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>Kijk mee op de planken bij opnames met talentvolle muziek- en theatergezelschappen. Trojaanse
                            Wijven laat een sneak preview zien….</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">Op de Planken, NPO</span>
                        <span class="press-date">25 aug 2022</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>

            <div class="press-item">
                <div class="press-logo">
                    <img src="uploads/TW/ld_logo.jpg" alt="Leidsch Dagblad" class="press-logo-img">
                </div>
                <div class="press-content">
                    <div class="press-text">
                        <p>"Theatervoorstelling 'Trojaanse wijven' op het water van zwembad De Does in Leiderdorp"</p>
                    </div>
                    <div class="press-source">
                        <span class="source-name">Leidsch Dagblad</span>
                        <span class="press-date">20 Jan 2023</span>
                        <a href="#" class="read-more">Lees meer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tickets-section">
    <div class="container">
        <h2>Save your seat</h2>
        <div class="tickets-grid">
            <div class="ticket-item">
                <div class="ticket-location">
                    <h3>AMSTERDAM</h3>
                    <div class="venue-info">
                        <h4>Mercatorbad</h4>
                        <p>Jan van Galenstraat 315</p>
                        <p>1056 CB Amsterdam</p>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 10 december 2022 | 21:00</span>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>

            <div class="ticket-item">
                <div class="ticket-location">
                    <h3>AMERSFOORT</h3>
                    <div class="venue-info">
                        <h4>Amerenabad</h4>
                        <p>De Velduil 2</p>
                        <p>3815 XT Amersfoort</p>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 14 januari 2023 | 20:30</span>
                    </div>
                    <div class="date-item">
                        <span class="date">Zaterdag 15 januari 2023 | n.n.b.</span>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>

            <div class="ticket-item">
                <div class="ticket-location">
                    <h3>LEIDERDORP</h3>
                    <div class="venue-info">
                        <h4>Zwembad de Does</h4>
                        <p>Amaliaplein 40,</p>
                        <p>2351 PV Leiderdorp</p>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 21 januari 2023 | 20:30</span>
                    </div>
                    <div class="date-item">
                        <span class="date">Zondag 22 januari 2023 | 20:30</span>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>

            <div class="ticket-item">
                <div class="ticket-location">
                    <h3>MAASTRICHT</h3>
                    <div class="venue-info">
                        <h4>Geusseltbad</h4>
                        <p>Discusworp 4</p>
                        <p>6225 XP Maastricht</p>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 25 maart 2023 | t.b.a</span>
                    </div>
                    <div class="date-item">
                        <span class="date">Zondag 26 maart 2023 | t.b.a</span>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>

            <div class="ticket-item special-event">
                <div class="ticket-location">
                    <h3>DEN HAAG</h3>
                    <div class="venue-info">
                        <h4>Sportcentrum de Houtzagerij</h4>
                        <p>Hobbemastraat 93,</p>
                        <p>2526 JG Den Haag</p>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 11 maart 2023 | n.n.b.</span>
                    </div>
                    <div class="event-schedule">
                        <div class="schedule-item">
                            <span class="time">20.00 uur</span>
                            <span class="activity">Aanvang inleiding: het verhaal van Euripides @theater De
                                Vaillant</span>
                        </div>
                        <div class="schedule-item">
                            <span class="time">21:00 uur</span>
                            <span class="activity">Start voorstelling @Zwembad De Houtzagerij</span>
                        </div>
                        <div class="schedule-item">
                            <span class="time">22:30 uur</span>
                            <span class="activity">Borrel + Meet & Greet cast @theater De Vaillant (drankje inbegrepen
                                bij ticket)</span>
                        </div>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>

            <div class="ticket-item">
                <div class="ticket-location">
                    <h3>PURMEREND</h3>
                    <div class="venue-info">
                        <h4>Leeghwaterpark 1, 1445 RA Purmerend</h4>
                    </div>
                </div>
                <div class="ticket-dates">
                    <div class="date-item">
                        <span class="date">Zaterdag 15 april 2023 | 20:45</span>
                    </div>
                </div>
                <div class="ticket-action">
                    <a href="#" class="buy-tickets-btn">KOOP KAARTEN</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>