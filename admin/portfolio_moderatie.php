<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

// Alleen admin toegang
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$fout = $succes = "";

// Verwerk moderatie acties
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filmmaker_id = intval($_POST['filmmaker_id'] ?? 0);
    $actie = $_POST['actie'] ?? '';
    $opmerking = trim($_POST['opmerking'] ?? '');
    $admin_id = $_SESSION['gebruiker_id'] ?? 0;

    if ($filmmaker_id && in_array($actie, ['approved', 'rejected'])) {
        // Update portfolio status
        $stmt = $conn->prepare("UPDATE gebruikers SET 
            portfolio_status = ?, 
            portfolio_moderatie_datum = CURRENT_TIMESTAMP,
            portfolio_moderatie_opmerking = ?
            WHERE id = ? AND rol = 'filmmaker'");
        $stmt->bind_param("ssi", $actie, $opmerking, $filmmaker_id);
        
        if ($stmt->execute()) {
            // Log de moderatie actie
            $log_stmt = $conn->prepare("INSERT INTO portfolio_moderatie_log 
                (filmmaker_id, admin_id, actie, opmerking) VALUES (?, ?, ?, ?)");
            $log_stmt->bind_param("iiss", $filmmaker_id, $admin_id, $actie, $opmerking);
            $log_stmt->execute();
            $log_stmt->close();
            
            $status_text = ($actie === 'approved') ? 'goedgekeurd' : 'afgewezen';
            $succes = "Portfolio succesvol $status_text.";
        } else {
            $fout = "Fout bij het verwerken van de moderatie.";
        }
        $stmt->close();
    } else {
        $fout = "Ongeldige actie of filmmaker ID.";
    }
}

// Haal filmmakers op die moderatie nodig hebben
$query = "SELECT id, gebruikersnaam, naam, story, werkervaring, email, telefoon, stad, 
          portfolio_status, portfolio_laatste_wijziging, portfolio_moderatie_datum, portfolio_moderatie_opmerking
          FROM gebruikers 
          WHERE rol = 'filmmaker' 
          ORDER BY 
            CASE 
                WHEN portfolio_status = 'pending' THEN 1 
                WHEN portfolio_status = 'rejected' THEN 2 
                ELSE 3 
            END,
            portfolio_laatste_wijziging DESC";

$result = $conn->query($query);
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

.admin-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 2rem;
}

.page-header {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 2rem 0;
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

.alert {
    background-color: #2a2a2a;
    border: 1px solid #555;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    color: white;
}

.alert-danger {
    border-color: rgba(220, 53, 69, 0.5);
    background-color: rgba(220, 53, 69, 0.1);
    color: #ff6b6b;
}

.alert-success {
    border-color: rgba(40, 167, 69, 0.5);
    background-color: rgba(40, 167, 69, 0.1);
    color: #51cf66;
}

.portfolio-card {
    background-color: #1a1a1a;
    border: 1px solid #333;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.portfolio-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
}

.portfolio-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #333;
}

.filmmaker-info h3 {
    color: rgba(0, 130, 137, 1);
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
}

.filmmaker-info p {
    color: #ccc;
    margin: 0;
    font-size: 0.9rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: bold;
    text-transform: uppercase;
}

