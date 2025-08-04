<?php
// Zet sessie-instellingen vóór het starten van de sessie
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) ? 1 : 0); // Alleen secure cookie bij HTTPS

session_start();

include 'inc/connectie.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if (!$gebruikersnaam || !$wachtwoord) {
        $fout = "Vul gebruikersnaam en wachtwoord in.";
    } else {
        $stmt = $conn->prepare("SELECT wachtwoord, rol FROM gebruikers WHERE gebruikersnaam = ?");
        $stmt->bind_param("s", $gebruikersnaam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($wachtwoord, $row['wachtwoord'])) {
                // Regenereren van sessie-ID voor extra veiligheid
                session_regenerate_id(true);

                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['rol'] = $row['rol'];

                if ($row['rol'] === 'admin') {
                    header('Location: admin/dashboard.php');
                    exit;
                } elseif ($row['rol'] === 'filmmaker') {
                    header('Location: filmmaker/dashboard.php');
                    exit;
                } else {
                    $fout = "Onbekende gebruikersrol.";
                }
            } else {
                $fout = "Ongeldige gebruikersnaam of wachtwoord.";
            }
        } else {
            $fout = "Ongeldige gebruikersnaam of wachtwoord.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <title>Inloggen - MijnSite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<body>
    <?php include 'inc/header.php'; ?>

    <div class="container mt-4" style="max-width: 400px;">
        <h2>Inloggen</h2>

        <?php if ($fout): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="gebruikersnaam" class="form-label">Gebruikersnaam</label>
                <input type="text" name="gebruikersnaam" id="gebruikersnaam" class="form-control" required
                    value="<?= htmlspecialchars($_POST['gebruikersnaam'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="wachtwoord" class="form-label">Wachtwoord</label>
                <input type="password" name="wachtwoord" id="wachtwoord" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-dark">Inloggen</button>
        </form>
    </div>

    <?php include 'inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>