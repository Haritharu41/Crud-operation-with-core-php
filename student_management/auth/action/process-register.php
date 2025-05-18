<?php
session_start();
require_once __DIR__ . '/../../core/db.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$name || !$email || !$password) {
    $_SESSION['register_error'] = "All fields are required.";
    header("Location: ../../auth/register.php");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$checkQuery = "SELECT id FROM teachers WHERE email = ?";
$checkStmt = $connection->prepare($checkQuery);

if (!$checkStmt) {
    die("Prepare failed: " . $connection->error);
}

$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    $_SESSION['register_error'] = "Email already registered.";
    $checkStmt->close();
    header("Location: ../../auth/register.php");
    exit;
}
$checkStmt->close();


$insertQuery = "INSERT INTO teachers (name, email, password) VALUES (?, ?, ?)";
$insertStmt = $connection->prepare($insertQuery);

if (!$insertStmt) {
    $_SESSION['register_error'] = "Something went wrong. Try again.";
    header("Location: ../../auth/register.php");
    exit;
}

$insertStmt->bind_param("sss", $name, $email, $hashedPassword);
$insertStmt->execute();
$insertStmt->close();

// (Optional) Automatically log in the user after registration
$_SESSION['teacher'] = [
    'id' => $connection->insert_id,
    'name' => $name,
    'email' => $email
];


header("Location: ../../teacher/index.php");
exit;
