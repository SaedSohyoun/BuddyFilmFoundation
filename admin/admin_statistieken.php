<?php
include '../inc/connectie.php';
include '../inc/header.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Totaal gebruikers
$aantalGebruikers = $conn->query("SELECT COUNT(*) AS totaal FROM gebruikers")->fetch_assoc()['totaal'];

// Totaal filmmakers
$totalFilmmakers = $conn->query("SELECT COUNT(*) AS totaal FROM gebruikers WHERE rol = 'filmmaker'")
    ->fetch_assoc()['totaal'];

// Totaal admins
$totalAdmins = $conn->query("SELECT COUNT(*) AS totaal FROM gebruikers WHERE rol = 'admin'")
    ->fetch_assoc()['totaal'];

// Nieuwe filmmakers afgelopen 7 dagen
$date7DaysAgo = date('Y-m-d', strtotime('-7 days'));
$stmtNew = $conn->prepare("SELECT COUNT(*) AS nieuw FROM gebruikers WHERE rol = 'filmmaker' AND datum_toegevoegd >= ?");
$stmtNew->bind_param("s", $date7DaysAgo);
$stmtNew->execute();
$newCount = $stmtNew->get_result()->fetch_assoc()['nieuw'] ?? 0;

// Profielfoto's
$fotoResult = $conn->query("SELECT COUNT(*) AS met_foto FROM gebruikers WHERE rol = 'filmmaker' AND profielfoto IS NOT NULL AND profielfoto != ''");
$metFoto = $fotoResult->fetch_assoc()['met_foto'] ?? 0;
$zonderFoto = $totalFilmmakers - $metFoto;

// Donatie statistieken - check eerst of tabel bestaat
$donatieStats = null;
$alleDonaties = null;
$recenteDonaties = 0;

