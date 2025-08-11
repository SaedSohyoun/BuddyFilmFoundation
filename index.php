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

/* Hero Slider Section */
.hero-slider-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.05) 0%, rgba(0, 0, 0, 0) 100%);
    padding: 4rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.slider-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    padding: 0 2rem;
}

.slider-wrapper {
    position: relative;
    height: 400px;
    overflow: hidden;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border: 1px solid rgba(0, 130, 137, 0.2);
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.slide.active {
    opacity: 1;
}

.slide-content {
    text-align: center;
    max-width: 800px;
    z-index: 2;
}

.slide-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    animation: fadeInUp 0.8s ease-out;
}

.slide-description {
    color: #e0e0e0;
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.slide-btn {
    display: inline-block;
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.slide-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
    color: white;
    text-decoration: none;
}

.slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 130, 137, 0.8);
    color: white;
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

.slider-btn:hover {
    background: rgba(0, 130, 137, 1);
    transform: translateY(-50%) scale(1.1);
}

.slider-btn-prev {
    left: 20px;
}

.slider-btn-next {
    right: 20px;
}

.slider-dots {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot.active {
    background: rgba(0, 130, 137, 1);
    transform: scale(1.2);
}

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

/* New Image Slider Section */
.new-image-slider-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.05) 0%, rgba(0, 0, 0, 0) 100%);
    padding: 3rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.new-slider-container {
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    padding: 0 2rem;
}

.new-slider-wrapper {
    position: relative;
    height: 600px;
    overflow: hidden;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0.3) 100%);
    border: 1px solid rgba(0, 130, 137, 0.2);
}

.new-slider-item {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
}

.new-slider-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 100, 200, 0.3);
    z-index: 1;
    border-radius: 20px;
}

.new-slider-item.active {
    opacity: 1;
}

.new-slider-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
    transition: transform 0.3s ease;
}

.new-slider-item:hover .new-slider-image {
    transform: scale(1.02);
}

.new-slider-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 130, 137, 0.9);
    color: white;
    border: none;
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
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.new-slider-btn:hover {
    background: rgba(0, 130, 137, 1);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
}

.new-slider-btn-prev {
    left: 20px;
}

.new-slider-btn-next {
    right: 20px;
}

.slider-text-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    text-align: left;
    z-index: 2;
    padding: 3rem;
    color: white;
    background: rgba(0, 0, 0, 0.4);
    border-radius: 20px;
}

.slider-text-overlay h3 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    line-height: 1.2;
}

.slider-text-overlay p {
    font-size: 1.2rem;
    line-height: 1.6;
    max-width: 800px;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
}

.new-slider-dots {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1.5rem;
}

.new-slider-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.new-slider-dot.active {
    background: rgba(0, 130, 137, 1);
    transform: scale(1.2);
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
}

.hero-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    font-weight: 300;
    margin-bottom: 2rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    letter-spacing: 2px;
    text-transform: uppercase;
}

.hero-logo {
    max-width: 60%;
    height: auto;
    display: block;
    margin: 0 auto 2rem;
    filter: drop-shadow(0 10px 30px rgba(0, 130, 137, 0.3));
    transition: transform 0.3s ease, filter 0.3s ease;
}

.hero-logo:hover {
    transform: scale(1.02);
    filter: drop-shadow(0 15px 40px rgba(0, 130, 137, 0.4));
}

.btn-group-left {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-outline-primary {
    font-size: 1.1rem;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    color: rgba(0, 130, 137, 1);
    border: 2px solid rgba(0, 130, 137, 1);
    transition: all 0.3s ease;
    text-decoration: none;
    font-weight: 600;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.2);
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
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
}

.section-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1rem;
    max-width: 800px;
}

.who-we-are-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
    margin-top: 2rem;
}

.video-side {
    display: flex;
    flex-direction: column;
}

.video-wrapper {
    position: relative;
    width: 100%;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    background: #1a1a1a;
}

