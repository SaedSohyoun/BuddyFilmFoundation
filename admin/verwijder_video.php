<?php
session_start();
include '../inc/connectie.php';

// Alleen admin mag dit
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Check of ID geldig is
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ../index.php");
    exit;
}

$id = $_GET['id'];

// Verwijder video
$stmt = $conn->prepare("DELETE FROM videos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../index.php");
exit;