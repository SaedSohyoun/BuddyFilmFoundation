<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';
?>

<style>
body {
    background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
    color: white;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
    margin: 0;
    padding: 0;
    font-size: 1rem;
    line-height: 1.6;
    overflow-x: hidden;
}

/* Animated background particles */
.particles {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
}

.particle {
    position: absolute;
    width: 2px;
    height: 2px;
    background: rgba(0, 130, 137, 0.3);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0; }
    50% { transform: translateY(-20px) rotate(180deg); opacity: 1; }
}

.hero-section {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 2rem 0;
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

.page-title {
    color: rgba(0, 130, 137, 1);
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.page-subtitle {
    color: #ccc;
    font-size: 1.2rem;
    margin-bottom: 2rem;
    font-weight: 400;
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

.content-section {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.9) 0%, rgba(34, 34, 34, 0.9) 100%);
    border-radius: 20px;
    padding: 2.5rem;
    margin-bottom: 2.5rem;
    border: 1px solid rgba(0, 130, 137, 0.2);
    box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(0, 130, 137, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.content-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, rgba(0, 130, 137, 0.8), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.content-section:hover::before {
    transform: translateX(100%);
}

.content-section:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(0, 130, 137, 0.3);
    border-color: rgba(0, 130, 137, 0.4);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: clamp(1.5rem, 3vw, 2.2rem);
    font-weight: 700;
    margin-bottom: 2rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 1rem;
    position: relative;
    letter-spacing: -0.01em;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, rgba(0, 130, 137, 1), transparent);
}

.mission-text {
    color: #e0e0e0;
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    font-weight: 400;
}

.mission-text p {
    margin-bottom: 1.5rem;
    opacity: 0.95;
}

.payment-methods {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.payment-method {
    background: linear-gradient(145deg, rgba(42, 42, 42, 0.9) 0%, rgba(51, 51, 51, 0.9) 100%);
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid rgba(0, 130, 137, 0.2);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.payment-method::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 130, 137, 0.1), transparent);
    transition: left 0.5s ease;
}

.payment-method:hover::before {
    left: 100%;
}

.payment-method:hover {
    transform: translateY(-8px);
    border-color: rgba(0, 130, 137, 0.6);
    box-shadow: 0 15px 35px rgba(0, 130, 137, 0.2);
}

.payment-method img {
    width: 70px;
    height: 45px;
    object-fit: contain;
    margin-bottom: 1.5rem;
    filter: grayscale(30%);
    transition: all 0.3s ease;
}

.payment-method:hover img {
    filter: grayscale(0%);
    transform: scale(1.1);
}

.payment-method h4 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    margin-bottom: 0.8rem;
    font-weight: 600;
}

.payment-method p {
    color: #ccc;
    font-size: 0.95rem;
    margin: 0;
    font-weight: 400;
}

.bank-info {
    background: linear-gradient(145deg, rgba(42, 42, 42, 0.9) 0%, rgba(51, 51, 51, 0.9) 100%);
    border-radius: 15px;
    padding: 2rem;
    border: 1px solid rgba(0, 130, 137, 0.2);
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.bank-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(0, 130, 137, 0.05) 50%, transparent 70%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: translateX(-100%); }
    50% { transform: translateX(100%); }
}

.bank-info h4 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.3rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
    position: relative;
    z-index: 1;
}

.bank-details {
    color: #e0e0e0;
    font-family: 'JetBrains Mono', 'Fira Code', 'Courier New', monospace;
    font-size: 1rem;
    line-height: 1.8;
    position: relative;
    z-index: 1;
}

.bank-details strong {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
}

.bank-details p {
    margin-bottom: 0.8rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0, 130, 137, 0.1);
}

.donation-form {
    background: linear-gradient(145deg, rgba(42, 42, 42, 0.9) 0%, rgba(51, 51, 51, 0.9) 100%);
    border-radius: 20px;
    padding: 2.5rem;
    border: 1px solid rgba(0, 130, 137, 0.2);
    position: relative;
    overflow: hidden;
}

.donation-form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at top right, rgba(0, 130, 137, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.form-group {
    margin-bottom: 2rem;
    position: relative;
}

.form-label {
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    margin-bottom: 0.8rem;
    display: block;
    position: relative;
}

.form-label::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 20px;
    height: 2px;
    background: rgba(0, 130, 137, 0.5);
    transition: width 0.3s ease;
}

.form-group:focus-within .form-label::after {
    width: 40px;
}

.form-control {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.9) 0%, rgba(34, 34, 34, 0.9) 100%);
    border: 2px solid rgba(0, 130, 137, 0.2);
    border-radius: 12px;
    color: white;
    padding: 1rem 1.2rem;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    position: relative;
}

.form-control:focus {
    outline: none;
    border-color: rgba(0, 130, 137, 0.8);
    box-shadow: 
        0 0 0 4px rgba(0, 130, 137, 0.1),
        0 8px 25px rgba(0, 130, 137, 0.2);
    transform: translateY(-2px);
}

