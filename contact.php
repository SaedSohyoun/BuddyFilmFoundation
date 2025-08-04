<?php
include 'inc/header.php';

$fout = $succes = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $bericht = trim($_POST['bericht'] ?? '');

    if (!$naam || !$email || !$bericht) {
        $fout = "Vul alle velden in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fout = "Ongeldig e-mailadres.";
    } else {
        $to = "jouw-email@example.com";
        $subject = "Nieuw bericht via contactformulier";
        $body = "Je hebt een nieuw bericht ontvangen via het contactformulier op jouwsite.nl\n\n"
              . "Naam: $naam\n"
              . "Email: $email\n\n"
              . "Bericht:\n$bericht\n";

        $headers = "From: no-reply@jouwsite.nl\r\n";
        $headers .= "Reply-To: " . filter_var($email, FILTER_SANITIZE_EMAIL) . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $succes = "Bericht verzonden!";
        } else {
            $fout = "Fout bij verzenden, probeer later.";
        }
    }
}
?>

<!-- STYLING -->
<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

h1 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
}

.form-control,
.form-control:focus {
    background-color: #1c1c1c;
    color: white;
    border: 1px solid #555;
}

label {
    font-weight: bold;
}

.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #00676d;
}

.alert {
    padding: 1rem;
    border-radius: 5px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background-color: #7f1d1d;
    color: white;
}

.alert-success {
    background-color: #14532d;
    color: white;
}

.container {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    max-width: 600px;
    margin: auto;
    margin-top: 3rem;
    margin-bottom: 4rem;
}
</style>

<!-- CONTENT -->
<div class="container">
    <h1>Contact</h1>

    <?php if ($fout): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
    <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label for="naam">Naam</label>
            <input name="naam" type="text" class="form-control" required
                value="<?= htmlspecialchars($_POST['naam'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control" required
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label for="bericht">Bericht</label>
            <textarea name="bericht" class="form-control" rows="5"
                required><?= htmlspecialchars($_POST['bericht'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Verstuur</button>
    </form>
</div>

<?php include 'inc/footer.php'; ?>