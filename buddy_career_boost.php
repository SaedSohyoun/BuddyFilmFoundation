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
    background: black;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    height: 60vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* Who is it for Section */
.who-is-it-section {
    background: black;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    height: 60vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* What is the goal Section */
.what-is-goal-section {
    background: black;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    height: 80vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* 2024 Participants Section */
.participants-section {
    background: black;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    min-height: 80vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* 2024 Program Section */
.program-section {
    background: black;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    min-height: 80vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

/* Program Focus & Application Section */
.program-focus-section {
    background: linear-gradient(135deg, rgba(75, 0, 130, 0.3) 0%, rgba(0, 130, 137, 0.3) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 0;
    margin: 100px;
    position: relative;
    overflow: hidden;
    min-height: 80vh;
    width: 100vw;
    display: flex;
    box-shadow: 0 0 50px rgba(0, 130, 137, 0.3), inset 0 0 100px rgba(0, 130, 137, 0.1);
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
}

.program-focus-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: left;
    width: 100%;
    display: flex;
    gap: 4rem;
}

.program-focus-left-column,
.program-focus-right-column {
    flex: 1;
}

.program-focus-title {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
    text-align: center;
}

.program-focus-title .teal-text {
    color: rgba(0, 130, 137, 1);
}

.years-timeline-vertical {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin: 2rem 0;
    position: relative;
}

.year-box {
    background-color: transparent;
    border: 1px solid white;
    border-radius: 10px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
}

.year-box.active {
    border: 2px solid white;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
}

.year-box.active::after {
    content: "";
    position: absolute;
    right: -2rem;
    top: 50%;
    width: 2rem;
    height: 2px;
    background: white;
    border-top: 2px dashed white;
}

.year-number {
    color: white;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
}

.year-focus {
    color: #e0e0e0;
    font-size: 1.2rem;
    font-weight: 600;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
}

.application-section {
    margin: 3rem 0;
}

.application-title {
    color: white;
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
    position: relative;
}

.application-title::before {
    content: "📎";
    position: absolute;
    left: -2rem;
    top: 0;
    font-size: 1.5rem;
}

.application-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

.application-text a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    font-weight: 600;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.6);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.4));
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 2px;
}

.application-text a:hover {
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.8);
    filter: drop-shadow(0 0 15px rgba(0, 130, 137, 0.6));
    border-bottom: 2px solid rgba(0, 130, 137, 1);
    transform: translateY(-1px);
}

.round-title {
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 2rem 0 1rem 0;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
}

.contact-info {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 2rem 0;
}

.contact-info p {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin: 0.5rem 0;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

.contact-info p:last-child {
    color: white;
    font-weight: bold;
}

.bcb-production-section {
    margin: 2rem 0;
    padding: 0;
    background-color: transparent;
    border: none;
    border-radius: 0;
    transition: none;
    box-shadow: none;
}

.bcb-production-section:hover {
    transform: none;
    box-shadow: none;
    border-color: transparent;
}

.bcb-production-title {
    color: white;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
    text-align: left;
}

.bcb-production-title .teal-text {
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.8);
}

.bcb-production-subtitle {
    color: #e0e0e0;
    font-size: 1.3rem;
    font-weight: bold;
    margin: 1.5rem 0 1rem 0;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
}

.passion-list {
    list-style: none;
    padding: 0;
    margin: 1rem 0;
}

.passion-list li {
    color: rgba(0, 130, 137, 1);
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
    position: relative;
    padding-left: 1.5rem;
}

.passion-list li::before {
    content: "–";
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    position: absolute;
    left: 0;
    top: 0;
}

.workshops-preview {
    margin: 2rem 0;
}

.workshops-preview-title {
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
}

.workshops-preview-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.workshops-preview-list li {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
    position: relative;
    padding-left: 1.5rem;
}

.workshops-preview-list li::before {
    content: "-";
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    position: absolute;
    left: 0;
    top: 0;
}

.practical-points {
    margin: 2rem 0;
}

.practical-points-title {
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.6);
}

.practical-points-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.practical-points-list li {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
    position: relative;
    padding-left: 1.5rem;
}

.practical-points-list li::before {
    content: "-";
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    position: absolute;
    left: 0;
    top: 0;
}

.highlight-text {
    color: rgba(0, 130, 137, 1);
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.8);
}

.program-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: left;
    width: 100%;
    display: flex;
    gap: 4rem;
}

.program-left-column,
.program-right-column {
    flex: 1;
}

.program-title {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
}

.program-title .teal-text {
    color: rgba(0, 130, 137, 1);
}

