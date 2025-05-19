
<?php

session_start();

function test_input($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../core/db.php';


    if (empty($_POST['name'])) {
        $nameErr = 'Name is required';
        $errors['name'] = $nameErr;
    } else {
        $name = test_input($_POST['name']);
    }

    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
        $errors['email'] = $emailErr;
    } else {
        $email = test_input($_POST['email']);
    }


    $id = $_POST['id'] ?? null;

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../edit.php?updateid=" . $id);
        exit();
    }





    // Get the old profile image
    $stmt = $connection->prepare("SELECT profile FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $oldProfile = $student['profile'] ??  null;


    if (!empty($_FILES['profile']['name'])) {
        $profileName = time() . '_' . basename($_FILES['profile']['name']);
        $targetDir = __DIR__ . '/../../uploads/';
        $targetPath = $targetDir . $profileName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath)) {
            $profilePath = $profileName;

            // Optionally delete old image
            if ($oldProfile && file_exists(__DIR__ . '/../../uploads/' . $oldProfile)) {
                unlink(__DIR__ . '/../../uploads/' . $oldProfile);
            }
        }
    } else {
        $profilePath = $oldProfile;
    }


    if ($id) {
        $query = "UPDATE students SET profile= ?, name = ?, email = ? WHERE id = ?";

        $stmt = $connection->prepare($query);

        if ($stmt) {


            $stmt->bind_param("sssi",  $profilePath, $name, $email,  $id);
            $stmt->execute();
            $stmt->close();


            header("Location: ../index.php");
            exit();
        } else {
            die("Update failed: " . $connection->error);
        }
    }
} else {

    die("Invalid request.");
}
