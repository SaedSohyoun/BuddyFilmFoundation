<?php
session_start();
include 'inc/connectie.php';
include 'inc/header.php';

$filter = $_GET['werkervaring'] ?? '';
$zoek = trim($_GET['zoek'] ?? '');

// Haal unieke werkervaringen op voor dropdown
$ervaringResult = $conn->query("SELECT DISTINCT werkervaring FROM gebruikers WHERE werkervaring IS NOT NULL AND werkervaring != ''");
$ervaringen = [];

while ($row = $ervaringResult->fetch_assoc()) {
    $delen = explode(',', $row['werkervaring']);
    foreach ($delen as $ervaring) {
        $ervaring = trim($ervaring);
        if ($ervaring && !in_array($ervaring, $ervaringen)) {
            $ervaringen[] = $ervaring;
        }
    }
}
sort($ervaringen);

// Query op basis van zoek en filter
$query = "SELECT id, gebruikersnaam, naam, profielfoto, werkervaring FROM gebruikers WHERE rol = 'filmmaker'";
$params = [];
$types = '';

if (!empty($filter)) {
    $query .= " AND werkervaring LIKE ?";
    $params[] = "%$filter%";
    $types .= 's';
}

if (!empty($zoek)) {
    $query .= " AND (naam LIKE ? OR werkervaring LIKE ?)";
    $params[] = "%$zoek%";
    $params[] = "%$zoek%";
    $types .= 'ss';
}

