<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$fout = '';
$succes = '';

function genereerEmbedCode($url) {
    $url = trim($url);

    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        $videoId = $matches[1];
        return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . htmlspecialchars($videoId) . '" frameborder="0" allowfullscreen></iframe>';
    }

    if (preg_match('/vimeo\.com\/(\d+)/', $url, $matches)) {
        $videoId = $matches[1];
        return '<iframe src="https://player.vimeo.com/video/' . htmlspecialchars($videoId) . '" width="640" height="360" frameborder="0" allowfullscreen></iframe>';
    }

    if (preg_match('/npo\.nl|npostart\.nl/', $url)) {
        return 'NPO_LINK:' . htmlspecialchars($url);
    }

    return false;
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <title>Video Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <style>
    body {
        background-color: black;
        color: white;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
        padding: 2rem 1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    h1 {
        color: #008289;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        background-color: #2c2c2c;
        color: white;
        border: 1px solid #555;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #008289;
        box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
    }

    .btn-primary {
        background-color: #008289;
        border: none;
        font-weight: bold;
        color: black;
    }

    .btn-primary:hover {
        background-color: #006e74;
    }

    .btn-secondary {
        background-color: #444;
        border: none;
        color: white;
    }

    .alert-danger {
        background-color: #7f1d1d;
        color: white;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #14532d;
        color: white;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-radius: 5px;
    }

    footer {
        background-color: #000;
        color: white;
    }
    </style>
</head>

<body>

    <?php
// Verwerk formulier hier na header (zodat head apart blijft)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titel = trim($_POST['titel'] ?? '');
    $beschrijving = trim($_POST['beschrijving'] ?? '');
    $videolink = trim($_POST['videolink'] ?? '');
    $tag = trim($_POST['tag'] ?? '');

    if (empty($titel) || empty($beschrijving) || empty($videolink) || empty($tag)) {
        $fout = "Vul alle velden in.";
    } else {
        $embed_code = genereerEmbedCode($videolink);
        if (!$embed_code) {
            $fout = "Ongeldige link. Alleen YouTube, Vimeo of NPO wordt ondersteund.";
        } else {
            $tag = preg_replace('/[^a-zA-Z0-9 ]/', '', $tag);
            $kolom = 'tags'; // of pas aan als je kolom anders heet

            $stmt = $conn->prepare("INSERT INTO videos (titel, beschrijving, embed_code, $kolom) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('ssss', $titel, $beschrijving, $embed_code, $tag);

            if ($stmt->execute()) {
                header("Location: ../" . strtolower($tag) . ".php");
                exit;
            } else {
                $fout = "Fout bij toevoegen: " . $conn->error;
            }
            $stmt->close();
        }
    }
}
?>

    <main>
        <h1>🎬 Video Toevoegen</h1>

        <?php if ($fout): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($fout) ?></div>
        <?php endif; ?>

        <?php if ($succes): ?>
        <div class="alert alert-success"><?= htmlspecialchars($succes) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="titel">Titel</label>
                <input type="text" name="titel" id="titel" class="form-control" required
                    value="<?= htmlspecialchars($_POST['titel'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="beschrijving">Beschrijving</label>
                <textarea name="beschrijving" id="beschrijving" class="form-control" rows="4"
                    required><?= htmlspecialchars($_POST['beschrijving'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="videolink">Video Link (YouTube, Vimeo, NPO)</label>
                <input type="url" name="videolink" id="videolink" class="form-control" placeholder="https://..."
                    required value="<?= htmlspecialchars($_POST['videolink'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label for="tag" class="form-label">Tag (selecteer één)</label>
                <select name="tag" id="tag" class="form-select" required>
                    <option value="">-- Kies een tag --</option>
                    <?php
                $tags_opties = ['Casting', 'Production', 'Foundation'];
                $geselecteerd = $_POST['tag'] ?? '';
                foreach ($tags_opties as $optie) {
                    $selected = ($geselecteerd === $optie) ? 'selected' : '';
                    echo "<option value=\"$optie\" $selected>$optie</option>";
                }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>

        <p><a href="dashboard.php" class="btn btn-secondary mt-3">Terug naar dashboard</a></p>
    </main>

    <?php include '../inc/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>