.video-wrapper iframe {
    width: 100%;
    height: 350px;
    border: none;
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.video-wrapper:hover iframe {
    transform: scale(1.02);
}

.text-side {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.text-side .section-text {
    margin-bottom: 0;
}

.beheer-knop {
    margin-top: 2rem;
}

/* Who We Are Section */
.who-we-are-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.who-we-are-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

.gallery-side {
    display: flex;
    flex-direction: column;
}

.gallery-container {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
    width: 100%;
    position: relative;
}

.gallery-item {
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
    opacity: 0;
    transform: scale(0.8);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.gallery-item.active {
    opacity: 1;
    transform: scale(1);
    position: relative;
}

.gallery-item:hover {
    transform: scale(1.05);
}

.gallery-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.gallery-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 130, 137, 0.8);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s ease;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-nav:hover {
    background: rgba(0, 130, 137, 1);
    transform: translateY(-50%) scale(1.1);
}

.gallery-prev {
    left: -20px;
}

.gallery-next {
    right: -20px;
}

.gallery-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 1rem;
}

.gallery-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-dot.active {
    background: rgba(0, 130, 137, 1);
    transform: scale(1.2);
}

.text-side {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.who-we-are-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.beliefs-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.who-we-are-content-text p {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    text-align: justify;
}

.who-we-are-content-text strong {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

/* Statistics Section */
.statistics-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
}

.statistics-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 3rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.statistics-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.stat-card {
    background: transparent;
    border: none;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    color: #e0e0e0;
    font-size: 4rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
    font-family: 'Arial', sans-serif;
    letter-spacing: 1px;
}

.stat-label {
    color: #e0e0e0;
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.3;
    text-transform: lowercase;
    letter-spacing: 0.5px;
}

/* Team Section */
.team-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.team-card {
    background-color: #2a2a2a;
    border-radius: 15px;
    overflow: hidden;
    border: 1px solid #444;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.team-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background-color: #1a1a1a;
}

.team-content {
    padding: 1.5rem;
}

.team-name {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.team-role {
    color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    font-weight: 500;
}

/* Support Section */
.support-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
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

/* Contact Section */
.contact-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 3rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
}

.contact-info h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
}

.contact-group {
    margin-bottom: 2rem;
}

.contact-label {
    color: rgba(0, 130, 137, 1);
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
}

.contact-details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.contact-item h6 {
    color: white;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.contact-item p {
    color: #ccc;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
    line-height: 1.4;
}

.contact-item a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    transition: color 0.3s ease;
}

.contact-item a:hover {
    color: white;
    text-decoration: underline;
}

/* Contact Form */
.contact-form h2 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control:focus {
    background-color: #2a2a2a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
    outline: none;
}

.submit-btn {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    border: none;
    color: white;
    font-weight: 600;
    padding: 0.8rem 2rem;
    border-radius: 30px;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
    width: 100%;
}

.submit-btn:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 130, 137, 0.4);
}

.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.social-links a {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    transition: color 0.3s ease;
}

.social-links a:hover {
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        padding: 2rem 0;
    }

    .hero-title {
        font-size: 1.2rem;
    }

    .hero-logo {
        max-width: 80%;
    }

    .btn-group-left {
        gap: 1rem;
    }

    .content-section,
    .team-section,
    .support-section,
    .contact-section {
        padding: 2rem;
    }

    .support-content,
    .contact-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .team-grid {
        grid-template-columns: 1fr;
    }

    .contact-details {
        grid-template-columns: 1fr;
    }

    .section-title {
        font-size: 2rem;
    }

    .statistics-title {
        font-size: 2rem;
        margin-bottom: 2rem;
    }

    .statistics-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .stat-card {
        padding: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
    }

    .stat-label {
        font-size: 0.8rem;
    }

    .who-we-are-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
        gap: 0.8rem;
    }

    .gallery-image {
        height: 200px;
    }

    .gallery-nav {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }

    .gallery-prev {
        left: -15px;
    }

    .gallery-next {
        right: -15px;
    }

    .gallery-dots {
        gap: 6px;
    }

    .gallery-dot {
        width: 6px;
        height: 6px;
    }

    .who-we-are-title {
        font-size: 2rem;
    }

    .beliefs-title {
        font-size: 1.5rem;
    }

    .who-we-are-content-text p {
        font-size: 1rem;
    }

    .who-we-are-layout {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .video-wrapper iframe {
        height: 250px;
    }
}
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">Talent is everywhere</h1>
        <img src="uploads/BFF/BuddyFilmFoundation-Black.jpeg" alt="Buddy Film Foundation Logo" class="hero-logo">
        <div class="btn-group-left">
            <a href="foundation.php" class="btn btn-outline-primary">Foundation</a>
            <a href="production.php" class="btn btn-outline-primary">Production</a>
            <a href="casting.php" class="btn btn-outline-primary">Casting</a>
        </div>
    </div>
