<?php

require_once __DIR__ . '/../helpers/teacher.php';
require_once __DIR__ . '/../core/auth.php';


if (!isLoggedIn()) {
    $_SESSION['error'] = "You must be logged in to access this page";
    redirectToLogin();
}

$teachers = getTeachers();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">

    <div class="container">
        <nav class="navbar" style="background-color: #e3f2fd;" data-bs-theme="light">
            <button class="btn btn-sm btn-primary">

                <a href="../students/index.php" class="text-light text-decoration-none">Students</a>
            </button>
            <button class="btn btn-sm btn-primary">

                <a href="../auth/logout.php" class="text-light text-decoration-none">Log Out</a>
            </button>
        </nav>

        <div class="container py-5">
            <h1 class="text-center fw-bold mb-4">Teachers Information</h1>
            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped align-middle bg-white shadow rounded">
                    <thead class="table-dark text-uppercase text-white">
                        <th>SN</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($teachers as $teacher): ?>

                            <tr>
                                <!-- <?php $sn = 1; ?> -->
                                <td><?php echo $count++ ?></td>
                                <td><?php echo $teacher['name'] ?></td>
                                <td><?php echo $teacher['email'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-primary">
                                        <a href="edit.php?updateid=<?php echo $teacher['id'] ?>"
                                            class="text-light text-decoration-none">Update <?php echo $teacher['id'] ?> </a>
                                    </button>

                                    <button class="btn btn-sm btn-danger">
                                        <a href="action/delete.php?deleteid=<?php echo $teacher['id'] ?>"
                                            class="text-light text-decoration-none">Delete <?php echo $teacher['id'] ?></a>

                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>