.program-intro {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin-bottom: 3rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

.themes-title,
.workshops-title {
    color: #e0e0e0;
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

.themes-list,
.workshops-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.themes-list li,
.workshops-list li {
    color: rgba(0, 130, 137, 1);
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
    position: relative;
    padding-left: 1.5rem;
}

.themes-list li::before,
.workshops-list li::before {
    content: "•";
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    position: absolute;
    left: 0;
    top: 0;
}

.themes-grid {
    display: flex;
    gap: 0;
    margin-bottom: 2rem;
}

.theme-card {
    background-color: #2a2a2a;
    padding: 20px;
    border: none;
    transition: all 0.3s ease;
    box-shadow: none;
    text-align: center;
    margin: 0;
    flex: 1;
    color: #e0e0e0;
}

.theme-card:nth-child(1) {
    background-color: #d3d3d3;
    color: #333;
}

.theme-card:nth-child(2) {
    background-color: #a0a0a0;
    color: #333;
}

.theme-card:nth-child(3) {
    background-color: #808080;
    color: #333;
}

.theme-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
}

.theme-name {
    color: inherit;
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
}

.workshops-section {
    margin-top: 3rem;
}

.workshops-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.workshop-item {
    background-color: #1a1a1a;
    border: 1px solid rgba(0, 130, 137, 0.3);
    padding: 1.5rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
}

.workshop-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.workshop-name {
    color: #e0e0e0;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 0 10px rgba(0, 130, 137, 0.3);
}

.participants-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: left;
    width: 100%;
}

.participants-title {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 3rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
    text-align: center;
}

.participants-title .teal-text {
    color: rgba(0, 130, 137, 1);
}

.participants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.participant-card {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(0, 130, 137, 0.3);
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    text-align: center;
}

.participant-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.6);
}

.participant-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 1rem;
    border: 3px solid rgba(0, 130, 137, 0.5);
    transition: all 0.3s ease;
}

.participant-card:hover .participant-image {
    border-color: rgba(0, 130, 137, 1);
    transform: scale(1.05);
}

.participant-name {
    color: #e0e0e0;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 0 10px rgba(0, 130, 137, 0.3);
}

.what-is-goal-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.what-is-goal-text-section {
    flex: 1;
    max-width: 60%;
}

.what-is-goal-image-section {
    flex: 1;
    max-width: 35%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.what-is-goal-image-placeholder {
    width: 100%;
    height: 300px;
    background-color: #333;
    border: 2px dashed #666;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 1.2rem;
    text-align: center;
}

.what-is-goal-title {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
}

.what-is-goal-title .teal-text {
    color: rgba(0, 130, 137, 1);
}

.what-is-goal-text {
    color: #e0e0e0;
    font-size: 1rem;
    margin-bottom: 2rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
}

.buddy-career-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: left;
}

.who-is-it-content {
    position: relative;
    z-index: 2;
    max-width: 1100px;
    margin: 0 0 0 auto;
    padding: 0 2rem;
    text-shadow: 0 0 20px rgba(0, 130, 137, 0.5);
    text-align: right;
}

.buddy-career-title,
.who-is-it-title {
    color: white;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 2rem;
    text-shadow: 0 0 30px rgba(0, 130, 137, 0.8), 0 0 60px rgba(0, 130, 137, 0.4);
    text-transform: uppercase;
    letter-spacing: 2px;
    filter: drop-shadow(0 0 20px rgba(0, 130, 137, 0.6));
}

.buddy-career-title .teal-text,
.who-is-it-title .teal-text {
    color: rgba(0, 130, 137, 1);
}

.buddy-career-text,
.who-is-it-text {
    color: #e0e0e0;
    font-size: 1rem;
    margin-bottom: 3rem;
    font-weight: 300;
    line-height: 1.6;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.4);
    filter: drop-shadow(0 0 10px rgba(0, 130, 137, 0.3));
    max-width: 800px;
}

/* Features Grid */
.features-grid {
    display: flex;
    margin-top: 4rem;
    width: 100%;
}

.feature-card {
    background-color: #2a2a2a;
    padding: 15px;
    border: none;
    transition: all 0.3s ease;
    box-shadow: none;
    text-align: left;
    margin: 0;
    flex: 1;
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

.feature-title {
    color: #333;
    font-size: 1rem;
    font-weight: 500;
}

/* Who is it for Grid */
.who-is-it-grid {
    display: flex;
    margin-top: 4rem;
    width: 100%;
    justify-content: flex-end;
}

.who-is-it-card {
    background-color: #2a2a2a;
    padding: 15px;
    border: none;
    transition: all 0.3s ease;
    box-shadow: none;
    text-align: right;
    margin: 0;
    flex: 1;
}

.who-is-it-card:nth-child(1) {
    background-color: #d3d3d3;
    color: #333;
}

.who-is-it-card:nth-child(2) {
    background-color: #a0a0a0;
    color: #333;
}

.who-is-it-card:nth-child(3) {
    background-color: #808080;
    color: #333;
}

.who-is-it-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    border-color: rgba(0, 130, 137, 0.5);
}

