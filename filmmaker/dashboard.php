<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

// Alleen filmmaker toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'filmmaker') {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['gebruikersnaam'];
$uploadPad = "../uploads/profielfotos/";
if (!is_dir($uploadPad)) {
    mkdir($uploadPad, 0777, true);
}

$fout = $succes = "";

function esc($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// Foto uploaden
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_foto'])) {
    if (isset($_FILES['profielfoto']) && $_FILES['profielfoto']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['profielfoto']['name'], PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $allowed_ext)) {
            $fout = "Ongeldig bestandstype.";
        } else {
            $bestandsnaam = uniqid('foto_') . "." . $ext;
            $pad = $uploadPad . $bestandsnaam;

            if (move_uploaded_file($_FILES['profielfoto']['tmp_name'], $pad)) {
                $stmtOld = $conn->prepare("SELECT profielfoto FROM gebruikers WHERE gebruikersnaam = ?");
                $stmtOld->bind_param("s", $user);
                $stmtOld->execute();
                $stmtOld->bind_result($oudeFoto);
                $stmtOld->fetch();
                $stmtOld->close();

                if ($oudeFoto && file_exists($uploadPad . $oudeFoto)) {
                    @unlink($uploadPad . $oudeFoto);
                }

                $stmt = $conn->prepare("UPDATE gebruikers SET profielfoto = ? WHERE gebruikersnaam = ?");
                $stmt->bind_param("ss", $bestandsnaam, $user);
                if ($stmt->execute()) {
                    $succes = "Profielfoto geüpload.";
                    $profielfoto = $bestandsnaam;
                } else {
                    $fout = "Databasefout.";
                }
                $stmt->close();
            } else {
                $fout = "Upload mislukt.";
            }
        }
    } else {
        $fout = "Geen geldig bestand geüpload.";
    }
}

// Profielgegevens ophalen
$stmtProfile = $conn->prepare("SELECT naam, story, werkervaring, profielfoto, email, telefoon, stad FROM gebruikers WHERE gebruikersnaam = ?");
$stmtProfile->bind_param("s", $user);
$stmtProfile->execute();
$profileResult = $stmtProfile->get_result();
$profile = $profileResult->fetch_assoc();
$stmtProfile->close();

if (!isset($profielfoto)) {
    $profielfoto = $profile['profielfoto'] ?? '';
}

// Contactgegevens bijwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_contact'])) {
    $email = trim($_POST['email'] ?? '');
    $telefoon = trim($_POST['telefoon'] ?? '');

    $stmt = $conn->prepare("UPDATE gebruikers SET email = ?, telefoon = ? WHERE gebruikersnaam = ?");
    $stmt->bind_param("sss", $email, $telefoon, $user);
    if ($stmt->execute()) {
        $succes = "Contactgegevens opgeslagen.";
    } else {
        $fout = "Fout bij opslaan.";
    }
    $stmt->close();
}

// Profiel bijwerken
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profiel'])) {
    $story = trim($_POST['story'] ?? '');
    $werkervaring = trim($_POST['werkervaring'] ?? '');
    $stad = trim($_POST['stad'] ?? '');

    $stmt = $conn->prepare("UPDATE gebruikers SET story = ?, werkervaring = ?, stad = ? WHERE gebruikersnaam = ?");
    $stmt->bind_param("ssss", $story, $werkervaring, $stad, $user);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        $fout = "Fout bij bijwerken profiel.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #000;
        color: #000;
    }

    h1,
    h2 {
        color: rgb(0, 130, 137, 1);
    }

    .form-label {
        color: rgb(0, 120, 100, 1);
        font-weight: bold;
    }

    .form-control,
    textarea {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #444;
    }

    .form-control::placeholder,
    textarea::placeholder {
        color: #aaa;
    }

    .btn-primary {
        background-color: #007f66;
        border: none;
    }

    .btn-primary:hover {
        background-color: #006553;
    }

    .btn-secondary {
        background-color: #555;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #444;
    }

    .alert {
        margin-top: 15px;
    }

    img {
        border-radius: 50%;
    }
    </style>
</head>

<body>
    <div class="container my-4">
        <h1>Welkom, <?= esc($profile['naam'] ?? $user) ?></h1>

        <?php if ($fout): ?>
        <div class="alert alert-danger"><?= esc($fout) ?></div>
        <?php endif; ?>
        <?php if ($succes): ?>
        <div class="alert alert-success"><?= esc($succes) ?></div>
        <?php endif; ?>

        <!-- Profielfoto -->
        <div class="mb-4">
            <h2>Profielfoto</h2>
            <?php if (!empty($profielfoto) && file_exists($uploadPad . $profielfoto)): ?>
            <img src="../uploads/profielfotos/<?= esc($profielfoto) ?>?v=<?= filemtime($uploadPad . $profielfoto) ?>"
                alt="Profielfoto" style="width: 150px; height: 150px; object-fit: cover;">
            <?php else: ?>
            <p><em>Geen profielfoto beschikbaar.</em></p>
            <?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="upload_foto" value="1">
                <div class="mb-3">
                    <label for="profielfoto" class="form-label">Nieuwe profielfoto</label>
                    <input type="file" name="profielfoto" id="profielfoto" class="form-control" accept="image/*"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Uploaden</button>
            </form>
        </div>

        <!-- Contactgegevens -->
        <div class="mb-4">
            <h2>Contactgegevens</h2>
            <form method="post">
                <input type="hidden" name="update_contact" value="1">
                <div class="mb-3">
                    <label for="email" class="form-label">E-mailadres</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="<?= esc($profile['email'] ?? '') ?>" placeholder="voorbeeld@mail.com">
                </div>
                <div class="mb-3">
                    <label for="telefoon" class="form-label">Telefoonnummer</label>
                    <input type="text" name="telefoon" id="telefoon" class="form-control"
                        value="<?= esc($profile['telefoon'] ?? '') ?>" placeholder="06-12345678">
                </div>
                <button type="submit" class="btn btn-secondary">Opslaan</button>
            </form>
        </div>

        <!-- Story en Werkervaring -->
        <div class="mb-4">
            <h2>Story & Werkervaring</h2>
            <form method="post">
                <input type="hidden" name="update_profiel" value="1">
                <div class="mb-3">
                    <label for="story" class="form-label">Story</label>
                    <textarea id="story" name="story" class="form-control"
                        rows="5"><?= esc($profile['story'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="werkervaring" class="form-label">Werkervaring</label>
                    <textarea id="werkervaring" name="werkervaring" class="form-control"
                        rows="5"><?= esc($profile['werkervaring'] ?? '') ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="stad" class="form-label">Stad</label>
                    <input type="text" name="stad" id="stad" class="form-control"
                        value="<?= esc($profile['stad'] ?? '') ?>" placeholder="Woonplaats">
                </div>
                <button type="submit" class="btn btn-primary">Profiel Bijwerken</button>
            </form>
        </div>
    </div>

    <?php include '../inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>