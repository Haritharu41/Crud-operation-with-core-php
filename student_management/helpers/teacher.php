<?php
require_once __DIR__ . '/../core/db.php';


 
function getTeacherById($id)
{
    global $connection;

    $stmt = mysqli_prepare($connection, "SELECT * FROM teachers WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $teacher = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $teacher;
}

function getTeachers()
{
    global $connection;

    $query = "SELECT * FROM teachers";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}