.status-pending {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.status-approved {
    background-color: rgba(40, 167, 69, 0.2);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.status-rejected {
    background-color: rgba(220, 53, 69, 0.2);
    color: #dc3545;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.portfolio-content {
    margin-bottom: 1.5rem;
}

.content-section {
    margin-bottom: 1rem;
}

.content-section h4 {
    color: rgba(0, 130, 137, 1);
    margin: 0 0 0.5rem 0;
    font-size: 1.1rem;
}

.content-section p {
    color: #ccc;
    margin: 0;
    line-height: 1.6;
    background-color: #2a2a2a;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid rgba(0, 130, 137, 0.3);
}

.moderatie-form {
    background-color: #2a2a2a;
    border-radius: 8px;
    padding: 1.5rem;
    border: 1px solid #555;
}

.form-group {
    margin-bottom: 1rem;
}

.form-label {
    display: block;
    color: white;
    font-weight: 600;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    background-color: #1a1a1a;
    border: 1px solid #555;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: #1a1a1a;
    border-color: rgba(0, 130, 137, 1);
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
    outline: none;
}

.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}

.btn-success {
    background: linear-gradient(135deg, rgba(40, 167, 69, 1) 0%, rgba(34, 139, 34, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, rgba(34, 139, 34, 1) 0%, rgba(40, 167, 69, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 1) 0%, rgba(183, 28, 28, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-danger:hover {
    background: linear-gradient(135deg, rgba(183, 28, 28, 1) 0%, rgba(220, 53, 69, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    color: white;
    text-decoration: none;
}

.btn-secondary {
    background: linear-gradient(135deg, rgba(108, 117, 125, 1) 0%, rgba(73, 80, 87, 1) 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, rgba(73, 80, 87, 1) 0%, rgba(108, 117, 125, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
    color: white;
    text-decoration: none;
}

.moderation-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.timestamp {
    color: #888;
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.no-portfolios {
    text-align: center;
    padding: 3rem;
    color: #ccc;
}

.no-portfolios i {
    font-size: 3rem;
    color: rgba(0, 130, 137, 0.5);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .admin-container {
        padding: 1rem;
    }
    
    .page-header {
        padding: 1.5rem 0;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .portfolio-card {
        padding: 1.5rem;
    }
    
    .portfolio-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .moderation-actions {
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">Portfolio Moderatie</h1>
            <p class="page-subtitle">Controleer en keur filmmaker portfolios goed</p>
        </div>
    </div>

    <?php if ($fout): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($fout) ?>
    </div>
    <?php endif; ?>

    <?php if ($succes): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?= htmlspecialchars($succes) ?>
    </div>
    <?php endif; ?>

    <?php if ($result->num_rows === 0): ?>
    <div class="no-portfolios">
        <i class="fas fa-check-circle"></i>
        <h3>Geen portfolios om te modereren</h3>
        <p>Alle filmmaker portfolios zijn al gemodereerd.</p>
    </div>
    <?php else: ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="portfolio-card">
            <div class="portfolio-header">
                <div class="filmmaker-info">
                    <h3><?= htmlspecialchars($row['naam']) ?></h3>
                    <p>@<?= htmlspecialchars($row['gebruikersnaam']) ?> • <?= htmlspecialchars($row['email'] ?? 'Geen email') ?></p>
                    <?php if ($row['stad']): ?>
                        <p>📍 <?= htmlspecialchars($row['stad']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="status-badge status-<?= $row['portfolio_status'] ?>">
                    <?= ucfirst($row['portfolio_status']) ?>
                </div>
            </div>

            <div class="portfolio-content">
                <?php if (!empty($row['story'])): ?>
                <div class="content-section">
                    <h4>📖 Verhaal</h4>
                    <p><?= nl2br(htmlspecialchars($row['story'])) ?></p>
                </div>
                <?php endif; ?>

                <?php if (!empty($row['werkervaring'])): ?>
                <div class="content-section">
                    <h4>🎬 Werkervaring</h4>
                    <p><?= nl2br(htmlspecialchars($row['werkervaring'])) ?></p>
                </div>
                <?php endif; ?>

                <?php if (!empty($row['telefoon'])): ?>
                <div class="content-section">
                    <h4>📞 Contact</h4>
                    <p>Telefoon: <?= htmlspecialchars($row['telefoon']) ?></p>
                </div>
                <?php endif; ?>

                <?php if ($row['portfolio_status'] === 'rejected' && !empty($row['portfolio_moderatie_opmerking'])): ?>
                <div class="content-section">
                    <h4>❌ Vorige afwijzing</h4>
                    <p style="border-left-color: #dc3545;"><?= nl2br(htmlspecialchars($row['portfolio_moderatie_opmerking'])) ?></p>
                    <div class="timestamp">
                        Afgewezen op: <?= date('d-m-Y H:i', strtotime($row['portfolio_moderatie_datum'])) ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($row['portfolio_status'] === 'pending'): ?>
                <div class="timestamp">
                    Ingediend op: <?= date('d-m-Y H:i', strtotime($row['portfolio_laatste_wijziging'])) ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($row['portfolio_status'] === 'pending'): ?>
            <div class="moderatie-form">
                <form method="post">
                    <input type="hidden" name="filmmaker_id" value="<?= $row['id'] ?>">
                    
                    <div class="form-group">
                        <label class="form-label">Opmerking (optioneel)</label>
                        <textarea name="opmerking" class="form-control" rows="3" 
                                  placeholder="Geef feedback aan de filmmaker..."></textarea>
                    </div>

                    <div class="moderation-actions">
                        <button type="submit" name="actie" value="approved" class="btn btn-success">
                            <i class="fas fa-check"></i> Goedkeuren
                        </button>
                        <button type="submit" name="actie" value="rejected" class="btn btn-danger">
                            <i class="fas fa-times"></i> Afwijzen
                        </button>
                    </div>
                </form>
            </div>
            <?php elseif ($row['portfolio_status'] === 'rejected'): ?>
            <div class="moderatie-form">
                <form method="post">
                    <input type="hidden" name="filmmaker_id" value="<?= $row['id'] ?>">
                    
                    <div class="form-group">
                        <label class="form-label">Nieuwe opmerking (optioneel)</label>
                        <textarea name="opmerking" class="form-control" rows="3" 
                                  placeholder="Geef nieuwe feedback..."></textarea>
                    </div>

                    <div class="moderation-actions">
                        <button type="submit" name="actie" value="approved" class="btn btn-success">
                            <i class="fas fa-check"></i> Nu goedkeuren
                        </button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php include '../inc/footer.php'; ?>

