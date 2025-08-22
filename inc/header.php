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
    <style>
    @font-face {
        font-family: 'Prism';
        src: url('<?= $base_path ?>Prism-Regular.otf') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    /* Heading Styles */
    h1, h2, h3 {
        font-family: 'Prism', 'Montserrat', 'Segoe UI', sans-serif;
        font-weight: normal;
        font-style: normal;
    }

    h1 {
        font-size: 3rem;
        color: rgba(0, 130, 137, 1);
        text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    h2 {
        font-size: 2.5rem;
        color: rgba(0, 130, 137, 1);
        text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    h3 {
        font-size: 2rem;
        color: rgba(0, 130, 137, 1);
        text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Alternative Modern Header Styling */
    html,
    body {
        height: 100%;
        background-color: black;
        color: white;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', 'Segoe UI', sans-serif;
    }

    .page-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    /* Alternative Navbar Styling */
    .navbar {
        background: rgba(0, 0, 0, 0.9) !important;
        border-bottom: 2px solid transparent;
        background-image: linear-gradient(to right, rgba(0, 130, 137, 0.3), rgba(226, 0, 185, 0.3), rgba(0, 130, 137, 0.3)) !important;
        background-size: 200% 2px !important;
        background-repeat: no-repeat !important;
        background-position: 0 100% !important;
        animation: borderFlow 3s ease-in-out infinite;
        padding: 0.6rem 0;
        transition: all 0.4s ease;
    }

    @keyframes borderFlow {

        0%,
        100% {
            background-position: 0% 100%;
        }

        50% {
            background-position: 100% 100%;
        }
    }

    .navbar.scrolled {
        background: rgba(0, 0, 0, 0.95) !important;
        box-shadow: 0 0 30px rgba(0, 130, 137, 0.2);
    }

    .navbar-brand {
        font-weight: 800;
        font-size: 1.3rem;
        color: white !important;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        transition: all 0.4s ease;
        position: relative;
    }

    .navbar-brand::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, rgba(0, 130, 137, 1), rgba(226, 0, 185, 1));
        transition: width 0.4s ease;
    }

    .navbar-brand:hover::after {
        width: 100%;
    }

    .navbar-brand:hover {
        color: rgba(0, 130, 137, 1) !important;
        transform: scale(1.05);
    }

    /* Alternative Navigation Links */
    .nav-link {
        color: white !important;
        font-weight: 600;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 0.5rem 1rem !important;
        margin: 0 0.15rem;
        border-radius: 18px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        border: 2px solid transparent;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        transition: all 0.4s ease;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    .nav-link:hover::before {
        width: 200px;
        height: 200px;
    }

    .nav-link:hover {
        color: white !important;
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
    }

    /* Special colored links with new styling */
    .nav-link[style*="rgba(0, 130, 137, 1)"],
    .nav-link[style*="rgba(226, 0, 185, 1)"] {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        border: 2px solid currentColor;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .nav-link[style*="rgba(0, 130, 137, 1)"]:hover,
    .nav-link[style*="rgba(226, 0, 185, 1)"]:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        border-color: currentColor;
        box-shadow: 0 0 30px currentColor;
        transform: translateY(-3px) scale(1.05);
    }

    /* Alternative Navbar Toggler */
    .navbar-toggler {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 0.6rem;
        transition: all 0.4s ease;
        background: rgba(255, 255, 255, 0.05);
    }

    .navbar-toggler:hover {
        border-color: rgba(0, 130, 137, 1);
        background: rgba(0, 130, 137, 0.1);
        transform: rotate(90deg);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 0.3rem rgba(0, 130, 137, 0.2);
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
        padding: 0.5rem 1rem;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border-radius: 6px;
        margin: 0.1rem 0;
        font-weight: 500;
        font-size: 0.8rem;
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
        h1 {
            font-size: 2.5rem;
        }
        
        h2 {
            font-size: 2rem;
        }
        
        h3 {
            font-size: 1.5rem;
        }

        .dropdown-menu {
            background: rgba(26, 26, 26, 0.98);
            border-radius: 8px;
            margin-top: 0.5rem;
            min-width: 180px;
        }

        .dropdown-item {
            padding: 0.4rem 0.8rem;
            font-size: 0.75rem;
        }

        .dropdown-item:hover {
            transform: translateX(5px) scale(1.01);
        }
    }

    /* Responsive Header */
    @media (max-width: 991px) {
        h1 {
            font-size: 2.8rem;
        }
        
        h2 {
            font-size: 2.3rem;
        }
        
        h3 {
            font-size: 1.8rem;
        }

        .navbar {
            padding: 0.5rem 0;
        }

        .navbar-collapse {
            background: rgba(0, 0, 0, 0.98);
            border-radius: 18px;
            margin-top: 0.8rem;
            padding: 1rem;
            border: 2px solid rgba(0, 130, 137, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .nav-link {
            padding: 0.6rem 0.8rem !important;
            margin: 0.15rem 0;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.6rem;
        }

        .nav-link:hover {
            transform: translateX(8px);
            border-color: rgba(0, 130, 137, 0.5);
        }

        .navbar-brand {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 2.5rem;
        }
        
        h2 {
            font-size: 2rem;
        }
        
        h3 {
            font-size: 1.5rem;
        }

        .navbar-brand {
            font-size: 0.9rem;
            letter-spacing: 0.6px;
        }

        .nav-link {
            font-size: 0.55rem;
            padding: 0.5rem 0.7rem !important;
            letter-spacing: 0.2px;
        }

        .navbar {
            padding: 0.3rem 0;
        }

        .navbar-collapse {
            padding: 0.6rem;
            border-radius: 10px;
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
                                <li><a class="dropdown-item" href="<?= $base_path ?>buddy_career_boost.php">Buddy Career Boost</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>welkom_the_film.php">Welkom-the film</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>project3.php">Trojaanse Wijven</a>
                                </li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>stories_that_matter.php">Stories That
                                        Matter</a></li>
                                <li><a class="dropdown-item" href="<?= $base_path ?>talent_is_everywhere.php">Talent is
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

                <script>
                // Modern Header Scroll Effects
                document.addEventListener('DOMContentLoaded', function() {
                    const navbar = document.querySelector('.navbar');

                    // Scroll effect
                    window.addEventListener('scroll', function() {
                        if (window.scrollY > 50) {
                            navbar.classList.add('scrolled');
                        } else {
                            navbar.classList.remove('scrolled');
                        }
                    });

                    // Smooth scroll for anchor links
                    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                        anchor.addEventListener('click', function(e) {
                            e.preventDefault();
                            const target = document.querySelector(this.getAttribute('href'));
                            if (target) {
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });

                    // Mobile menu improvements
                    const navbarToggler = document.querySelector('.navbar-toggler');
                    const navbarCollapse = document.querySelector('.navbar-collapse');

                    if (navbarToggler && navbarCollapse) {
                        // Close mobile menu when clicking outside
                        document.addEventListener('click', function(e) {
                            if (!navbarToggler.contains(e.target) && !navbarCollapse.contains(e
                                    .target)) {
                                if (navbarCollapse.classList.contains('show')) {
                                    navbarToggler.click();
                                }
                            }
                        });

                        // Close mobile menu when clicking on a link
                        navbarCollapse.querySelectorAll('.nav-link').forEach(link => {
                            link.addEventListener('click', function() {
                                if (navbarCollapse.classList.contains('show')) {
                                    navbarToggler.click();
                                }
                            });
                        });
                    }
                });
                </script>