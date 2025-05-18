<?php

require_once __DIR__ . '/../helpers/students.php';
require_once __DIR__ . '/../core/auth.php';

if (!isLoggedIn()) {
  $_SESSION['error'] = "You must be logged in to access this page";
  redirectToLogin();
}

$students = getStudents();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crud Operation</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light text-dark">
  <div class="container">

    <nav class="navbar" style="background-color: #e3f2fd;" data-bs-theme="light">

      <button class="btn btn-sm btn-primary">
        <a href="create.php" class="text-light text-decoration-none">Add student</a>
      </button>

      <button class="btn btn-sm btn-primary">

        <a href="../teacher/index.php" class="text-light text-decoration-none">Teachers</a>
      </button>

    </nav>

    <div class="container py-5">
      <h1 class="text-center fw-bold mb-4">Student Information</h1>
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped align-middle bg-white shadow rounded">
          <thead class="table-dark text-uppercase text-white">
            <tr>
              <th>SN</th>
              <th>Profile</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php $sn = 1;
            foreach ($students as $student): ?>
              <tr>
                <td><?php echo $sn = $sn++ ?></td>
                <td> <img width="50" height="50" src="<?php echo '../uploads/' . $student['profile']  ?>" alt="Profile"></td>
                <td><?php echo $student['name'] ?></td>
                <td><?php echo $student['email'] ?></td>
                <td>
                  <button class="btn btn-sm btn-primary">
                    <a href="edit.php?updateid=<?php echo $student['id'] ?>"
                      class="text-light text-decoration-none">Update </a>
                  </button>

                  <button class="btn btn-sm btn-danger">
                    <a href="action/delete.php?deleteid=<?php echo $student['id'] ?>"
                      class="text-light text-decoration-none">Delete</a>

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