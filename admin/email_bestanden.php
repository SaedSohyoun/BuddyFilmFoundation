<?php
session_start();
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Verwijder e-mail bestand
if (isset($_GET['verwijder']) && !empty($_GET['verwijder'])) {
    $filename = basename($_GET['verwijder']); // Veilig maken
    $filepath = "../emails/" . $filename;
    if (file_exists($filepath) && strpos($filename, '.txt') !== false) {
        unlink($filepath);
        header("Location: email_bestanden.php?deleted=1");
        exit;
    }
}

// Bekijk e-mail bestand
$email_content = '';
if (isset($_GET['bekijk']) && !empty($_GET['bekijk'])) {
    $filename = basename($_GET['bekijk']); // Veilig maken
    $filepath = "../emails/" . $filename;
    if (file_exists($filepath) && strpos($filename, '.txt') !== false) {
        $email_content = file_get_contents($filepath);
    }
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

.files-section {
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

.file-card {
    background-color: #2a2a2a;
    border-radius: 10px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    border: 1px solid #444;
    transition: all 0.3s ease;
}

.file-card:hover {
    background-color: #333;
    border-color: rgba(0, 130, 137, 0.5);
}

.file-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.file-name {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
}

.file-date {
    color: #888;
    font-size: 0.9rem;
}

.file-actions {
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

.email-content {
    background-color: #1a1a1a;
    border-radius: 10px;
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid #333;
    white-space: pre-wrap;
    font-family: 'Courier New', monospace;
    font-size: 0.9rem;
    line-height: 1.6;
    max-height: 500px;
    overflow-y: auto;
}

.no-files {
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

.success-message {
    background-color: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.5);
    color: #51cf66;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
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
    
    .files-section {
        padding: 1.5rem;
    }
    
    .file-info {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .file-actions {
        flex-direction: column;
        width: 100%;
    }
}
</style>

<div class="admin-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-content">
            <h1 class="page-title">📧 E-mail Bestanden</h1>
            <p class="page-subtitle">Bekijk e-mail bestanden die lokaal zijn opgeslagen tijdens ontwikkeling</p>
        </div>
    </div>

    <a href="dashboard.php" class="back-link">← Terug naar Dashboard</a>

    <?php if (isset($_GET['deleted'])): ?>
    <div class="success-message">
        <strong>✅ Succes!</strong> E-mail bestand is verwijderd.
    </div>
    <?php endif; ?>

    <!-- Files Section -->
    <div class="files-section">
        <h2 class="section-title">📁 E-mail Bestanden</h2>
        
        <?php
        $emails_dir = "../emails/";
        if (is_dir($emails_dir)) {
            $files = glob($emails_dir . "*.txt");
            if (!empty($files)):
                // Sorteer op datum (nieuwste eerst)
                usort($files, function($a, $b) {
                    return filemtime($b) - filemtime($a);
                });
                
                foreach ($files as $file):
                    $filename = basename($file);
                    $file_date = date('d-m-Y H:i:s', filemtime($file));
                    $file_size = filesize($file);
                    $is_gmail = strpos($filename, 'GMAIL_') === 0;
        ?>
        <div class="file-card">
            <div class="file-info">
                <div>
                    <div class="file-name">
                        <?php if ($is_gmail): ?>
                            📧 <?= htmlspecialchars($filename) ?> (Gmail Notificatie)
                        <?php else: ?>
                            📬 <?= htmlspecialchars($filename) ?> (Standaard E-mail)
                        <?php endif; ?>
                    </div>
                    <div class="file-date">
                        <?= $file_date ?> | <?= number_format($file_size) ?> bytes
                    </div>
                </div>
                <div class="file-actions">
                    <a href="?bekijk=<?= urlencode($filename) ?>" class="btn btn-primary">Bekijk</a>
                    <a href="?verwijder=<?= urlencode($filename) ?>" class="btn btn-danger" 
                       onclick="return confirm('Weet je het zeker? Dit e-mail bestand wordt permanent verwijderd.')">Verwijder</a>
                </div>
            </div>
        </div>
        <?php 
                endforeach;
            else:
        ?>
        <div class="no-files">
            <p>Er zijn nog geen e-mail bestanden gevonden.</p>
            <p>E-mail bestanden worden hier opgeslagen tijdens lokale ontwikkeling.</p>
        </div>
        <?php 
            endif;
        } else {
        ?>
        <div class="no-files">
            <p>De emails directory bestaat niet.</p>
            <p>E-mail bestanden worden hier opgeslagen tijdens lokale ontwikkeling.</p>
        </div>
        <?php } ?>
    </div>

    <!-- Email Content Section -->
    <?php if (!empty($email_content)): ?>
    <div class="files-section">
        <h2 class="section-title">📄 E-mail Inhoud</h2>
        <div class="email-content"><?= htmlspecialchars($email_content) ?></div>
    </div>
    <?php endif; ?>
</div>

<?php include '../inc/footer.php'; ?>
