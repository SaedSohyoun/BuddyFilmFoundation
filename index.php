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

h1.h1 {
    color: rgba(0, 130, 137, 1);
    font-size: 1.3rem;
    margin-left: -55px;
    margin-top: 1rem;
}

h2 {
    color: white;
    font-size: 2rem;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
    font-weight: bold;
}

p {
    margin-left: 1.5rem;
    margin-right: 1.5rem;
    max-width: 800px;
}

img.logo {
    max-width: 60%;
    height: auto;
    display: block;
    margin-left: -195px;
}

.btn-outline-primary {
    font-size: 1.1rem;
    padding: 0.6rem 1.5rem;
    border-radius: 30px;
    color: rgba(0, 130, 137, 1);
    border: 2px solid rgba(0, 130, 137, 1);
    transition: background-color 0.3s, color 0.3s;
    text-decoration: none;

}

.btn-outline-primary:hover {
    background-color: rgba(0, 130, 137, 1);
    color: black;
    font-weight: 600;
}

.btn-group-left {
    display: flex;
    justify-content: flex-start;
    gap: 1rem;
    margin-left: 0rem;
    margin-top: 1.5rem;
    flex-wrap: wrap;
}

.beheer-knop {
    margin-left: 1.5rem;
    margin-top: 2rem;
}

.card {
    background-color: #2a2a2aff;
    color: white;
    border: none;
}

.card-title {
    font-size: 0.9rem;
    font-weight: 600;
}

.card-body {
    padding: 0.5rem;
}

.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    object-fit: contain;
    height: 180px;
    width: 100%;
    background-color: #1a1a1a;
}

.text-muted {
    color: rgba(0, 130, 137, 1) !important;
}

.section-no-padding {
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    width: 100% !important;
}
</style>

<!-- Intro -->
<div class="container-fluid section-no-padding">
    <br><br><br>
    <h1 class="h1">Talent is everywhere</h1>
    <br>
    <img src="uploads/BFF/BuddyFilmFoundation-Black.jpeg" alt="Buddy Film Foundation Logo" class="logo">

    <div class="btn-group-left">
        <a href="foundation.php" class="btn btn-outline-primary">Foundation</a>
        <a href="production.php" class="btn btn-outline-primary">Production</a>
        <a href="casting.php" class="btn btn-outline-primary">Casting</a>
    </div>
    <br><br><br>
    <br><br>
    <hr style="border-color: white; margin: 2rem 1.5rem;">

    <div>
        <h2>Over dit platform</h2>
        <p>Hier kun je snel navigeren naar verschillende video categorieën, speciaal voor jouw interessegebieden.</p>
        <p>Meer functionaliteiten en updates volgen binnenkort!</p>
    </div>

    <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
    <div class="beheer-knop">
        <a href="admin/teambeheer.php" class="btn btn-outline-primary">Beheer Teamleden (Admin)</a>
    </div>
    <?php endif; ?>
</div>

<!-- Team Sectie -->
<section class="container-fluid px-0 my-5">
    <h2 class="mb-4">Ons Team</h2>
    <div class="row row-cols-1 row-cols-md-4 g-4 px-4">
        <?php
        $result = $conn->query("SELECT * FROM teamleden ORDER BY id ASC");
        while ($lid = $result->fetch_assoc()):
            $foto = !empty($lid['foto']) && file_exists('uploads/team/' . $lid['foto'])
                ? 'uploads/team/' . $lid['foto']
                : 'assets/img/default-team.png';
        ?>
        <div class="col">
            <div class="card h-100 shadow" style="max-width: 280px; margin: 0 auto;">
                <img src="<?= htmlspecialchars($foto) ?>" class="card-img-top"
                    alt="<?= htmlspecialchars($lid['naam']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($lid['naam']) ?></h5>
                    <h6 class="text-muted"><?= htmlspecialchars($lid['functie']) ?></h6>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
<br><br>
<!-- Support Us Section -->
<section class="container-fluid px-0 my-5" style="    border-top: 1px solid #333;">
    <div class="row">
        <div class="col-md-5">
            <br><br><br>
            <img src="uploads/BFF/73142347_2516680178556715_4378277983526322176_n.jpg" alt="Support Us"
                style="max-width: 100%; height: auto; max-height: 500px; object-fit: cover;">
        </div>
        <div class="col-md-7">
            <br><br><br><br>
            <h2 class="mb-4" style="font-size: 1.8rem;">Support Us</h2>
            <p style="font-size: 1rem; margin-bottom: 2rem;">
                Did our story inspire you and would you like to support our cause? You can do so with a donation via
                iDeal or a credit card.
                <br><br>
                We appreciate every contribution.
            </p>

            <button class="btn btn-outline-primary mb-4"
                style="font-size: 0.9rem; padding: 0.6rem 1.5rem; width: 200px;">Donate</button>

            <div class="payment-methods"
                style="display: flex; justify-content: flex-start; gap: 1rem; flex-wrap: wrap; margin-top: 2rem;">
                <img src="uploads/BFF/ideal.jpg" alt="iDeal" style="height: 25px; width: auto;">
                <img src="uploads/BFF/american-express.jpg" alt="American Express" style="height: 25px; width: auto;">
                <img src="uploads/BFF/visa.jpg" alt="Visa" style="height: 25px; width: auto;">
                <img src="uploads/BFF/mastercard.jpg" alt="Payment Tool" style="height: 25px; width: auto;">
                <img src="uploads/BFF/paypal.jpg" alt="PayPal" style="height: 25px; width: auto;">
            </div>
        </div>
    </div>
