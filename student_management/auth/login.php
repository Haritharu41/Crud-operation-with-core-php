<?php


session_start();
$passwordErr=$_SESSION['errors']['password'];
$emailErr=$_SESSION['errors']['email'];
unset($_SESSION['errors']);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud Operation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body class="bg-light text-dark">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded">
                    <div class="card-body">
                        <cher class="text-center fw-bold mb-4">Login as a Teacher</h3>
                            <form method="post" action="action/process-login.php">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter your Email"
                                        autocomplete="off" />

                                        <small class="text-danger"><?php echo $emailErr; ?></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter your Password"
                                        autocomplete="off" />
                                        <small class="text-danger"><?php echo $passwordErr; ?></small>

                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>">

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-4" name="submit">Log In</button>
                                </div>
                            </form>

                            <p>Don't have an account? <a href="register.php">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>


</html>