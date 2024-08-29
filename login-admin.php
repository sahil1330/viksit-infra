<?php

if (isset($_POST['login-admin'])) {
    require 'db/dbconnect.php';
    $user = $_POST['user'];
    $password = $_POST['password'];
    if ($user == "admin" && $password == "admin") {
        session_start();
        $_SESSION['adminloggedin'] = true;
        $_SESSION['Name'] = "admin";
        $_SESSION['role'] = "admin";
        header('location: gov-dash.php');
    } else {
        echo "Invalid password";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <div class="decide">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Login</h1>
                <form action="login-admin.php" method="POST">
                    <div class="mb-3">
                        <label for="user" class="form-label">username</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login-admin">Login</button>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>