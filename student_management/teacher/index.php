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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0eafc 100%);
            min-height: 100vh;
        }
        .card {
            transition: box-shadow 0.3s;
        }
        .card:hover {
            box-shadow: 0 0 32px 0 rgba(0,0,0,0.10);
        }
        .table thead th {
            letter-spacing: 1px;
        }
        .btn-outline-primary, .btn-outline-danger {
            transition: background 0.2s, color 0.2s;
        }
        .btn-outline-primary:hover, .btn-outline-danger:hover {
            color: #fff !important;
        }
    </style>
</head>

<body class="bg-light text-dark">

    <div class="container">
        <!-- Beautiful Bootstrap Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary rounded shadow my-4">
            <div class="container-fluid">
                <a class="navbar-brand text-white fw-bold" href="#">Student Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-2">
                            <a class="nav-link text-white" href="../students/index.php">
                                <i class="bi bi-people-fill"></i> Students
                            </a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link text-white" href="../auth/logout.php">
                                <i class="bi bi-box-arrow-right"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4" style="background: #f8fafc;">
                        <div class="card-header bg-white border-0 rounded-top-4 text-center">
                            <h1 class="fw-bold mb-0 text-primary">
                                <i class="bi bi-person-badge"></i> Teachers Information
                            </h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle bg-white rounded shadow-sm overflow-hidden">
                                    <thead class="table-light text-uppercase">
                                        <tr>
                                            <th scope="col">SN</th>
                                            <th scope="col"><i class="bi bi-person"></i> Name</th>
                                            <th scope="col"><i class="bi bi-envelope"></i> Email</th>
                                            <th scope="col" class="text-center"><i class="bi bi-gear"></i> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach ($teachers as $teacher): ?>
                                            <tr>
                                                <td class="fw-bold"><?php echo $count++ ?></td>
                                                <td><?php echo htmlspecialchars($teacher['name']) ?></td>
                                                <td><?php echo htmlspecialchars($teacher['email']) ?></td>
                                                <td class="text-center">
                                                    <a href="edit.php?updateid=<?php echo $teacher['id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill me-2">
                                                        <i class="bi bi-pencil-square"></i> Update
                                                    </a>
                                                    <a href="action/delete.php?deleteid=<?php echo $teacher['id'] ?>" class="btn btn-outline-danger btn-sm rounded-pill"
                                                       onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if (empty($teachers)): ?>
                                    <div class="alert alert-warning text-center mt-4 rounded-pill shadow-sm">
                                        <i class="bi bi-exclamation-circle"></i> No teachers found.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>