$query .= " ORDER BY naam ASC";
$stmt = $conn->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
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



    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
        background: linear-gradient(135deg, rgba(0, 130, 137, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
        border-bottom: 1px solid rgba(0, 130, 137, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="15" height="15" patternUnits="userSpaceOnUse"><path d="M 15 0 L 0 0 0 15" fill="none" stroke="rgba(0,130,137,0.08)" stroke-width="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.4;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        color: rgba(0, 130, 137, 1);
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
        text-shadow: 0 0 15px rgba(0, 130, 137, 0.2);
    }

    .hero-subtitle {
        color: #ccc;
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .search-section {
        background-color: #1a1a1a;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 3rem;
        border: 1px solid #333;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .search-form {
        display: flex;
        gap: 1rem;
        align-items: end;
        max-width: 800px;
        margin: 0 auto;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    .form-label {
        color: rgba(0, 130, 137, 1);
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-select,
    .form-control {
        background-color: #2a2a2a;
        border: 1px solid #555;
        color: white;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-select:focus,
    .form-control:focus {
        background-color: #2a2a2a;
        border-color: rgba(0, 130, 137, 1);
        color: white;
        box-shadow: 0 0 0 0.2rem rgba(0, 130, 137, 0.25);
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .btn-primary {
        background-color: rgba(0, 130, 137, 1);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #00676d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
        color: white;
        text-decoration: none;
    }

    .btn-outline-secondary {
        background-color: transparent;
        border: 1px solid #666;
        color: #ccc;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-outline-secondary:hover {
        background-color: #666;
        border-color: #666;
        color: white;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .filmmakers-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .filmmaker-card {
        background-color: #1a1a1a;
        border: 1px solid #333;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .filmmaker-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        border-color: rgba(0, 130, 137, 0.5);
    }

    .filmmaker-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        transition: transform 0.3s ease;
    }

    .filmmaker-card:hover .filmmaker-image {
        transform: scale(1.05);
    }

    .filmmaker-content {
        padding: 1.5rem;
    }

    .filmmaker-name {
        color: rgba(0, 130, 137, 1);
        font-size: 1.3rem;
        font-weight: bold;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    .filmmaker-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tag {
        background-color: rgba(0, 130, 137, 0.2);
        color: rgba(0, 130, 137, 1);
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .btn-portfolio {
        background-color: rgba(0, 130, 137, 1);
        color: white;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .btn-portfolio:hover {
        background-color: #00676d;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 130, 137, 0.3);
        color: white;
        text-decoration: none;
    }

    .no-results {
        text-align: center;
        padding: 3rem;
        color: #ccc;
        font-size: 1.1rem;
    }

    .no-results i {
        font-size: 3rem;
        color: rgba(0, 130, 137, 1);
        margin-bottom: 1rem;
        display: block;
    }

    .stats-section {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1.5rem;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: bold;
        color: rgba(0, 130, 137, 1);
        display: block;
    }

    .stat-label {
        color: #888;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.1rem;
        }

        .search-form {
            flex-direction: column;
            align-items: stretch;
        }

        .filmmakers-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .stats-section {
            flex-direction: column;
            gap: 1rem;
        }

        .page-container {
            padding: 1rem;
        }
    }
</style>

<div class="page-container">
    <div class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">🎬 Filmmakers</h1>
            <p class="hero-subtitle">Discover talented filmmakers and creative professionals from our network. Find the
                perfect collaborator for your next project.</p>

            <div class="stats-section">
                <div class="stat-item">
                    <span class="stat-number"><?= $result->num_rows ?></span>
                    <span class="stat-label">Available Filmmakers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number"><?= count($ervaringen) ?></span>
                    <span class="stat-label">Specializations</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Verified</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="search-section">
            <form method="get" class="search-form">
                <div class="form-group">
                    <label for="werkervaring" class="form-label">Filter op functie</label>
                    <select name="werkervaring" id="werkervaring" class="form-select">
                        <option value="">Alle functies</option>
                        <?php foreach ($ervaringen as $ervaring): ?>
                            <option value="<?= htmlspecialchars($ervaring) ?>"
                                <?= $filter === $ervaring ? 'selected' : '' ?>>
                                <?= ucfirst(htmlspecialchars($ervaring)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="zoek" class="form-label">Zoeken</label>
                    <input type="text" name="zoek" id="zoek" class="form-control"
                        placeholder="Naam of functie (bijv. editor)" value="<?= htmlspecialchars($zoek) ?>">
                </div>

                <div class="form-group">
                    <label class="form-label">&nbsp;</label>
                    <div style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Zoeken
                        </button>
                        <?php if (!empty($filter) || !empty($zoek)): ?>
                            <a href="filmmakers.php" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <?php if ($result->num_rows === 0): ?>
            <div class="no-results">
                <i class="fas fa-users"></i>
                <h3>Geen filmmakers gevonden</h3>
                <p><?= (!empty($filter) || !empty($zoek)) ? 'Probeer andere zoektermen of filters.' : 'Er zijn nog geen filmmakers geregistreerd.' ?>
                </p>
            </div>
        <?php else: ?>
            <div class="filmmakers-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    $photoPath = 'uploads/profielfotos/' . $row['profielfoto'];
                    $imgSrc = (!empty($row['profielfoto']) && file_exists($photoPath))
                        ? $photoPath
                        : 'uploads/profielfotos/default.png';
                    $tags = array_map('trim', explode(',', $row['werkervaring']));
                    ?>
                    <div class="filmmaker-card">
                        <img src="<?= htmlspecialchars($imgSrc) ?>" class="filmmaker-image"
                            alt="Profielfoto van <?= htmlspecialchars($row['naam']) ?>">
                        <div class="filmmaker-content">
                            <h3 class="filmmaker-name"><?= htmlspecialchars($row['naam']) ?></h3>
                            <?php if (!empty($tags)): ?>
                                <div class="filmmaker-tags">
                                    <?php foreach ($tags as $tag): ?>
                                        <span class="tag"><?= htmlspecialchars($tag) ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <a href="filmmaker_detail.php?id=<?= htmlspecialchars($row['id']) ?>" class="btn-portfolio">
                                <i class="fas fa-eye me-2"></i>Bekijk Portfolio
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<br><br><br>
</div>

<?php include 'inc/footer.php'; ?>