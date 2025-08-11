<?php
session_start();
include 'inc/header.php';

// Haal donatie informatie op als deze beschikbaar is
$donationId = $_GET['donation_id'] ?? null;
$transactionId = $_GET['tx'] ?? null;
?>

<style>
body {
    background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
    color: white;
    font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.success-container {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.95) 0%, rgba(34, 34, 34, 0.95) 100%);
    border: 1px solid rgba(0, 130, 137, 0.3);
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    max-width: 600px;
    width: 90%;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.success-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 2.5rem;
    color: white;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.success-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.success-message {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #ccc;
}

.donation-details {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(0, 130, 137, 0.2);
    border-radius: 10px;
    padding: 1.5rem;
    margin: 2rem 0;
    text-align: left;
}

.donation-details h4 {
    color: rgba(0, 130, 137, 1);
    margin-bottom: 1rem;
}

.donation-details p {
    margin: 0.5rem 0;
    font-family: 'Courier New', monospace;
}

.btn-home {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-top: 1rem;
}

.btn-home:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.4);
    color: white;
    text-decoration: none;
}
</style>

<div class="success-container">
    <div class="success-icon">
        <i class="fas fa-check"></i>
    </div>
    
    <h1 class="success-title">Thank You!</h1>
    
    <p class="success-message">
        Your donation has been successfully processed. Your support means the world to us and will help us continue our mission to empower the next generation of filmmakers.
    </p>
    
    <?php if ($donationId || $transactionId): ?>
    <div class="donation-details">
        <h4>Donation Details</h4>
        <?php if ($donationId): ?>
        <p><strong>Donation ID:</strong> #<?= htmlspecialchars($donationId) ?></p>
        <?php endif; ?>
        <?php if ($transactionId): ?>
        <p><strong>Transaction ID:</strong> <?= htmlspecialchars($transactionId) ?></p>
        <?php endif; ?>
        <p><strong>Date:</strong> <?= date('d-m-Y H:i') ?></p>
        <p><strong>Status:</strong> <span style="color: #28a745;">✓ Completed</span></p>
    </div>
    <?php endif; ?>
    
    <p style="color: #888; font-size: 0.9rem; margin-top: 2rem;">
        You will receive a confirmation email shortly. Please keep this information for your records.
    </p>
    
    <a href="index.php" class="btn-home">
        <i class="fas fa-home"></i> Return to Homepage
    </a>
</div>

<?php include 'inc/footer.php'; ?>
