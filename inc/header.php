<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>BuddyFilmFoundation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/style.css" />

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
                <a class="navbar-brand" href="/mijn-login/index.php">
                    <img src="/mijn-login/uploads/BFF/BuddyFilmFoundation-Black.jpeg" alt="MijnSite Logo"
                        style="height:30px; width:auto;   padding-right: 15px;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/filmmakers.php">Portfolios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/contact.php">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/admin/dashboard.php">Admin</a>
                        </li>
                        <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'filmmaker'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/filmmaker/dashboard.php">Mijn Portfolio</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['gebruikersnaam'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/logout.php">Uitloggen
                                (<?= htmlspecialchars($_SESSION['gebruikersnaam']) ?>)</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/mijn-login/login.php">Inloggen</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mt-4">
            <!-- ✅ Toegevoegd: main-content wrapper -->