.form-control::placeholder {
    color: #888;
    font-weight: 400;
}

/* Enhanced Modern Dropdown Styling */
select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3e%3cpath stroke='%23008289' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 9 6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1.2em 1.2em;
    padding-right: 3rem;
    cursor: pointer;
    position: relative;
}

select.form-control:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3e%3cpath stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m6 9 6 6 6-6'/%3e%3c/svg%3e");
}

select.form-control option {
    background-color: #1a1a1a;
    color: white;
    padding: 1rem;
    border: none;
    font-size: 1rem;
}

select.form-control option:hover {
    background-color: rgba(0, 130, 137, 0.2);
}

select.form-control option:checked {
    background-color: rgba(0, 130, 137, 0.3);
    color: white;
}

select.form-control:hover {
    border-color: rgba(0, 130, 137, 0.5);
    background-color: rgba(34, 34, 34, 0.95);
}

.amount-input {
    position: relative;
}

.amount-input::before {
    content: '€';
    position: absolute;
    left: 1.2rem;
    top: 50%;
    transform: translateY(-50%);
    color: rgba(0, 130, 137, 1);
    font-weight: 700;
    font-size: 1.1rem;
    z-index: 2;
    pointer-events: none;
}

.amount-input .form-control {
    padding-left: 3rem;
}

.donate-button, .paypal-button {
    border: none;
    font-weight: 600;
    padding: 1.2rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1.1rem;
    cursor: pointer;
    width: 100%;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.donate-button::before, .paypal-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.donate-button:hover::before, .paypal-button:hover::before {
    left: 100%;
}

.donate-button {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.3);
}

.donate-button:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 130, 137, 0.4);
}

