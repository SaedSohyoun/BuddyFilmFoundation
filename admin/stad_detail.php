<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

// Functie om HTML veilig weer te geven zonder null-problemen
function safeHtml($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Check of gebruiker admin is
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Check of stad is meegegeven
if (!isset($_GET['stad']) || empty($_GET['stad'])) {
    echo "<p class='text-danger text-center mt-4'>Geen stad opgegeven.</p>";
    include '../inc/footer.php';
    exit;
}

$stad = $_GET['stad'];

// Haal alle gebruikers in deze stad op (met werkervaring)
$stmt = $conn->prepare("
    SELECT id, naam, email, werkervaring, telefoon, profielfoto 
    FROM gebruikers 
    WHERE stad = ?
");
$stmt->bind_param("s", $stad);
$stmt->execute();
$result = $stmt->get_result();

// Basis map voor profielfoto's
$uploadsUrl = '../uploads/profielfotos/';
$uploadsDir = realpath(__DIR__ . '/../uploads/profielfotos/') . DIRECTORY_SEPARATOR;
?>

<style>
body {
    background-color: black;
    color: white;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    font-size: 1rem;
    line-height: 1.5;
}

/* Admin Container */
.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 3rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(0,130,137,0.08)" stroke-width="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.4;
}

.page-header-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.page-title {
    color: rgba(0, 130, 137, 1);
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
    text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
}

.page-subtitle {
    color: #ccc;
    font-size: 1.1rem;
    font-weight: 300;
}

/* Back Button */
.back-button {
    margin-bottom: 2rem;
}

.btn-back {
    background: linear-gradient(135deg, rgba(108, 117, 125, 1) 0%, rgba(73, 80, 87, 1) 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-back:hover {
    background: linear-gradient(135deg, rgba(73, 80, 87, 1) 0%, rgba(108, 117, 125, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    color: white;
    text-decoration: none;
}

/* Table Section */
.table-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2.5rem;
    margin-bottom: 3rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.section-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    padding-bottom: 0.5rem;
}

.table-container {
    overflow-x: auto;
    border-radius: 10px;
    border: 1px solid #555;
}

.table {
    background-color: #2a2a2a;
    color: white;
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
}

.table th {
    background-color: #333;
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
    border-bottom: 2px solid rgba(0, 130, 137, 0.3);
    font-size: 0.9rem;
    text-align: center;
}

.table td {
    padding: 1rem;
    border-bottom: 1px solid #555;
    vertical-align: middle;
    text-align: center;
}

.table tbody tr:hover {
    background-color: #333;
    transition: background-color 0.3s ease;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

/* Profile Image */
.profile-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    border: 2px solid rgba(0, 130, 137, 0.3);
}

.profile-image:hover {
    transform: scale(1.1);
    border-color: rgba(0, 130, 137, 1);
}

/* User Info */
.user-name {
    font-weight: 600;
    color: rgba(0, 130, 137, 1);
}

.user-email {
    color: #ccc;
    font-size: 0.9rem;
}

.user-phone {
    color: #ccc;
    font-size: 0.9rem;
}

.user-experience {
    color: #888;
    font-size: 0.85rem;
    max-width: 200px;
    word-wrap: break-word;
}

/* Empty State */
.empty-state {
    background-color: #2a2a2a;
    border-radius: 10px;
    padding: 3rem;
    text-align: center;
    border: 1px solid #555;
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-title {
    color: rgba(0, 130, 137, 1);
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.empty-message {
    color: #888;
    font-size: 1rem;
}

/* Stats Section */
.stats-section {
    background-color: #1a1a1a;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #333;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.stat-card {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border: 1px solid rgba(0, 130, 137, 0.3);
    border-radius: 10px;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.2);
}

.stat-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    opacity: 0.8;
}

.stat-number {
    color: rgba(0, 130, 137, 1);
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #ccc;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .admin-container {
        padding: 1rem;
    }
    
    .page-header {
        padding: 2rem 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .table-section {
        padding: 1.5rem;
    }
    
    .table-container {
        font-size: 0.9rem;
    }
    
    .table th,
    .table td {
        padding: 0.75rem 0.5rem;
    }
    
    .profile-image {
        width: 50px;
        height: 50px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1rem;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">📍 <?= safeHtml($stad) ?></h1>
            <p class="page-subtitle">Overzicht van alle personen in deze stad</p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="back-button">
        <a href="admin_statistieken.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Terug naar Statistieken
        </a>
    </div>

    <?php if ($result->num_rows > 0): ?>
    <!-- Stats Section -->
    <div class="stats-section">
        <h2 class="section-title">📊 Stad Statistieken</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-number"><?= $result->num_rows ?></div>
                <div class="stat-label">Totaal Personen</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🎬</div>
                <div class="stat-number"><?= $result->num_rows ?></div>
                <div class="stat-label">Filmmakers</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📸</div>
                <div class="stat-number"><?= $result->num_rows ?></div>
                <div class="stat-label">Met Profielfoto</div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <h2 class="section-title">👤 Personen Overzicht</h2>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Profielfoto</th>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Werkervaring</th>
                        <th>Telefoon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $fotoBestandRaw = $row['profielfoto'] ?? '';
                        $fotoURL = 'https://via.placeholder.com/60x60?text=Geen+Foto';

                        if (!empty($fotoBestandRaw) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $fotoBestandRaw)) {
                            $fotoPad = $uploadsDir . $fotoBestandRaw;
                            if (file_exists($fotoPad)) {
                                $fotoURL = $uploadsUrl . safeHtml($fotoBestandRaw);
                            } elseif (file_exists($uploadsDir . 'default.png')) {
                                $fotoURL = $uploadsUrl . 'default.png';
                            }
                        } elseif (file_exists($uploadsDir . 'default.png')) {
                            $fotoURL = $uploadsUrl . 'default.png';
                        }
                    ?>
                    <tr>
                        <td>
                            <img src="<?= $fotoURL ?>" 
                                alt="Foto van <?= safeHtml($row['naam']) ?>"
                                class="profile-image">
                        </td>
                        <td>
                            <div class="user-name"><?= safeHtml($row['naam']) ?></div>
                        </td>
                        <td>
                            <div class="user-email"><?= safeHtml($row['email']) ?></div>
                        </td>
                        <td>
                            <div class="user-experience"><?= safeHtml($row['werkervaring']) ?></div>
                        </td>
                        <td>
                            <div class="user-phone"><?= safeHtml($row['telefoon']) ?></div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php else: ?>
    <!-- Empty State -->
    <div class="empty-state">
        <div class="empty-icon">🏙️</div>
        <div class="empty-title">Geen Personen Gevonden</div>
        <div class="empty-message">
            Er zijn momenteel geen personen geregistreerd in <?= safeHtml($stad) ?>.
        </div>
    </div>
    <?php endif; ?>
</div>

<?php include '../inc/footer.php'; ?>