try {
    // Check of de donaties tabel bestaat
    $tableExists = $conn->query("SHOW TABLES LIKE 'donaties'");
    
    if ($tableExists->num_rows > 0) {
        // Tabel bestaat, haal statistieken op
        $donatieStats = $conn->query("SELECT 
            COUNT(*) as totaal_donaties,
            SUM(bedrag) as totaal_bedrag,
            AVG(bedrag) as gemiddeld_bedrag,
            MAX(bedrag) as hoogste_donatie,
            MIN(bedrag) as laagste_donatie
        FROM donaties")->fetch_assoc();

        // Donaties van afgelopen 30 dagen
        $date30DaysAgo = date('Y-m-d', strtotime('-30 days'));
        $recenteDonaties = $conn->query("SELECT COUNT(*) as recent FROM donaties WHERE datum >= '$date30DaysAgo'")->fetch_assoc()['recent'] ?? 0;

        // Alle donaties ophalen voor de tabel
        $alleDonaties = $conn->query("SELECT * FROM donaties ORDER BY datum DESC, tijd DESC LIMIT 50");
    }
} catch (Exception $e) {
    // Tabel bestaat niet, gebruik standaardwaarden
    $donatieStats = null;
    $alleDonaties = null;
    $recenteDonaties = 0;
}

$totaalDonaties = $donatieStats['totaal_donaties'] ?? 0;
$totaalBedrag = $donatieStats['totaal_bedrag'] ?? 0;
$gemiddeldBedrag = $donatieStats['gemiddeld_bedrag'] ?? 0;
$hoogsteDonatie = $donatieStats['hoogste_donatie'] ?? 0;
$laagsteDonatie = $donatieStats['laagste_donatie'] ?? 0;

// Steden ophalen
$stedenResultaat = $conn->query("SELECT stad, COUNT(*) as aantal FROM gebruikers WHERE stad IS NOT NULL AND stad != '' GROUP BY stad ORDER BY aantal DESC");

$stadLabels = [];
$stadData = [];
while ($rij = $stedenResultaat->fetch_assoc()) {
    $stadLabels[] = $rij['stad'];
    $stadData[] = $rij['aantal'];
}
$stadLabelsJS = json_encode($stadLabels);
$stadDataJS = json_encode($stadData);

// Werkervaring telling
$werkervaringCounts = [];
$result = $conn->query("SELECT werkervaring FROM gebruikers WHERE rol = 'filmmaker' AND werkervaring IS NOT NULL AND werkervaring != ''");

while ($row = $result->fetch_assoc()) {
    $ervaringen = array_map('trim', explode(',', $row['werkervaring']));
    foreach ($ervaringen as $ervaring) {
        if (!empty($ervaring)) {
            $werkervaringCounts[$ervaring] = ($werkervaringCounts[$ervaring] ?? 0) + 1;
        }
    }
}
arsort($werkervaringCounts);
$labels = json_encode(array_keys($werkervaringCounts));
$data = json_encode(array_values($werkervaringCounts));
?>
<style>
/* Basis body styling */
body {
    background-color: black;
    color: white;
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
}

h1,
h2,
h5 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

/* Cards styling */
.card {
    background-color: #1e1e1e;
    border: 1px solid rgba(0, 130, 137, 1);
    border-radius: 0.5rem;
}

/* Overrides voor specifieke card bg kleuren met witte tekst */
.bg-primary {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

.bg-success {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

.bg-danger {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

.bg-warning {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

.bg-info {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

.bg-info {
    background-color: rgba(0, 0, 0, 1) !important;
    color: white !important;
}

/* Text center consistentie */
.text-center {
    text-align: center;
}

/* Knoppen */
.btn-outline-secondary {
    color: white;
    border-color: white;
    background-color: transparent;
    transition: all 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: rgba(0, 130, 137, 0.8);
    border-color: rgba(0, 130, 137, 0.8);
    color: white;
}

/* Modern Dashboard Button */
.btn-dashboard {
    background: linear-gradient(135deg, rgba(0, 130, 137, 1) 0%, rgba(0, 100, 105, 1) 100%);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-dashboard::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-dashboard:hover {
    background: linear-gradient(135deg, rgba(0, 100, 105, 1) 0%, rgba(0, 130, 137, 1) 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 130, 137, 0.4);
    color: white;
    text-decoration: none;
}

.btn-dashboard:hover::before {
    left: 100%;
}

.btn-dashboard:active {
    transform: translateY(0);
    box-shadow: 0 4px 15px rgba(0, 130, 137, 0.3);
}

.btn-dashboard i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
}

/* Cards body padding */
.card-body {
    padding: 1.25rem 1.5rem;
}

/* Canvas styling */
canvas {
    background-color: #000000ff;
    border-radius: 0.5rem;
    display: block;
    margin: 0 auto;
    max-width: 100%;
}

/* Table styling */
.table {
    color: white;
    background-color: #1e1e1e;
    border-radius: 0.5rem;
    overflow: hidden;
}

.table th {
    background-color: rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.3);
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
}

.table td {
    border-color: rgba(0, 130, 137, 0.2);
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: rgba(0, 130, 137, 0.1);
}

.badge {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
}

.badge-success {
    background-color: rgba(40, 167, 69, 0.2);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.badge-warning {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.badge-info {
    background-color: rgba(23, 162, 184, 0.2);
    color: #17a2b8;
    border: 1px solid rgba(23, 162, 184, 0.3);
}

.badge-secondary {
    background-color: rgba(108, 117, 125, 0.2);
    color: #6c757d;
    border: 1px solid rgba(108, 117, 125, 0.3);
}

/* Table styling */
.table {
    color: white;
    background-color: #1e1e1e;
    border-radius: 0.5rem;
    overflow: hidden;
}

.table th {
    background-color: rgba(0, 130, 137, 0.2);
    border-color: rgba(0, 130, 137, 0.3);
    color: rgba(0, 130, 137, 1);
    font-weight: 600;
}

.table td {
    border-color: rgba(0, 130, 137, 0.2);
    vertical-align: middle;
}

.table tbody tr:hover {
    background-color: rgba(0, 130, 137, 0.1);
}

.badge {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
}

.badge-success {
    background-color: rgba(40, 167, 69, 0.2);
    color: #28a745;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.badge-warning {
    background-color: rgba(255, 193, 7, 0.2);
    color: #ffc107;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.badge-info {
    background-color: rgba(23, 162, 184, 0.2);
    color: #17a2b8;
    border: 1px solid rgba(23, 162, 184, 0.3);
}
</style>
<div class="container my-5">
    <h1 class="mb-4 text-center">📊 Admin Statistieken</h1>

    <div class="row g-4">
        <div class="col-md-2">
            <div class="card bg-primary text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Gebruikers</h5>
                    <p class="fs-2"><?= $aantalGebruikers ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-success text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Deelnemers</h5>
                    <p class="fs-2"><?= $totalFilmmakers ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-danger text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Admins</h5>
                    <p class="fs-2"><?= $totalAdmins ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-warning text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Nieuwe(7d)</h5>
                    <p class="fs-2"><?= $newCount ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-info text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Donaties</h5>
                    <p class="fs-2"><?= $totaalDonaties ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-success text-white text-center shadow">
                <div class="card-body">
                    <h5 class="card-title">Totaal €</h5>
                    <p class="fs-2">€<?= number_format($totaalBedrag, 2) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Donatie Statistieken -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #ffffffff;">💰 Donatie Statistieken</h5>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <p style="color: #ffffffff;">📊 Totaal donaties: <strong><?= $totaalDonaties ?></strong></p>
                        </div>
                        <div class="col-md-3">
                            <p style="color: #ffffffff;">💶 Totaal bedrag:
                                <strong>€<?= number_format($totaalBedrag, 2) ?></strong></p>
                        </div>
                        <div class="col-md-3">
                            <p style="color: #ffffffff;">📈 Gemiddeld:
                                <strong>€<?= number_format($gemiddeldBedrag, 2) ?></strong></p>
                        </div>
                        <div class="col-md-3">
                            <p style="color: #ffffffff;">🕒 Recent (30d): <strong><?= $recenteDonaties ?></strong></p>
                        </div>
                    </div>
                    <div class="row text-center mt-2">
                        <div class="col-md-6">
                            <p style="color: #ffffffff;">⬆️ Hoogste donatie:
                                <strong>€<?= number_format($hoogsteDonatie, 2) ?></strong></p>
                        </div>
                        <div class="col-md-6">
                            <p style="color: #ffffffff;">⬇️ Laagste donatie:
                                <strong>€<?= number_format($laagsteDonatie, 2) ?></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #ffffffff;">📸 Profielfoto Statistieken</h5>
                    <p style="color: #ffffffff;">✅ Met foto: <strong><?= $metFoto ?></strong></p>
                    <p style="color: #ffffffff;">❌ Zonder foto: <strong><?= $zonderFoto ?></strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #ffffffff;">📈 Werkervaring per type</h5>
                    <canvas id="werkervaringChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #ffffffff;">Aantal leden per stad</h5>
                    <?php if (count($stadLabels) > 0): ?>
                    <canvas id="stadChart" style="height: 400px;"></canvas>
                    <?php else: ?>
                    <p class="text-center text-muted">Geen stadsgegevens beschikbaar.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Donaties Overzicht -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title text-center" style="color: #ffffffff;">💰 Recente Donaties</h5>
                    <?php if ($alleDonaties && $alleDonaties->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Datum</th>
                                    <th>Naam</th>
                                    <th>Email</th>
                                    <th>Bedrag</th>
                                    <th>Donatie namens</th>
                                    <th>Gehoord via</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($donatie = $alleDonaties->fetch_assoc()): ?>
                                <tr>
                                    <td><?= date('d-m-Y H:i', strtotime($donatie['datum'] . ' ' . $donatie['tijd'])) ?>
                                    </td>
                                    <td><?= htmlspecialchars($donatie['voornaam'] . ' ' . $donatie['achternaam']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($donatie['email']) ?></td>
                                    <td><strong>€<?= number_format($donatie['bedrag'], 2) ?></strong></td>
                                    <td>
                                        <?php 
                                        switch($donatie['donatie_namens']) {
                                            case 'myself':
                                                echo '<span class="badge badge-info">Zichzelf</span>';
                                                break;
                                            case 'organization':
                                                echo '<span class="badge badge-warning">Organisatie</span>';
                                                break;
                                            case 'someone-else':
                                                echo '<span class="badge badge-success">Iemand anders</span>';
                                                break;
                                            default:
                                                echo '<span class="badge badge-secondary">Niet opgegeven</span>';
                                        }
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($donatie['gehoord_via']) ?></td>
                                    <td>
                                        <?php if ($donatie['status'] == 'completed'): ?>
                                        <span class="badge badge-success">Voltooid</span>
                                        <?php elseif ($donatie['status'] == 'pending'): ?>
                                        <span class="badge badge-warning">In behandeling</span>
                                        <?php else: ?>
                                        <span class="badge badge-secondary">Onbekend</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p class="text-center text-muted">Nog geen donaties ontvangen. <a href="../donaties_tabel.sql"
                            class="text-info">Klik hier om de donaties tabel aan te maken.</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="dashboard.php" class="btn-dashboard">
            <i class="fas fa-arrow-left"></i> Terug naar Dashboard
        </a>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Werkervaring grafiek
const ctxWerk = document.getElementById('werkervaringChart').getContext('2d');
new Chart(ctxWerk, {
    type: 'bar',
    data: {
        labels: <?= $labels ?>,
        datasets: [{
            label: 'Aantal filmmakers',
            data: <?= $data ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

<?php if (count($stadLabels) > 0): ?>
// Stad grafiek met klik event
const ctxStad = document.getElementById('stadChart').getContext('2d');
const stadChart = new Chart(ctxStad, {
    type: 'bar',
    data: {
        labels: <?= $stadLabelsJS ?>,
        datasets: [{
            label: 'Aantal leden per stad',
            data: <?= $stadDataJS ?>,
            backgroundColor: 'rgba(255, 99, 132, 0.7)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        onClick: (evt, elements) => {
            if (elements.length > 0) {
                const index = elements[0].index;
                const label = stadChart.data.labels[index];
                window.location.href = 'stad_detail.php?stad=' + encodeURIComponent(label);
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
<?php endif; ?>
</script>


<?php include '../inc/footer.php'; ?>