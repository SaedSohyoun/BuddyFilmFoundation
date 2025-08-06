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

<?php include 'inc/header.php'; ?>

<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.login-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.login-card {
    background-color: #1a1a1a;
    border: 1px solid #333;
    border-radius: 15px;
    padding: 3rem;
    max-width: 450px;
    width: 100%;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
}

.login-header {
    text-align: center;
    margin-bottom: 2rem;
}

.login-header h1 {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.login-header p {
    color: #ccc;
    font-size: 1rem;
    margin: 0;
}

.form-control {
    background-color: #2a2a2a;
    border: 1px solid #555;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: #2a2a2a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
}

.form-label {
    color: white;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.btn-login {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.btn-login:hover {
    background-color: #00676d;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
}

.alert {
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    border: none;
}

.alert-danger {
    background-color: #7f1d1d;
    color: white;
    border-left: 4px solid #dc3545;
}

.alert-success {
    background-color: #14532d;
    color: white;
    border-left: 4px solid #28a745;
}

.form-floating {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-floating input {
    height: 3.5rem;
}

.form-floating label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    padding: 1rem 0.75rem;
    pointer-events: none;
    border: 1px solid transparent;
    transform-origin: 0 0;
    transition: opacity .1s ease-in-out, transform .1s ease-in-out;
    color: #ccc;
}

.form-floating input:focus ~ label,
.form-floating input:not(:placeholder-shown) ~ label {
    opacity: .65;
    transform: scale(.85) translateY(-0.5rem) translateX(0.15rem);
}

.back-link {
    text-align: center;
    margin-top: 2rem;
}

.back-link a {
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.back-link a:hover {
    color: white;
}

@media (max-width: 768px) {
    .login-card {
        padding: 2rem;
        margin: 1rem;
    }
    
    .login-header h1 {
        font-size: 2rem;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>

        <?php if ($fout): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?= htmlspecialchars($fout) ?>
        </div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-floating">
                <input type="text" name="gebruikersnaam" id="gebruikersnaam" class="form-control" 
                       placeholder="Username" required value="<?= htmlspecialchars($_POST['gebruikersnaam'] ?? '') ?>">
                <label for="gebruikersnaam">Username</label>
            </div>

            <div class="form-floating">
                <input type="password" name="wachtwoord" id="wachtwoord" class="form-control" 
                       placeholder="Password" required>
                <label for="wachtwoord">Password</label>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                Sign In
            </button>
        </form>

        <div class="back-link">
            <a href="index.php">
                <i class="fas fa-arrow-left me-1"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>