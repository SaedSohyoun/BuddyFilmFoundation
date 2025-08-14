<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Verwijder bericht
if (isset($_GET['verwijder']) && is_numeric($_GET['verwijder'])) {
    $id = intval($_GET['verwijder']);
    $conn->query("DELETE FROM contact_berichten WHERE id = $id");
    header("Location: contact_berichten.php");
    exit;
}

// Markeer als gelezen
if (isset($_GET['markeer_gelezen']) && is_numeric($_GET['markeer_gelezen'])) {
    $id = intval($_GET['markeer_gelezen']);
    $conn->query("UPDATE contact_berichten SET gelezen = 1 WHERE id = $id");
    header("Location: contact_berichten.php");
    exit;
}
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.page-header {
    background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
    border-bottom: 1px solid rgba(0, 130, 137, 0.3);
    padding: 3rem 0;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
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

.messages-section {
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

.message-card {
    background-color: #2a2a2a;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

.message-card.unread {
    border-color: rgba(0, 130, 137, 0.5);
    background-color: #2a2a2a;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.message-info {
    flex: 1;
}

.message-name {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.message-email {
    color: #888;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.message-date {
    color: #666;
    font-size: 0.8rem;
}

.message-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

.message-subject {
    color: rgba(0, 130, 137, 1);
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    padding: 0.5rem;
    background-color: rgba(0, 130, 137, 0.1);
    border-radius: 5px;
}

.message-content {
    color: #ccc;
    line-height: 1.6;
    white-space: pre-wrap;
    background-color: #1a1a1a;
    padding: 1rem;
    border-radius: 5px;
    border-left: 3px solid rgba(0, 130, 137, 0.5);
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-1px);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 1) 0%, rgba(154, 37, 48, 1) 100%);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, rgba(154, 37, 48, 1) 0%, rgba(220, 53, 69, 1) 100%);
    transform: translateY(-1px);
    color: white;
    text-decoration: none;
}

.no-messages {
    text-align: center;
    color: #888;
    font-size: 1.1rem;
    padding: 3rem;
}

.message-card:hover {
    background-color: #333;
    border-color: rgba(0, 130, 137, 0.5);
}

.message-card.unread {
    border-left: 4px solid rgba(0, 130, 137, 1);
    background-color: rgba(0, 130, 137, 0.05);
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.message-info {
    flex: 1;
}

.message-name {
    color: white;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.message-email {
    color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.message-date {
    color: #888;
    font-size: 0.8rem;
}

.message-subject {
    color: #e0e0e0;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.message-content {
    color: #ccc;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    white-space: pre-wrap;
}

.message-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-1px);
    color: white;
    text-decoration: none;
}

.btn-danger {
    background: linear-gradient(135deg, rgba(220, 53, 69, 1) 0%, rgba(154, 37, 48, 1) 100%);
    color: white;
}

.btn-danger:hover {
    background: linear-gradient(135deg, rgba(154, 37, 48, 1) 0%, rgba(220, 53, 69, 1) 100%);
    transform: translateY(-1px);
    color: white;
    text-decoration: none;
}

.no-messages {
    text-align: center;
    color: #888;
    font-size: 1.1rem;
    padding: 3rem;
}

.back-link {
    display: inline-block;
    margin-bottom: 2rem;
    color: rgba(0, 130, 137, 1);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.back-link:hover {
    color: white;
    text-decoration: none;
}

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
    
    .messages-section {
        padding: 1.5rem;
    }
    
    .message-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .message-actions {
        flex-direction: column;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">📧 Contact Berichten</h1>
            <p class="page-subtitle">Bekijk en beheer alle contactformulier berichten</p>
        </div>
    </div>

    <a href="dashboard.php" class="back-link">← Terug naar Dashboard</a>

    <!-- Messages Section -->
    <div class="messages-section">
        <h2 class="section-title">📋 Alle Berichten</h2>
        
        <?php
        // Haal alle berichten op uit de database
        $result = $conn->query("SELECT * FROM contact_berichten ORDER BY datum DESC");
        
        if ($result && $result->num_rows > 0):
            echo "<p><strong>📊 Totaal aantal berichten: " . $result->num_rows . "</strong></p>";
            while ($bericht = $result->fetch_assoc()):
                $unread_class = $bericht['gelezen'] ? '' : 'unread';
        ?>
        <div class="message-card <?= $unread_class ?>">
            <div class="message-header">
                <div class="message-info">
                    <div class="message-name"><?= htmlspecialchars($bericht['naam']) ?></div>
                    <div class="message-email"><?= htmlspecialchars($bericht['email']) ?></div>
                    <div class="message-date"><?= date('d-m-Y H:i', strtotime($bericht['datum'])) ?></div>
                </div>
                <div class="message-actions">
                    <?php if (!$bericht['gelezen']): ?>
                    <a href="?markeer_gelezen=<?= $bericht['id'] ?>" class="btn btn-primary">Markeer als gelezen</a>
                    <?php endif; ?>
                    <a href="?verwijder=<?= $bericht['id'] ?>" class="btn btn-danger" 
                       onclick="return confirm('Weet je het zeker? Dit bericht wordt permanent verwijderd.')">Verwijder</a>
                </div>
            </div>
            <div class="message-subject"><?= htmlspecialchars($bericht['onderwerp']) ?></div>
            <div class="message-content"><?= htmlspecialchars($bericht['bericht']) ?></div>
        </div>
        <?php 
            endwhile;
        else:
        ?>
        <div class="no-messages">
            <p>Er zijn nog geen contactberichten ontvangen.</p>
            <p><strong>Debug info:</strong> <?= $conn->error ? $conn->error : 'Geen fout' ?></p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../inc/footer.php'; ?>
