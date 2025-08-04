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

<!-- STYLING -->
<style>
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
}

.form-select,
.form-control {
    background-color: #222;
    color: white;
    border: 1px solid rgba(0, 130, 137, 1);
}

.form-select:focus,
.form-control:focus {
    box-shadow: none;
    border-color: rgba(0, 130, 137, 1);
    background-color: #333;
}

.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    border: none;
    font-weight: 600;
}

.btn-outline-secondary {
    color: white;
    border-color: white;
}

.btn-outline-primary {
    color: rgba(0, 130, 137, 1);
    border: 2px solid rgba(0, 130, 137, 1);
    background-color: transparent;
}

.btn-outline-primary:hover {
    background-color: rgba(0, 130, 137, 1);
    color: black;
}

h1,
h5 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

.badge.bg-primary {
    background-color: rgba(0, 130, 137, 1);
    font-size: 0.9rem;
    margin: 2px;
}

.card {
    background-color: #1a1a1a;
    border: none;
    color: white;
}

.card-img-top {
    object-fit: cover;
    height: 250px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.card-body {
    padding: 1.2rem;
}

.container {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

#zoek::placeholder {
    color: #6e6e6eff;
    /* wit */
    opacity: 1;
    /* zorgt dat wit niet grijzig wordt */
}
</style>

<!-- CONTENT -->
<div class="container my-5">
    <h1 class="mb-4">Filmmakers zoeken</h1>

    <!-- Zoek + Filter balk -->
    <form method="get" class="mb-4">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <select name="werkervaring" id="werkervaring" class="form-select">
                    <option value="">Filter op functie of ervaring</option>
                    <?php foreach ($ervaringen as $ervaring): ?>
                    <option value="<?= htmlspecialchars($ervaring) ?>" <?= $filter === $ervaring ? 'selected' : '' ?>>
                        <?= ucfirst(htmlspecialchars($ervaring)) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <input type="text" name="zoek" id="zoek" class="form-control"
                    placeholder="Typ naam of functie (bijv. editor)" value="<?= htmlspecialchars($zoek) ?>">
            </div>

            <div class="col-md-auto">
                <button type="submit" class="btn btn-primary">Zoeken</button>
                <?php if (!empty($filter) || !empty($zoek)): ?>
                <a href="filmmakers.php" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <!-- Resultaten -->
    <?php if ($result->num_rows === 0): ?>
    <p><em>Geen filmmakers gevonden.</em></p>
    <?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
        <?php
                    $photoPath = 'uploads/profielfotos/' . $row['profielfoto'];
                    $imgSrc = (!empty($row['profielfoto']) && file_exists($photoPath))
                        ? $photoPath
                        : 'uploads/profielfotos/default.png';
                    $tags = array_map('trim', explode(',', $row['werkervaring']));
                ?>
        <div class="col">
            <div class="card h-100 text-center shadow">
                <img src="<?= htmlspecialchars($imgSrc) ?>" class="card-img-top"
                    alt="Profielfoto van <?= htmlspecialchars($row['naam']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['naam']) ?></h5>
                    <?php if (!empty($tags)): ?>
                    <div class="mb-2">
                        <?php foreach ($tags as $tag): ?>
                        <span class="badge bg-secondary"><?= htmlspecialchars($tag) ?></span>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <a href="filmmaker_detail.php?id=<?= htmlspecialchars($row['id']) ?>"
                        class="btn btn-outline-primary mt-2">Bekijk Portfolio</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>

<?php include 'inc/footer.php'; ?>