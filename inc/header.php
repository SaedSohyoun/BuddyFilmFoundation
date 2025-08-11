<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Bepaal de huidige directory en pas de paden aan
$current_dir = dirname($_SERVER['SCRIPT_NAME']);
$is_admin = strpos($current_dir, '/admin') !== false;
$is_filmmaker = strpos($current_dir, '/filmmaker') !== false;

// Bepaal de juiste paden
if ($is_admin || $is_filmmaker) {
    $base_path = '../';
    $dashboard_path = 'dashboard.php';
} else {
    $base_path = '';
    $dashboard_path = '';
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>BuddyFilmFoundation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Extra styling voor zwarte achtergrond + witte tekst + sticky layout -->
    <style>
    html,
    body {
        height: 100%;
        background-color: black;
        color: white;
        margin: 0;
        padding: 0;
    }

    .page-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    a.nav-link,
    a.navbar-brand {
        color: white;
    }

    a.nav-link:hover,
    a.navbar-brand:hover {
        color: rgba(0, 130, 137, 1)
    }

    .nav-link[href*="index.php"]:hover,
    .nav-link[href*="filmmakers.php"]:hover,
    .nav-link[href="#"]:hover {
        color: white !important;
        transition: color 0.3s ease;
    }

    .navbar.bg-dark {
        background-color: #000 !important;
    }
    </style>
</head>

<body>
    <div class="page-container">
        <!-- ✅ Toegevoegd: voor sticky layout -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>index.php"
                                style="color: rgba(0, 130, 137, 1) !important;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>filmmakers.php"
                                style="color: rgba(0, 130, 137, 1) !important;">Portfolios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>foundation.php">Foundation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>casting.php">Casting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>production.php">Production</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>donate.php"
                                style="color: rgba(0, 130, 137, 1) !important;">Donate</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>contact.php">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= $is_admin ? $dashboard_path : 'admin/dashboard.php' ?>">Admin</a>
                        </li>
                        <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'filmmaker'): ?>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= $is_filmmaker ? $dashboard_path : 'filmmaker/dashboard.php' ?>">Mijn
                                Portfolio</a>
                        </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['gebruikersnaam'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>logout.php">Uitloggen
                                (<?= htmlspecialchars($_SESSION['gebruikersnaam']) ?>)</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>login.php">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mt-4">
            <!-- ✅ Toegevoegd: main-content wrapper -->
            <main class="container mt-4">
                <!-- ✅ Toegevoegd: main-content wrapper -->