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
    font-family: 'Segoe UI', sans-serif;
}

h1,
h2 {
    color: rgba(0, 130, 137, 1);
    font-weight: bold;
}

h1 {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

form {
    background-color: black;
    padding: 15px;
    border: 1px solid white;
    border-radius: 0.5rem;
    color: white;
}

.form-control,
.form-select {
    background-color: #2a2a2a;
    color: white;
    border: 1px solid white;
    border-radius: 0.25rem;
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.btn-primary {
    background-color: rgba(0, 130, 137, 1);
    border-color: rgba(0, 130, 137, 1);
}

.btn-primary:hover {
    background-color: rgba(0, 130, 137, 0.8);
    border-color: rgba(0, 130, 137, 0.8);
}

.btn-secondary {
    background-color: #444;
    border-color: #444;
    color: white;
}

.btn-secondary:hover {
    background-color: #666;
    border-color: #666;
    color: white;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-danger:hover {
    background-color: #c82333;
}

.table {
    color: white;
    background-color: #ffffffff;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #ffffffff;
}

.table-striped tbody tr:nth-of-type(even) {
    background-color: #ffffffff;
}

.table td,
.table th {
    border: 1px solid rgba(0, 130, 137, 1);
    vertical-align: middle;
    background-color: #000000;
    color: #fff;
    text-align: center;
}

.table .form-control,
.table .form-select,
.table textarea {
    background-color: #ffffffff;
    color: white;
    border: 1px solid white;
}

.table .form-control::placeholder,
.table textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.table textarea {
    resize: vertical;
}

@media (max-width: 768px) {
    .table {
        font-size: 14px;
    }

    .form-control,
    .form-select,
    textarea {
        font-size: 14px;
    }
}

.table thead th {
    background-color: rgba(0, 130, 137, 1);
    font-weight: bold;
    text-align: center;
    border: 1px solid rgba(0, 130, 137, 1);
    color: black;
}
</style>

<div class="container my-5">
    <h1 class="mb-4 text-center">📍 Personen in <?= safeHtml($stad) ?></h1>

    <div class="mb-3">
        <a href="admin_statistieken.php" class="btn btn-dark">← Terug</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
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
                        <img src="<?= $fotoURL ?>" alt="Foto van <?= safeHtml($row['naam']) ?>"
                            style="width:60px; height:60px; object-fit: cover; border-radius: 50%;">
                    </td>
                    <td><?= safeHtml($row['naam']) ?></td>
                    <td><?= safeHtml($row['email']) ?></td>
                    <td><?= safeHtml($row['werkervaring']) ?></td>
                    <td><?= safeHtml($row['telefoon']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="alert alert-danger text-center mt-4">
        Geen personen gevonden in deze stad.
    </div>
    <?php endif; ?>
</div>

<?php
include '../inc/footer.php';
?>