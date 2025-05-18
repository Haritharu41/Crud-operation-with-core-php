<?php
require_once __DIR__ . '/../../core/db.php';

$id = $_GET['deleteid'] ?? null;

if (!$id) {
    die("User ID is missing.");
}

$query = "DELETE FROM teachers WHERE id = ?";
$stmt = $connection->prepare($query);
echo "Hello dev";

if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: ../index.php");
    exit;
} else {

    die("Delete failed: " . $connection->error);
}
