<?php
require_once __DIR__ . '/../core/db.php';

function getStudentById($id)
{
    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT * FROM students WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $result = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $result;
}

function getStudents()
{
    global $connection;

    $query = "SELECT * FROM students";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}