</div>
<br><br>
<h1 style="color: rgba(0, 130, 137, 1); font-weight: bold; padding-left: 2rem;">BUDDY NEWS</h1>
<!-- New Image Slider Section -->
<div class="new-image-slider-section">
    <div class="new-slider-container">
        <button class="new-slider-btn new-slider-btn-prev" onclick="changeNewSliderImage(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="new-slider-wrapper">
            <div class="new-slider-item active" data-slide="0">
                <img src="uploads/2pic/rat.jpg" alt="Buddy Film Foundation" class="new-slider-image">
                <div class="slider-text-overlay">
                    <h3>We need your help to bring our new</h3>
                    <h3>production to reality—</h3>
                    <p>a powerful story about how war robs children of their innocence.</p>
                </div>
            </div>
            <div class="new-slider-item" data-slide="1">
                <img src="uploads/2pic/ibn.jpg" alt="Buddy Film Casting" class="new-slider-image">
                <div class="slider-text-overlay">
                    <h3>Ik Ben Nieuw Is now live!</h3>
                    <p>Our latest production, Ik Ben Nieuw, premiered on November 1st at the Cinekid Festival. Explore
                        our collection of 5 short films and a music video featuring artist Jay Way. These stories follow
                        four newcomer children and their friends as they navigate the challenges and joys of building a
                        new life in a new country.</p>
                </div>
            </div>
        </div>
        <button class="new-slider-btn new-slider-btn-next" onclick="changeNewSliderImage(1)">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    <div class="new-slider-dots">
        <span class="new-slider-dot active" onclick="goToNewSliderImage(0)"></span>
        <span class="new-slider-dot" onclick="goToNewSliderImage(1)"></span>
    </div>
