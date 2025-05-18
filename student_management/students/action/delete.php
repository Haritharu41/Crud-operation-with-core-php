<?php
require_once __DIR__ . '/../../core/db.php';

// Fuction to delete file on directory
function deleteFile($filePath)
{
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return ['success' => true, 'message' => 'File deleted successfully.'];
        } else {
            return ['success' => false, 'message' => 'Unable to delete the file.'];
        }
    } else {
        return ['success' => false, 'message' => 'File does not exist.'];
    }
}



if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];


    // Get the old profile image
    $stmt = $connection->prepare("SELECT profile FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $oldProfile = $student['profile'] ?? null;

    // Calling delete fuction for file delete on directory
    $isdelete = deleteFile('../../uploads/' . $oldProfile);
    if ($isdelete['success']) {
        echo $isdelete['message'];
    } else {
        echo "Error: " . $isdelete['message'];
    }

    $sql = "DELETE FROM `students` WHERE id=$id";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header('location:../index.php');
    } else {
        die(mysqli_error($connection));
    }
}