.who-is-it-card-text {
    color: #333;
    font-size: 1rem;
    font-weight: 500;
    text-align: right;
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

<!-- What is Buddy Career Boost -->
<div class="buddy-career-section">
    <div class="buddy-career-content">
        <h2 class="buddy-career-title"><span class="teal-text">WHAT IS</span> BUDDY CAREER BOOST ?</h2>
        <p class="buddy-career-text">The Buddy Career Boost is a training program for newcomers in the Netherlands with
            a background in film and television. Participants take part in workshops, training sessions, language
            lessons, and networking events.</p>
        <div class="features-grid">
            <div class="feature-card">
                <h3 class="feature-title">Workshops & Training</h3>
            </div>
            <div class="feature-card">
                <h3 class="feature-title">Networking Events</h3>
            </div>
            <div class="feature-card">
                <h3 class="feature-title">Dutch Language Lessons</h3>
            </div>
        </div>
    </div>
</div>

<!-- Who is it for -->
<div class="who-is-it-section">
    <div class="who-is-it-content">
        <h2 class="who-is-it-title"><span class="teal-text">WHO IS</span> IT FOR ?</h2>
        <div class="who-is-it-grid">
            <div class="who-is-it-card">
                <p class="who-is-it-card-text">Professionals with film & TV experience from their home country.</p>
            </div>
            <div class="who-is-it-card">
                <p class="who-is-it-card-text">Newcomers living in the Netherlands.</p>
            </div>
            <div class="who-is-it-card">
                <p class="who-is-it-card-text">Open to various disciplines – directing, acting, sound design, editing,
                    etc.</p>
            </div>
        </div>
    </div>
</div>

<!-- What is the goal -->
<div class="what-is-goal-section">
    <div class="what-is-goal-content">
        <div class="what-is-goal-text-section">
            <h2 class="what-is-goal-title"><span class="teal-text">WHAT IS</span> THE GOAL ?</h2>
            <p class="what-is-goal-text">Many people in our community face a knowledge gap due to long waiting periods,
                uncertainty, and a lack of opportunities to practice their craft. The Buddy Career Boost helps
                accelerate the integration of newcomer professionals into Dutch society by providing training in
                industry knowledge, entrepreneurship skills, and cultural adaptation.</p>
            <p class="what-is-goal-text">The goal is to bridge this knowledge and cultural gap through workshops and
                training sessions while also introducing participants to industry networks and preparing them for the
                job market.</p>
        </div>
        <div class="what-is-goal-image-section">
            <img src="uploads/BCB/WITG.jpg" alt="What is the goal"
                style="width: 100%; height: 400px; object-fit: contain; border-radius: 10px; border-top: 4px solid rgba(0, 130, 137, 1); border-right: 4px solid rgba(0, 130, 137, 1);">
        </div>
    </div>
</div>

<!-- 2024 Participants -->
<div class="participants-section">
    <div class="participants-content">
        <h2 class="participants-title"><span class="teal-text">2024</span> PARTICIPANTS</h2>
        <div class="participants-grid">
            <div class="participant-card">
                <img src="uploads/BCB/1920_ayazsaadatpourvahid.jpg" alt="Ayaz Saadatpour Vahid"
                    class="participant-image">
                <p class="participant-name">Ayaz Saadatpour Vahid</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/Obaid.jpg" alt="Obaid Ba-Obaid" class="participant-image">
                <p class="participant-name">Obaid Ba-Obaid</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/o_edited.jpg" alt="Anoud Alhbaidi" class="participant-image">
                <p class="participant-name">Anoud Alhbaidi</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/o_edited.jpg" alt="Razzaq Mawda" class="participant-image">
                <p class="participant-name">Razzaq Mawda</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/Yevghen Kuzmenko by Maria Bodrug-5.jpg" alt="Yevhen Kuzmenko"
                    class="participant-image">
                <p class="participant-name">Yevhen Kuzmenko</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/myriam_bw-1.jpg" alt="Myriam Bejaoui" class="participant-image">
                <p class="participant-name">Myriam Bejaoui</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/DSC000001_JPG.jpg" alt="Shaba Namdar" class="participant-image">
                <p class="participant-name">Shaba Namdar</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/Mohammad Turkawi by Maria Bodrug" alt="Mohammad Turkawi"
                    class="participant-image">
                <p class="participant-name">Mohammad Turkawi</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/o_edited.jpg" alt="Ramy Azmy" class="participant-image">
                <p class="participant-name">Ramy Azmy</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/524A9558.jpg" alt="Maen Sawwan" class="participant-image">
                <p class="participant-name">Maen Sawwan</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/Sabrine Khoury.jpg" alt="Sabrine Khoury" class="participant-image">
                <p class="participant-name">Sabrine Khoury</p>
            </div>
            <div class="participant-card">
                <img src="uploads/BCB/1680047713344.jpg" alt="Mohammad Alboushi" class="participant-image">
                <p class="participant-name">Mohammad Alboushi</p>
            </div>
        </div>
    </div>
</div>

<!-- 2024 Program -->
<div class="program-section">
    <div class="program-content">
        <div class="program-left-column">
            <p class="program-intro">In 2024, the program will focus on post-production, covering areas such as editing,
                sound design, and emerging technologies like Virtual Production and AI.</p>

            <div class="themes-section">
                <h3 class="themes-title">The curriculum consists of three main themes:</h3>
                <ul class="themes-list">
                    <li>Post-production skills</li>
                    <li>Language proficiency</li>
                    <li>Personal development</li>
                </ul>
            </div>
        </div>
        <div class="program-right-column">
            <h3 class="workshops-title">These themes are explored through workshops on topics such as:</h3>
            <ul class="workshops-list">
                <li>Weekly Dutch language lessons</li>
                <li>Dutch film history</li>
                <li>Entrepreneurship in the Netherlands</li>
                <li>The media industry in the Netherlands</li>
                <li>Post-production workflow</li>
                <li>VFX workshop</li>
                <li>Sound design workshop</li>
                <li>Virtual production workshop</li>
            </ul>
        </div>
    </div>
</div>

<!-- Program Focus & Application -->
<div class="program-focus-section">
    <div class="program-focus-content">
        <div class="program-focus-left-column">
            <h2 class="program-focus-title"><span class="teal-text">PROGRAM</span> FOCUS</h2>
            
            <div class="years-timeline-vertical">
                <div class="year-box">
                    <div class="year-number">2024</div>
                    <div class="year-focus">Post-Production</div>
                </div>
                <div class="year-box active">
                    <div class="year-number">2025</div>
                    <div class="year-focus">Production</div>
                </div>
                <div class="year-box">
                    <div class="year-number">2026</div>
                    <div class="year-focus">Screenwriting</div>
                </div>
            </div>
            
            <div class="application-section">
                <h3 class="application-title">How to apply:</h3>
                <p class="application-text">The selection process consists of a group workshop and one on one meetings afterwards.</p>
                
                <h4 class="round-title">ROUND 1</h4>
                <p class="application-text">Send a letter (max 1 page) with your motivation and CV (Resume). Or instead of a letter, you can choose to send in a recorded video of yourself with your motivation (via WeTransfer or Google Drive link).</p>
                <p class="application-text">Send it in to <a href="mailto:ahmed@buddyfilmfoundation.com">ahmed@buddyfilmfoundation.com</a>.</p>
            </div>

            <div class="contact-info">
                <p>If you have any questions about the program you can mail Ahmed at his email as well or call the office number:</p>
                <p>+31 (0) 103 077 271</p>
            </div>
        </div>
        
        <div class="program-focus-right-column">
            <h3 class="bcb-production-title">Register for the next phase of <span class="teal-text">BCB-</span>PRODUCTION!</h3>
            <p class="bcb-production-subtitle">Are you an aspiring or emerging producer?</p>
            
            <p class="application-text">Do you have a passion for:</p>
            <ul class="passion-list">
                <li>Producing</li>
                <li>Production Management</li>
                <li>Line Producing</li>
                <li>Budgeting & Scheduling</li>
                <li>Or any other aspect of film production you'd like to grow in?</li>
            </ul>
            
            <p class="application-text">Are you new to the Netherlands and looking for guidance as you navigate the local film industry?</p>
            <p class="application-text"><span class="highlight-text">Then the Buddy Career Program is made for you.</span></p>
            
            <div class="workshops-preview">
                <h4 class="workshops-preview-title">Here is a quick sneak peek of the workshops we want to offer:</h4>
                <ul class="workshops-preview-list">
                    <li>Production specific workshops from professionals from the industry</li>
                    <li>Language courses</li>
                    <li>Dutch Film Industry overview and history</li>
                </ul>
            </div>
            
            <div class="practical-points">
                <h4 class="practical-points-title">Practical Points:</h4>
                <ul class="practical-points-list">
                    <li>The BCB25 period runs from June 2025 to December 2025, 4-6 days per month.</li>
                    <li>Participation is free and voluntary, but not without obligation. Therefore, we also ask you to sign a participation agreement.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>