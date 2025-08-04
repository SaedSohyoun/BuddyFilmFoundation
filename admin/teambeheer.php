<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Verwijderen
if (isset($_GET['verwijder'])) {
    $id = intval($_GET['verwijder']);
    $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
    if ($res && $row = $res->fetch_assoc()) {
        $bestandsnaam = $row['foto'];
        if ($bestandsnaam && file_exists('../uploads/team/' . $bestandsnaam)) {
            unlink('../uploads/team/' . $bestandsnaam);
        }
    }
    $conn->query("DELETE FROM teamleden WHERE id = $id");
    header("Location: teambeheer.php");
    exit;
}

// Toevoegen of bewerken
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'];
    $functie = $_POST['functie'];
    $id = !empty($_POST['id']) ? intval($_POST['id']) : null;

    $fotoNaam = null;

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmpNaam = $_FILES['foto']['tmp_name'];
        $origineleNaam = basename($_FILES['foto']['name']);
        $ext = strtolower(pathinfo($origineleNaam, PATHINFO_EXTENSION));
        $toegestaneExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($ext, $toegestaneExt)) {
            $fotoNaam = uniqid('team_', true) . '.' . $ext;
            move_uploaded_file($tmpNaam, '../uploads/team/' . $fotoNaam);

            if ($id) {
                $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
                if ($res && $row = $res->fetch_assoc()) {
                    $oudeFoto = $row['foto'];
                    if ($oudeFoto && file_exists('../uploads/team/' . $oudeFoto)) {
                        unlink('../uploads/team/' . $oudeFoto);
                    }
                }
            }
        } else {
            echo "<div class='alert alert-danger'>Ongeldig bestandsformaat. Alleen jpg, jpeg, png, gif toegestaan.</div>";
        }
    } elseif ($id) {
        $res = $conn->query("SELECT foto FROM teamleden WHERE id = $id");
        if ($res && $row = $res->fetch_assoc()) {
            $fotoNaam = $row['foto'];
        }
    } else {
        echo "<div class='alert alert-danger'>Je moet een foto uploaden.</div>";
    }

    if ($fotoNaam) {
        if ($id) {
            $stmt = $conn->prepare("UPDATE teamleden SET naam=?, functie=?, foto=? WHERE id=?");
            $stmt->bind_param("sssi", $naam, $functie, $fotoNaam, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO teamleden (naam, functie, foto) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $naam, $functie, $fotoNaam);
        }
        $stmt->execute();
        header("Location: teambeheer.php");
        exit;
    }
}

$bewerk = null;
if (isset($_GET['bewerk'])) {
    $id = intval($_GET['bewerk']);
    $res = $conn->query("SELECT * FROM teamleden WHERE id = $id");
    $bewerk = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Teambeheer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <style>
    body {
        background-color: black;
        color: white;
    }

    h2,
    h4 {
        color: rgb(0, 130, 137, 1);
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #ff0000ff;
    }

    .form-control,
    .form-select {
        background-color: #1e1e1e;
        color: white;
        border: 1px solid #444;
    }

    .form-control::placeholder {
        color: #fff;
    }

    input[type="file"] {
        background-color: #383838ff;
        color: white;
        border: 1px solid #444;
        padding: 6px;
    }

    input[type="file"]::file-selector-button {
        background-color: rgb(0, 130, 137, 1);
        color: white;
        border: none;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: rgb(0, 130, 137, 1);
    }

    .table {
        background-color: #383838ff;

    }

    .table thead {
        background-color: #383838ff;

        color: #00b4b4;
    }

    .btn-success {
        background-color: rgb(0, 130, 137, 1);
        border: none;
    }

    .btn-success:hover {
        background-color: rgb(0, 100, 137, 1);
    }

    .btn-secondary {
        background-color: #555;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #444;
    }

    .btn-warning {
        background-color: #d97706;
        border: none;
    }

    .btn-warning:hover {
        background-color: #b45309;
    }

    .btn-danger {
        background-color: #b91c1c;
        border: none;
    }

    .btn-danger:hover {
        background-color: #991b1b;
    }

    img {
        border-radius: 6px;
    }

    .table-bordered th,
    .table-bordered td {
        border-color: #444;
    }

    footer {
        background-color: black;
        color: white;
    }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Teamleden Beheren</h2>

        <form method="post" enctype="multipart/form-data" class="mb-5">
            <input type="hidden" name="id" value="<?= $bewerk['id'] ?? '' ?>">

            <div class="mb-4">
                <input type="text" name="naam" class="form-control" placeholder="Naam" required
                    value="<?= htmlspecialchars($bewerk['naam'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <input type="text" name="functie" class="form-control" placeholder="Functie" required
                    value="<?= htmlspecialchars($bewerk['functie'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label>Foto <?= !$bewerk ? '(verplicht)' : '(laat leeg om huidige te behouden)' ?></label>
                <input type="file" name="foto" accept="image/*" class="form-control" <?= $bewerk ? '' : 'required' ?>>
            </div>

            <?php if ($bewerk && $bewerk['foto'] && file_exists('../uploads/team/' . $bewerk['foto'])): ?>
            <div class="mb-3">
                <img src="../uploads/team/<?= htmlspecialchars($bewerk['foto']) ?>" alt="Huidige foto"
                    style="height:100px;">
            </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-success"><?= $bewerk ? 'Bijwerken' : 'Toevoegen' ?></button>
            <?php if ($bewerk): ?>
            <a href="teambeheer.php" class="btn btn-secondary">Annuleren</a>
            <?php endif; ?>
        </form>

        <h4>Bestaande teamleden</h4>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Naam</th>
                    <th>Functie</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM teamleden ORDER BY id ASC");
                while ($lid = $res->fetch_assoc()):
                ?>
                <tr>
                    <td>
                        <?php if ($lid['foto'] && file_exists('../uploads/team/' . $lid['foto'])): ?>
                        <img src="../uploads/team/<?= htmlspecialchars($lid['foto']) ?>" width="80"
                            alt="<?= htmlspecialchars($lid['naam']) ?>">
                        <?php else: ?>
                        <img src="../assets/img/default-team.png" width="80" alt="Geen foto">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($lid['naam']) ?></td>
                    <td><?= htmlspecialchars($lid['functie']) ?></td>
                    <td>
                        <a href="?bewerk=<?= $lid['id'] ?>" class="btn btn-warning btn-sm">Bewerk</a>
                        <a href="?verwijder=<?= $lid['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Weet je het zeker?');">Verwijder</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include '../inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>