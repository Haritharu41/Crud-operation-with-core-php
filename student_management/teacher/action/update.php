
<?php

session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$nameErr = $emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php';
    $id = $_POST['id'];

    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
        $errors['name'] = $nameErr;
    } else {
        $name = test_input($_POST['name']);
    }


    if (empty($_POST['email'])) {
        $emailErr = 'Email is requrired';
        $errors['email'] = $emailErr;
    } else {

        $email = test_input($_POST['email']);
    }

    if (empty($_POST['password'])) {
        $passwordErr = 'Password is required';
        $errors['password'] = $passwordErr;
    } else {

        $password = $_POST['password'];
    }

    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }



    // If any error, store in session and redirect
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['name' => $name, 'email' => $email];

        header("Location: ../edit.php?updateid=" . $id);
        exit();
    }


    if ($password) {

        $query = "UPDATE teachers SET  name = ?, email = ?, password= ? WHERE id = ?";
        $stmt = $connection->prepare($query);

        if ($stmt) {
            echo "Hello dev";
            $stmt->bind_param("sssi",  $name, $email,  $hashedPassword, $id);
            $stmt->execute();
            $stmt->close();
            header("Location: ../index.php");
        } else {

            die("Update failed: " . $connection->error);
        }
    } else {
        die("Pasword is not found");
    }
} else {


    die("Invalid request.");
}
