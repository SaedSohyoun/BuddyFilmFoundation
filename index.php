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
    color: rgba(0, 186, 196, 1);
    font-size: 1.5rem;
    margin-left: 1.5rem;
    margin-top: 1rem;
    position: relative;
    left: -75px;
    padding-bottom: 10px;
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
    margin-left: 1.5rem;
    max-width: 60%;
    height: auto;
    position: relative;
    left: -220px;
    padding-bottom: 10px;
}

.btn-outline-primary {
    font-size: 1.1rem;
    padding: 0.5rem 1.5rem;
    border-radius: 30px;
    color: rgba(0, 130, 137, 1);
    border: 2px solid rgba(0, 130, 137, 1);
    transition: background-color 0.3s, color 0.3s;
    text-decoration: none;
    position: relative;
    left: -70px;
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
    margin-left: 1.5rem;
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
    font-size: 1.25rem;
    font-weight: 600;
}

.card-body {
    padding: 1rem;
}

.card-img-top {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    object-fit: cover;
    height: 300px;
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
    <br>
    <h1 class="h1">Talent is everywhere</h1>
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
    <div class="row row-cols-1 row-cols-md-3 g-5 px-4">
        <?php
        $result = $conn->query("SELECT * FROM teamleden ORDER BY id ASC");
        while ($lid = $result->fetch_assoc()):
            $foto = !empty($lid['foto']) && file_exists('uploads/team/' . $lid['foto']) 
                ? 'uploads/team/' . $lid['foto'] 
                : 'assets/img/default-team.png';
        ?>
        <div class="col">
            <div class="card h-100 shadow">
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

<?php include 'inc/footer.php'; ?>