</div>
<br><br><br><br>
<!-- About Section -->
<div class="container">
    <div class="content-section">
        <div class="who-we-are-layout">
            <div class="video-side">
                <div class="video-wrapper">
                    <iframe src="https://player.vimeo.com/video/775089284?h=pl&fe=vl&title=0&byline=0&portrait=0"
                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="text-side">
                <h2 class="section-title">WHO ARE WE?</h2>
                <p class="section-text">Buddy Film Foundation operates as a starting point for refugee filmmakers, film
                    crew,
                    actors and creatives. We organise workshops, network events and coach our new colleagues with the
                    ultimate
                    goal being; landing paid jobs. We guide these professional filmmakers from development to execution
                    and
                    funding of their own film projects. We strive to be the link between the newcomers in this domain
                    and the
                    national and international film and tv-industry. </p>
            </div>
        </div>

        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
        <div class="beheer-knop">
            <a href="admin/teambeheer.php" class="btn btn-outline-primary">Beheer Teamleden (Admin)</a>
        </div>
        <?php endif; ?>
    </div>
    <br>
    <!-- Who We Are Section -->
    <div class="who-we-are-section">
        <div class="who-we-are-content">
            <div class="text-side">
                <h2 class="who-we-are-title">Our beliefs</h2>
                <div class="who-we-are-content-text">
                    <p>We believe that by helping our members slip directly into paid jobs in their domain of interest,
                        is the best way to assimilate and have a meaningful journey into full integration. Work offers a
                        person stability, income, social contacts, development and a certain social status. Especially
                        when you find work in the field you actually want to work in; it gives an extra motivation, it
                        creates positive energy and we get to hear and see the stories that only they can tell. It
                        really is a win-win. <strong>Talent is everywhere.</strong></p>
                </div>
            </div>
            <div class="gallery-side">
                <div class="gallery-container">
                    <button class="gallery-nav gallery-prev" onclick="changeGalleryImage(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="gallery-grid">
                        <div class="gallery-item active" data-index="0">
                            <img src="uploads/14pic/1.jpg" alt="Buddy Film Foundation" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="1">
                            <img src="uploads/14pic/2.jpg" alt="Workshop Event" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="2">
                            <img src="uploads/14pic/3.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="3">
                            <img src="uploads/14pic/4.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="4">
                            <img src="uploads/14pic/5.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="5">
                            <img src="uploads/14pic/6.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="6">
                            <img src="uploads/14pic/7.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="7">
                            <img src="uploads/14pic/8.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="8">
                            <img src="uploads/14pic/9.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="9">
                            <img src="uploads/14pic/10.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="10">
                            <img src="uploads/14pic/11.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="11">
                            <img src="uploads/14pic/12.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="12">
                            <img src="uploads/14pic/13.jpg" alt="Team Member" class="gallery-image">
                        </div>
                        <div class="gallery-item" data-index="13">
                            <img src="uploads/14pic/14.jpg" alt="Team Member" class="gallery-image">
                        </div>
                    </div>
                    <button class="gallery-nav gallery-next" onclick="changeGalleryImage(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                <div class="gallery-dots">
                    <span class="gallery-dot active" onclick="goToGalleryImage(0)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(1)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(2)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(3)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(4)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(5)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(6)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(7)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(8)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(9)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(10)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(11)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(12)"></span>
                    <span class="gallery-dot" onclick="goToGalleryImage(13)"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="statistics-section">
        <h2 class="statistics-title">BUDDY FILM NUMBERS</h2>
        <div class="statistics-grid">
            <div class="stat-card">
                <div class="stat-number">23</div>
                <div class="stat-label">complete film<br>productions</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">206</div>
                <div class="stat-label">registered film<br>professionals</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">15</div>
                <div class="stat-label">different<br>nationalities</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">131</div>
                <div class="stat-label">completed<br>castings</div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="team-section">
        <h2 class="section-title" style="display: flex; align-items: center; justify-content: center;">BUDDY TEAM</h2>
        <p style="display: flex; align-items: center; justify-content: center;">The Buddy Film Foundation was founded in
            2017 by actress Dewi
            Reijs,</p>
        <p style="display: flex; align-items: center; justify-content: center;">director Dennis Overeem and producer
            In-Soo Radstake.</p>
        <div class="team-grid">
            <?php
            $result = $conn->query("SELECT * FROM teamleden ORDER BY id ASC");
            while ($lid = $result->fetch_assoc()):
                $foto = !empty($lid['foto']) && file_exists('uploads/team/' . $lid['foto'])
                    ? 'uploads/team/' . $lid['foto']
                    : 'assets/img/default-team.png';
            ?>
            <div class="team-card">
                <img src="<?= htmlspecialchars($foto) ?>" class="team-image"
                    alt="<?= htmlspecialchars($lid['naam']) ?>">
                <div class="team-content">
                    <h5 class="team-name"><?= htmlspecialchars($lid['naam']) ?></h5>
                    <h6 class="team-role"><?= htmlspecialchars($lid['functie']) ?></h6>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Hero Slider Section -->
    <div class="hero-slider-section">
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slide active" data-slide="1">
                    <div class="slide-content">
                        <h1 class="slide-title">Buddy Career Boost</h1>
                        <p class="slide-description">Buddy Career Boost is a project created in 2019 for refugee film
                            professionals based in the Netherlands. The purpose of it was to guide them into starting or
                            continuing their career through workshops, Dutch courses, and speed dates to build their
                            network. As a result and careful consideration, we selected two participants who are film
                            directors and produced two short films: Revenge and a Smile.</p>
                        <a href="filmmakers.php" class="slide-btn">
                            <i class="fas fa-users"></i> Bekijk Filmmakers
                        </a>
                    </div>
                </div>

                <div class="slide" data-slide="2">
                    <div class="slide-content">
                        <h1 class="slide-title">Rotterdam Writers' Rooms</h1>
                        <p class="slide-description">The Rotterdam Writers' Rooms project, in collaboration with the
                            Buddy Film Foundation, is a long-term program starting in January 2024. It includes in-depth
                            workshops, audience interactions, and AV sector meet-ups, all at no cost. We require a
                            strong commitment but offer generous compensation. Three selection rounds will lead to the
                            formation of writing teams for the rooms, guided by experienced script coaches.</p>
                        <a href="casting.php" class="slide-btn">
                            <i class="fas fa-theater-masks"></i> Bekijk Casting
                        </a>
                    </div>
                </div>

                <div class="slide" data-slide="3">
                    <div class="slide-content">
                        <h1 class="slide-title">Trojaanse Wijven - a multicultural theatre experience</h1>
                        <p class="slide-description">Actress and theater maker Dewi Reijs comes with a modern adaptation
                            of Trojan Women by Euripides with stories from today.The play takes place on a floating
                            stage in the swimming pool and the audience wears headphones. This is not a standard
                            performance, but an intimate experience. The first swimming pool tour in the Netherlands!
                        </p>
                        <a href="production.php" class="slide-btn">
                            <i class="fas fa-play-circle"></i> Bekijk Video's
                        </a>
                    </div>
                </div>
            </div>

            <button class="slider-btn slider-btn-prev" onclick="changeSlide(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="slider-btn slider-btn-next" onclick="changeSlide(1)">
                <i class="fas fa-chevron-right"></i>
            </button>

            <div class="slider-dots">
                <span class="dot active" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    </div>

    <!-- Support Us Section -->
    <div class="support-section">
        <div class="support-content">
            <div>
                <img src="uploads/BFF/73142347_2516680178556715_4378277983526322176_n.jpg" alt="Support Us"
                    class="support-image">
            </div>
            <div>
                <h2 class="section-title">Support Us</h2>
                <p class="support-text">
                    Did our story inspire you and would you like to support our cause? You can do so with a donation via
                    iDeal or a credit card.
                    <br><br>
                    We appreciate every contribution.
                </p>
                <button class="donate-btn">Donate</button>
                <div class="payment-methods">
                    <img src="uploads/BFF/ideal.jpg" alt="iDeal" class="payment-method">
                    <img src="uploads/BFF/american-express.jpg" alt="American Express" class="payment-method">
                    <img src="uploads/BFF/visa.jpg" alt="Visa" class="payment-method">
                    <img src="uploads/BFF/mastercard.jpg" alt="Payment Tool" class="payment-method">
                    <img src="uploads/BFF/paypal.jpg" alt="PayPal" class="payment-method">
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <div class="contact-content">
            <div class="contact-info">
                <h2>CONTACT</h2>

                <div class="contact-group">
                    <div class="contact-label">ADDRESS</div>
                    <div class="contact-details">
                        <div class="contact-item">
                            <h6>Rotterdam (BFF Head Office)</h6>
                            <p>Weena 70, 10th floor</p>
                            <p>3012 CM Rotterdam</p>
                        </div>
                        <div class="contact-item">
                            <h6>Amsterdam (BFF Office)</h6>
                            <p>A-Lab, Overhoeksplein 2,</p>
                            <p>1031 KS Amsterdam</p>
                        </div>
                    </div>
                </div>

                <div class="contact-group">
                    <div class="contact-label">PHONE</div>
                    <p>+31 6 27459194</p>
                    <p>You can reach us on Mondays, Tuesdays and Thursdays from 10:00-18:00</p>
                </div>

                <div class="contact-group">
                    <div class="contact-label">EMAIL</div>
                    <p><a href="mailto:info@buddyfilmfoundation.com">info@buddyfilmfoundation.com</a></p>
                    <p><a href="mailto:casting@buddyfilmfoundation.com">casting@buddyfilmfoundation.com</a></p>
                </div>

                <div class="contact-group">
                    <div class="contact-label">BILLING ADDRESS</div>
                    <div class="contact-details">
                        <div class="contact-item">
                            <h6>Foundation</h6>
                            <p>Stichting Buddy Film Foundation</p>
                            <p>Weena 70, 10th floor</p>
                            <p>3012 CM Rotterdam</p>
                            <p>KVK: 67827985</p>
                            <p>BTW-nummer: NL857189177B01</p>
                            <p><a href="mailto:dewi@buddyfilmfoundation.com">dewi@buddyfilmfoundation.com</a></p>
                        </div>
                        <div class="contact-item">
                            <h6>Productions</h6>
                            <p>Buddy Film Productions BV</p>
                            <p>Weena 70, 10th floor</p>
                            <p>3012 CM Rotterdam</p>
                            <p>KVK: 92133142</p>
                            <p>BTW-nummer: NL865899022B01</p>
                            <p><a href="mailto:dewi@buddyfilmfoundation.com">dewi@buddyfilmfoundation.com</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h2>Do you have a question?</h2>
                <form>
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject">
                    </div>
                    <div class="form-group">
                        <label for="message" class="form-label">Your message</label>
                        <textarea class="form-control" id="message" rows="5"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">SUBMIT</button>
                </form>

                <div class="social-links">
                    <a href="https://www.facebook.com/buddyfilmfoundation" target="_blank" title="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://nl.linkedin.com/company/buddyfilmfoundation" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/buddyfilmfoundation/" target="_blank" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Slider functionality
