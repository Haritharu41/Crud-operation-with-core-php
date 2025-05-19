<?php
session_start();

require_once __DIR__ . '/../../core/db.php';


if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
    $errors['email'] = $emailErr;
} else {

    $email = trim($_POST['email']);
}

if (empty($_POST['password'])) {


    $passwordErr = 'Passwor is reuired';
    $errors['password'] = $passwordErr;
}
else{
$password = $_POST['password'] ;
    
}



if(!empty($errors)){
    $_SESSION['errors']=$errors;

    header("Location: ../login.php");
    exit();
}


$query = "SELECT * FROM teachers WHERE email = ?";
$stmt = $connection->prepare($query);

if (!$stmt) {

    die("Prepare failed: " . $connection->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();


if ($teacher && password_verify($password, $teacher['password'])) {

    $_SESSION['teacher'] = [
        'id' => $teacher['id'],
        'name' => $teacher['name'],
        'email' => $teacher['email']
    ];

    $_SESSION['is_logged_in'] = true;

    header("Location:../../teacher/index.php");
    exit();
} else {

    $_SESSION['login_error'] = "Invalid credentials.";
    header("Location: ../login.php");
    exit();
}