</section>
<br>
<!-- Contact Section -->
<section class="container-fluid px-0 my-5" style="border-top: 1px solid #333;">
    <div class=" row">
        <div class="col-md-6">
            <br><br>
            <h2 class="mb-4" style="font-size: 1.5rem;">CONTACT</h2>

            <div class="mb-4">
                <h5 style="color: rgba(0, 130, 137, 1); font-size: 1rem;">ADDRESS</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6 style="font-size: 0.9rem;">Rotterdam (BFF Head Office)</h6>
                        <p style="font-size: 0.8rem;">Weena 70, 10th floor</p>
                        <p style="font-size: 0.8rem;">3012 CM Rotterdam</p>
                    </div>
                    <div class="col-md-6">
                        <h6 style="font-size: 0.9rem;">Amsterdam (BFF Office)</h6>
                        <p style="font-size: 0.8rem;">A-Lab, Overhoeksplein 2,</p>
                        <p style="font-size: 0.8rem;">1031 KS Amsterdam</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h5 style="color: rgba(0, 130, 137, 1); font-size: 1rem;">PHONE</h5>
                <p style="font-size: 0.8rem;">+31 6 27459194</p>
                <p style="font-size: 0.8rem;">You can reach us on Mondays, Tuesdays and Thursdays from 10:00-18:00</p>
            </div>

            <div class="mb-4">
                <h5 style="color: rgba(0, 130, 137, 1); font-size: 1rem;">EMAIL</h5>
                <p style="font-size: 0.8rem;"><a href="mailto:info@buddyfilmfoundation.com"
                        style="color: white; text-decoration: none;">info@buddyfilmfoundation.com</a></p>
                <p style="font-size: 0.8rem;"><a href="mailto:casting@buddyfilmfoundation.com"
                        style="color: white; text-decoration: none;">casting@buddyfilmfoundation.com</a></p>
            </div>

            <div class="mb-4">
                <h5 style="color: rgba(0, 130, 137, 1); font-size: 1rem;">BILLING ADDRESS</h5>
                <div class="row">
                    <div class="col-md-6">
                        <h6 style="font-size: 0.9rem;">Foundation</h6>
                        <p style="font-size: 0.8rem;">Stichting Buddy Film Foundation</p>
                        <p style="font-size: 0.8rem;">Weena 70, 10th floor</p>
                        <p style="font-size: 0.8rem;">3012 CM Rotterdam</p>
                        <p style="font-size: 0.8rem;">KVK: 67827985</p>
                        <p style="font-size: 0.8rem;">BTW-nummer: NL857189177B01</p>
                        <p style="font-size: 0.8rem;"><a href="mailto:dewi@buddyfilmfoundation.com"
                                style="color: white; text-decoration: none;">dewi@buddyfilmfoundation.com</a></p>
                    </div>
                    <div class="col-md-6">
                        <h6 style="font-size: 0.9rem;">Productions</h6>
                        <p style="font-size: 0.8rem;">Buddy Film Productions BV</p>
                        <p style="font-size: 0.8rem;">Weena 70, 10th floor</p>
                        <p style="font-size: 0.8rem;">3012 CM Rotterdam</p>
                        <p style="font-size: 0.8rem;">KVK: 92133142</p>
                        <p style="font-size: 0.8rem;">BTW-nummer: NL865899022B01</p>
                        <p style="font-size: 0.8rem;"><a href="mailto:dewi@buddyfilmfoundation.com"
                                style="color: white; text-decoration: none;">dewi@buddyfilmfoundation.com</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <br><br>
            <h2 class="mb-4" style="font-size: 1.5rem;">Do you have a question?</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-size: 0.9rem;">Name</label>
                    <input type="text" class="form-control" id="name"
                        style="background-color: #2a2a2a; border: 1px solid #555; color: white; font-size: 0.8rem;">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" style="font-size: 0.9rem;">Email</label>
                    <input type="email" class="form-control" id="email"
                        style="background-color: #2a2a2a; border: 1px solid #555; color: white; font-size: 0.8rem;">
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label" style="font-size: 0.9rem;">Subject</label>
                    <input type="text" class="form-control" id="subject"
                        style="background-color: #2a2a2a; border: 1px solid #555; color: white; font-size: 0.8rem;">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label" style="font-size: 0.9rem;">Your message</label>
                    <textarea class="form-control" id="message" rows="5"
                        style="background-color: #2a2a2a; border: 1px solid #555; color: white; font-size: 0.8rem;"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary"
                    style="font-size: 0.9rem; width: 100%;">SUBMIT</button>
            </form>

            <div class="mt-4">
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
</section>

<?php include 'inc/footer.php'; ?>