let currentSlideIndex = 1;
const totalSlides = 3;

function showSlide(n) {
    // Hide all slides
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    // Show current slide
    if (n > totalSlides) currentSlideIndex = 1;
    if (n < 1) currentSlideIndex = totalSlides;

    const currentSlide = document.querySelector(`[data-slide="${currentSlideIndex}"]`);
    const currentDot = document.querySelector(`.dot:nth-child(${currentSlideIndex})`);

    if (currentSlide) currentSlide.classList.add('active');
    if (currentDot) currentDot.classList.add('active');
}

function changeSlide(direction) {
    showSlide(currentSlideIndex += direction);
}

function currentSlide(n) {
    currentSlideIndex = n;
    showSlide(currentSlideIndex);
}

// Auto-advance slides every 5 seconds
setInterval(() => {
    changeSlide(1);
}, 5000);

// Gallery functionality
let currentGalleryIndex = 0;
const totalGalleryImages = 14;

function showGalleryImage(n) {
    // Hide all gallery items
    const galleryItems = document.querySelectorAll('.gallery-item');
    const galleryDots = document.querySelectorAll('.gallery-dot');

    galleryItems.forEach(item => item.classList.remove('active'));
    galleryDots.forEach(dot => dot.classList.remove('active'));

    // Show current gallery item
    if (n >= totalGalleryImages) currentGalleryIndex = 0;
    if (n < 0) currentGalleryIndex = totalGalleryImages - 1;

    const currentItem = document.querySelector(`[data-index="${currentGalleryIndex}"]`);
    const currentDot = document.querySelector(`.gallery-dot:nth-child(${currentGalleryIndex + 1})`);

    if (currentItem) currentItem.classList.add('active');
    if (currentDot) currentDot.classList.add('active');
}

