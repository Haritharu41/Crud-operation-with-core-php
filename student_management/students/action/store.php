<?php

session_start();
require_once __DIR__ . '/../../core/db.php';

function test_input($data)

{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function uploadProfileImage($file)
{
    $targetDir = __DIR__ . "/../../uploads/";
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 50000 * 1024; // 500 KB  


    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'No file uploaded or upload error.', 'filename' => ''];
    }

    $filename = basename($file['name']);
    $tmpPath = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Check if uploaded file is a real image
    if (getimagesize($tmpPath) === false) {
        return ['success' => false, 'message' => 'File is not a valid image.', 'filename' => ''];
    }

    // Validate extension
    if (!in_array($fileExt, $allowedTypes)) {
        return ['success' => false, 'message' => 'Only JPG, JPEG, PNG & GIF files are allowed.', 'filename' => ''];
    }

    // Validate file size
    if ($fileSize > $maxFileSize) {
        return ['success' => false, 'message' => 'File is too large. Max size is 500KB.', 'filename' => ''];
    }

    // Ensure the target directory exists and is writable
    if (!is_dir($targetDir)) {
        if (!mkdir($targetDir, 0755, true)) {
            return ['success' => false, 'message' => 'Failed to create upload directory.', 'filename' => ''];
        }
    }

    if (!is_writable($targetDir)) {
        return ['success' => false, 'message' => 'Upload directory is not writable.', 'filename' => ''];
    }

    // Generate a unique filename
    $uniqueFilename = uniqid('user_') . '.' . $fileExt;
    $uploadPath = $targetDir . $uniqueFilename;

    // Confirm it's a valid uploaded file
    if (!is_uploaded_file($tmpPath)) {
        return ['success' => false, 'message' => 'The file was not uploaded via HTTP POST.', 'filename' => ''];
    }


    // Move the file to the uploads directory
    if (move_uploaded_file($tmpPath, $uploadPath)) {
        return ['success' => true, 'filename' => $uniqueFilename];
    } else {
        return ['success' => false, 'message' => 'Failed to move uploaded file.', 'filename' => ''];
    }
}


$profile = uploadProfileImage($_FILES['profile'])['filename'];
  


// Upload data in database
if (isset($_POST['submit'])) {

    global $profile;


    if (empty($_POST['name'])) {
        $nameErr = "Name is required";
        $errors['name'] = $nameErr;
    } else {
      $name= test_input( $_POST['name']);
    }
 
    if (empty($_POST['email'])) {
        $emailErr = 'Email is required';
        $errors['email'] = $emailErr;
    } else {

        $email = test_input($_POST['email']);
    }


    if(!empty($errors)){
        $_SESSION['errors']=$errors;
    header("Location: ../create.php");
        exit();

    }

echo 'Hello devleopers'
;

   // If any error, store in session and redirect
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['name' => $name, 'email' => $email];

        header("Location: ../create.php");
        exit();
    }




    $sql = "INSERT INTO `students`(`profile`, `name`, `email`) VALUES ('$profile', '$name','$email')";

    if ($connection->query($sql) === TRUE) {
        header("Location:../index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
