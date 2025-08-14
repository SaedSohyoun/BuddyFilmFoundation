<?php
include 'inc/header.php';

// Toon succes/error berichten van process_contact.php
$fout = $succes = "";

if (isset($_GET['contact']) && $_GET['contact'] === 'success') {
    $succes = "Bericht verzonden! We nemen zo snel mogelijk contact met je op.";
} elseif (isset($_GET['contact']) && $_GET['contact'] === 'error') {
    $fout = "Er is een fout opgetreden bij het versturen van het bericht. Probeer het later opnieuw.";
}
?>

<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.contact-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.contact-card {
    background-color: #1a1a1a;
    border: 1px solid #333;
    border-radius: 15px;
    padding: 3rem;
    max-width: 600px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.contact-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.contact-header h1 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.contact-header p {
    color: #ccc;
    font-size: 1.1rem;
    margin: 0;
    line-height: 1.6;
}

.form-control {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: #2a2a2a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
}

.form-label {
    color: white;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.btn-contact {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-contact:hover {
    background-color: #00676d;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
}

.alert {
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: none;
}

.alert-danger {
    background-color: #7f1d1d;
    color: white;
    border-left: 4px solid #dc3545;
}

.alert-success {
    background-color: #14532d;
    color: white;
    border-left: 4px solid #28a745;
}

.form-floating {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-floating input,
.form-floating textarea {
    height: 3.5rem;
}

.form-floating textarea {
    height: 8rem;
    resize: vertical;
}

.form-floating label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    padding: 1rem 0.75rem;
    pointer-events: none;
    border: 1px solid transparent;
    transform-origin: 0 0;
    transition: opacity .1s ease-in-out, transform .1s ease-in-out;
    color: #ccc;
}

.form-floating input:focus~label,
.form-floating input:not(:placeholder-shown)~label,
.form-floating textarea:focus~label,
.form-floating textarea:not(:placeholder-shown)~label {
    opacity: .65;
    transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
}

.back-link {
    text-align: center;
    margin-top: 2rem;
}

.back-link a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.back-link a:hover {
    color: white;
}

.contact-info {
    background-color: #2a2a2a;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid rgba(0, 130, 137, 1);
}

.contact-info h3 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.contact-info p {
    margin: 0.5rem 0;
    color: #ccc;
}

.contact-info a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
}

.contact-info a:hover {
    color: white;
}

@media (max-width: 768px) {
    .contact-card {
        padding: 2rem;
        margin: 1rem;
    }

    .contact-header h1 {
        font-size: 2rem;
    }
}
</style>

<div class="contact-container">
    <div class="contact-card">
        <div class="contact-header">
            <h1>Get in Touch</h1>
            <p>Have a question or want to collaborate? We'd love to hear from you.</p>
        </div>

        <div class="contact-info">
            <h3><i class="fas fa-info-circle me-2"></i>Contact Information</h3>
            <p><i class="fas fa-envelope me-2"></i><a
                    href="mailto:info@buddyfilmfoundation.com">info@buddyfilmfoundation.com</a></p>
            <p><i class="fas fa-phone me-2"></i>+31 6 27459194</p>
            <p><i class="fas fa-clock me-2"></i>Mon, Tue, Thu: 10:00-18:00</p>
        </div>

        <?php if ($fout): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($fout) ?>
        </div>
        <?php endif; ?>

        <?php if ($succes): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle me-2"></i>
            <?= htmlspecialchars($succes) ?>
        </div>
        <?php endif; ?>

        <form method="post" action="process_contact.php">
            <div class="form-floating">
                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required
                    value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                <label for="name">Your Name</label>
            </div>

            <div class="form-floating">
                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <label for="email">Your Email</label>
            </div>

            <div class="form-floating">
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required
                    value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                <label for="subject">Subject</label>
            </div>

            <div class="form-floating">
                <textarea name="message" id="message" class="form-control" placeholder="Your Message"
                    required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                <label for="message">Your Message</label>
            </div>

            <button type="submit" class="btn btn-contact">
                <i class="fas fa-paper-plane me-2"></i>
                Send Message
            </button>
        </form>

        <div class="back-link">
            <a href="index.php">
                <i class="fas fa-arrow-left me-1"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>