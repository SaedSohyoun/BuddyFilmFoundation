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

    /* Modern Dropdown Styling */
    .dropdown-menu {
        background: linear-gradient(145deg, rgba(26, 26, 26, 0.95) 0%, rgba(40, 40, 40, 0.95) 100%);
        border: 1px solid rgba(226, 0, 185, 0.3);
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(20px);
        margin-top: 0.8rem;
        padding: 0.5rem;
        min-width: 200px;
        animation: dropdownFadeIn 0.3s ease-out;
        transform-origin: top center;
    }

    @keyframes dropdownFadeIn {
        0% {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }

        100% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .dropdown-item {
        color: white;
        padding: 0.8rem 1.2rem;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-radius: 8px;
        margin: 0.2rem 0;
        font-weight: 500;
        font-size: 0.9rem;
        position: relative;
        overflow: hidden;
        border: 1px solid transparent;
    }

    .dropdown-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(226, 0, 185, 0.1), transparent);
        transition: left 0.5s ease;
    }

    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(226, 0, 185, 0.15) 0%, rgba(226, 0, 185, 0.05) 100%);
        color: rgba(226, 0, 185, 1);
        transform: translateX(8px) scale(1.02);
        border-color: rgba(226, 0, 185, 0.3);
        box-shadow: 0 5px 15px rgba(226, 0, 185, 0.2);
    }

    .dropdown-item:hover::before {
        left: 100%;
    }

    .dropdown-toggle::after {
        border-top-color: rgba(226, 0, 185, 1);
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover::after {
        border-top-color: white;
        transform: rotate(180deg);
    }

    /* Hover effect voor dropdown trigger */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    /* Dropdown arrow styling */
    .dropdown-toggle {
        position: relative;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        text-shadow: 0 0 10px rgba(226, 0, 185, 0.5);
    }

    /* Responsive dropdown */
    @media (max-width: 768px) {
        .dropdown-menu {
            background: rgba(26, 26, 26, 0.98);
            border-radius: 8px;
            margin-top: 0.5rem;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.7rem 1rem;
            font-size: 0.85rem;
        }

        .dropdown-item:hover {
            transform: translateX(5px) scale(1.01);
        }
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
                                style="color: rgba(0, 130, 137, 1) !important;">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>filmmakers.php"
                                style="color: rgba(0, 130, 137, 1) !important;">PORTFOLIOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>foundation.php">FOUNDATION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>casting.php">CASTING</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>production.php">PRODUCTION</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" style="color: rgba(226, 0, 185, 1) !important;">
                                PROJECTS
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= $base_path ?>project1.php">Buddy Career Boost</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>project2.php">Welkom-the film</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>project3.php">Trojaanse Wijven</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>project4.php">Stories That
                                        Matter</a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>project5.php">Talent is
                                        Everywhere</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>in_development.php">IN DEVELOPMENT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>find_professional.php">FIND A PROFESSIONAL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>donate.php"
                                style="color: rgba(0, 130, 137, 1) !important;">DONATE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>contact.php">CONTACT</a>
                        </li>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= $is_admin ? $dashboard_path : 'admin/dashboard.php' ?>">ADMIN</a>
                        </li>
                        <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'filmmaker'): ?>
                        <li class="nav-item">
                            <a class="nav-link"
                                href="<?= $is_filmmaker ? $dashboard_path : 'filmmaker/dashboard.php' ?>">MIJN
                                PORTFOLIO</a>
                        </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['gebruikersnaam'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>logout.php">UITLOGGEN
                                (<?= htmlspecialchars($_SESSION['gebruikersnaam']) ?>)</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_path ?>login.php">LOGIN</a>
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