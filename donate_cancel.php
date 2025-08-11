<?php
session_start();
include 'inc/header.php';
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

.cancel-container {
    background: linear-gradient(145deg, rgba(26, 26, 26, 0.95) 0%, rgba(34, 34, 34, 0.95) 100%);
    border: 1px solid rgba(220, 53, 69, 0.3);
    border-radius: 20px;
    padding: 3rem;
    text-align: center;
    max-width: 600px;
    width: 90%;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
}

.cancel-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    font-size: 2.5rem;
    color: white;
}

.cancel-title {
    color: #dc3545;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.cancel-message {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    color: #ccc;
}

.btn-donate {
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
    margin: 1rem 0.5rem;
}

.btn-donate:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.4);
    color: white;
    text-decoration: none;
}

.btn-home {
    background: transparent;
    color: #ccc;
    border: 1px solid #ccc;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin: 1rem 0.5rem;
}

.btn-home:hover {
    background: #ccc;
    color: #000;
    text-decoration: none;
}
</style>

<div class="cancel-container">
    <div class="cancel-icon">
        <i class="fas fa-times"></i>
    </div>
    
    <h1 class="cancel-title">Payment Cancelled</h1>
    
    <p class="cancel-message">
        Your donation payment was cancelled. No charges have been made to your account. If you'd like to try again or have any questions, please don't hesitate to contact us.
    </p>
    
    <div>
        <a href="donate.php" class="btn-donate">
            <i class="fas fa-heart"></i> Try Again
        </a>
        
        <a href="index.php" class="btn-home">
            <i class="fas fa-home"></i> Return Home
        </a>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