function changeGalleryImage(direction) {
    showGalleryImage(currentGalleryIndex += direction);
}

function goToGalleryImage(n) {
    currentGalleryIndex = n;
    showGalleryImage(currentGalleryIndex);
}

// New Image Slider functionality
let currentNewSliderIndex = 0;
const totalNewSliderImages = 2;

function showNewSliderImage(n) {
    // Hide all new slider items
    const newSliderItems = document.querySelectorAll('.new-slider-item');
    const newSliderDots = document.querySelectorAll('.new-slider-dot');

    newSliderItems.forEach(item => item.classList.remove('active'));
    newSliderDots.forEach(dot => dot.classList.remove('active'));

    // Show current new slider item
    if (n >= totalNewSliderImages) currentNewSliderIndex = 0;
    if (n < 0) currentNewSliderIndex = totalNewSliderImages - 1;

    const currentItem = document.querySelector(`[data-slide="${currentNewSliderIndex}"]`);
    const currentDot = document.querySelector(`.new-slider-dot:nth-child(${currentNewSliderIndex + 1})`);

    if (currentItem) currentItem.classList.add('active');
    if (currentDot) currentDot.classList.add('active');
}

function changeNewSliderImage(direction) {
    showNewSliderImage(currentNewSliderIndex += direction);
}

function goToNewSliderImage(n) {
    currentNewSliderIndex = n;
    showNewSliderImage(currentNewSliderIndex);
}

// Initialize slider
document.addEventListener('DOMContentLoaded', function() {
    showSlide(currentSlideIndex);
    showGalleryImage(currentGalleryIndex);
    showNewSliderImage(currentNewSliderIndex);
});
</script>

<?php include 'inc/footer.php'; ?>