.paypal-button {
    background: linear-gradient(135deg, #0070ba 0%, #1546a0 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(0, 112, 186, 0.3);
    margin-bottom: 1rem;
}

.paypal-button:hover {
    background: linear-gradient(135deg, #1546a0 0%, #0070ba 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 112, 186, 0.4);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section {
        padding: 3rem 0;
        margin-bottom: 3rem;
    }
    
    .content-section {
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .payment-methods {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .donation-form {
        padding: 2rem;
    }
    
    .form-control {
        padding: 0.9rem 1rem;
    }
    
    .donate-button, .paypal-button {
        padding: 1rem 1.5rem;
        font-size: 1rem;
    }
}

/* Loading animation for form submission */
.loading {
    position: relative;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Loading overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-content {
    text-align: center;
    color: white;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 3px solid rgba(0, 130, 137, 0.3);
    border-top: 3px solid rgba(0, 130, 137, 1);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

/* Modal styling */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
}

.modal-content {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.95) 0%, rgba(34, 34, 34, 0.95) 100%);
    border: 1px solid rgba(0, 130, 137, 0.3);
    border-radius: 15px;
    padding: 2rem;
    max-width: 500px;
    width: 90%;
    text-align: center;
    color: white;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.modal-content h3 {
    color: rgba(0, 130, 137, 1);
    margin-bottom: 1rem;
}

.bank-details-modal {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(0, 130, 137, 0.2);
    border-radius: 10px;
    padding: 1rem;
    margin: 1rem 0;
    text-align: left;
}

.bank-details-modal p {
    margin: 0.5rem 0;
    font-family: 'Courier New', monospace;
}

.btn-close {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-close:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
}
</style>

<!-- Animated Background Particles -->
<div class="particles">
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 1s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 3s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 6s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 7s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 8s;"></div>
</div>

<!-- Hero Section -->
<div class="hero-section">
    <div class="hero-content">
        <h1 class="page-title">Support Our Cause</h1>
        <p class="page-subtitle">Help us empower the next generation of filmmakers</p>
    </div>
</div>

<div class="container">
    <!-- Mission Section -->
    <div class="content-section">
        <h2 class="section-title">Our Mission</h2>
        <div class="mission-text">
            <p>Our mission is simple yet profound – to provide a starting point for newcomers in the film industry. Through workshops, network events, coaching, and unwavering support, we guide these talented individuals from the initial stages of development to the execution and funding of their own film projects. The ultimate goal? To help them secure paid jobs and embark on a meaningful journey towards full integration.</p>
            
            <p>This achievement has been made possible through the support of our partners and the generosity of individuals who share the same values as us. If you feel that our mission resonates with you, we invite you to support us with a donation. Every little contribution counts!</p>
        </div>
    </div>

    <!-- Payment Methods Section -->
    <div class="content-section">
        <h2 class="section-title">Payment Methods</h2>
        <div class="payment-methods">
            <div class="payment-method">
                <img src="uploads/BFF/ideal.jpg" alt="iDEAL">
                <h4>iDEAL</h4>
                <p>Direct bank transfer</p>
            </div>
            <div class="payment-method">
                <img src="uploads/BFF/visa.jpg" alt="Visa">
                <h4>Visa</h4>
                <p>Credit card payment</p>
            </div>
            <div class="payment-method">
                <img src="uploads/BFF/american-express.jpg" alt="American Express">
                <h4>American Express</h4>
                <p>Credit card payment</p>
            </div>
            <div class="payment-method">
                <img src="uploads/BFF/mastercard.jpg" alt="Mastercard">
                <h4>Mastercard</h4>
                <p>Credit card payment</p>
            </div>
        </div>
    </div>

    <!-- Bank Account Information -->
    <div class="content-section">
        <h2 class="section-title">Direct Bank Transfer</h2>
        <div class="bank-info">
            <h4>Stichting Buddy Film Foundation</h4>
            <div class="bank-details">
                <p><strong>IBAN:</strong> NL 96 TRIO 0338 5192 89</p>
                <p><strong>BIC:</strong> TRIONL2U</p>
                <p><strong>RSIN:</strong> 857189177</p>
            </div>
        </div>
    </div>

    <!-- Donation Form -->
    <div class="content-section">
        <h2 class="section-title">Make a Donation</h2>
        <div class="donation-form">
            <form id="donationForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="donateInName" class="form-label">Donate in the name of</label>
                    <select class="form-control" id="donateInName" name="donateInName">
                        <option value="">Select an option</option>
                        <option value="myself">Myself</option>
                        <option value="organization">An organization</option>
                        <option value="someone-else">Someone else</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="hearAbout" class="form-label">How did you hear about us?</label>
                    <select class="form-control" id="hearAbout" name="hearAbout">
                        <option value="">Select an option</option>
                        <option value="social-media">Social Media</option>
                        <option value="website">Website</option>
                        <option value="friend">Friend/Family</option>
                        <option value="event">Event</option>
                        <option value="search">Search Engine</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="amount" class="form-label">Enter the amount you wish to pay (€)</label>
                    <div class="amount-input">
                        <input type="number" class="form-control" id="amount" name="amount" min="1" step="0.01" placeholder="0.00" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                        <option value="">Select payment method</option>
                        <option value="paypal">PayPal</option>
                        <option value="ideal">iDEAL</option>
                        <option value="creditcard">Credit Card (Visa/Mastercard/Amex)</option>
                        <option value="banktransfer">Direct Bank Transfer</option>
                    </select>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="donate-button" id="submitBtn">
                            <i class="fas fa-heart"></i> Process Donation
                        </button>
                    </div>
                </div>
                
                <!-- Loading overlay -->
                <div id="loadingOverlay" class="loading-overlay" style="display: none;">
                    <div class="loading-content">
                        <div class="spinner"></div>
                        <p>Processing your donation...</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('donationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const submitBtn = document.getElementById('submitBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const originalText = submitBtn.innerHTML;
    
    // Valideer formulier
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    // Toon loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    loadingOverlay.style.display = 'flex';
    
    // Verzamel form data
    const formData = new FormData(form);
    
    // Stuur naar betalingsverwerking
    fetch('process_payment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Succesvol - verwerk op basis van betalingsmethode
            const paymentMethod = formData.get('paymentMethod');
            
            if (paymentMethod === 'banktransfer') {
                // Toon bankgegevens
                showBankDetails(data.data);
            } else if (data.data.redirect_url) {
                // Redirect naar betalingsprovider
                window.location.href = data.data.redirect_url;
            } else {
                // Succes bericht
                showSuccessMessage(data.message);
            }
        } else {
            // Fout
            showErrorMessage(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorMessage('Er is een fout opgetreden. Probeer het opnieuw.');
    })
    .finally(() => {
        // Reset loading state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        loadingOverlay.style.display = 'none';
    });
});

function showBankDetails(data) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <h3>Bank Transfer Details</h3>
            <p>Please transfer €${data.amount} to the following account:</p>
            <div class="bank-details-modal">
                <p><strong>Beneficiary:</strong> ${data.bank_details.beneficiary}</p>
                <p><strong>IBAN:</strong> ${data.bank_details.iban}</p>
                <p><strong>BIC:</strong> ${data.bank_details.bic}</p>
                <p><strong>Reference:</strong> ${data.bank_details.reference}</p>
            </div>
            <p><strong>Transaction ID:</strong> ${data.transaction_id}</p>
            <p>Please include the reference number in your transfer description.</p>
            <button onclick="this.parentElement.parentElement.remove()" class="btn-close">Close</button>
        </div>
    `;
    document.body.appendChild(modal);
}

function showSuccessMessage(message) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <h3>Success!</h3>
            <p>${message}</p>
            <p>You will receive a confirmation email shortly.</p>
            <button onclick="this.parentElement.parentElement.remove()" class="btn-close">Close</button>
        </div>
    `;
    document.body.appendChild(modal);
}

function showErrorMessage(message) {
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <h3>Error</h3>
            <p>${message}</p>
            <button onclick="this.parentElement.parentElement.remove()" class="btn-close">Close</button>
        </div>
    `;
    document.body.appendChild(modal);
}

// Add scroll animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all content sections
document.querySelectorAll('.content-section').forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'all 0.6s ease-out';
    observer.observe(section);
});
</script>

<?php include 'inc/footer.php'; ?>
