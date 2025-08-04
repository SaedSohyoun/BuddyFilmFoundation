<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// Verwijder video
if (isset($_GET['verwijder'])) {
    $id = intval($_GET['verwijder']);
    $stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header('Location: video_overzicht.php');
    exit;
}

// Haal alle video's op
$result = $conn->query("SELECT v.id, v.titel, v.toegevoegd_door, v.embed_code FROM videos v ORDER BY v.id DESC");
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Video Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <style>
    body {
        background-color: black;
        color: white;
        font-family: 'Segoe UI', sans-serif;
    }

    h1 {
        color: #008289;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .table {
        background-color: #1e1e1e;
        color: white;
        border: 1px solid #555;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table thead th {
        background-color: #2a2a2a;
        color: #00b4b4;
    }

    .btn-danger {
        background-color: #b91c1c;
        border: none;
    }

    .btn-danger:hover {
        background-color: #991b1b;
    }

    .btn-secondary {
        background-color: #444;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #333;
    }

    a.btn {
        color: white;
        font-weight: bold;
    }

    .container {
        max-width: 95%;
        margin: 0 auto;
        padding: 2rem;
    }

    footer {
        background-color: black;
        color: white;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Overzicht van alle video's</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titel</th>
                        <th>Filmmaker</th>
                        <th>Video</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($video = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $video['id'] ?></td>
                        <td><?= htmlspecialchars($video['titel']) ?></td>
                        <td><?= htmlspecialchars($video['toegevoegd_door']) ?></td>
                        <td><?= $video['embed_code'] ?></td>
                        <td>
                            <a href="video_overzicht.php?verwijder=<?= $video['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je zeker dat je deze video wilt verwijderen?')">
                                Verwijderen
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <p><a href="dashboard.php" class="btn btn-secondary mt-3">Terug naar dashboard</a></p>
    </div>

    <?php include '../inc/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>