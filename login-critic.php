<?php
try {
    //code...

    if (isset($_POST['login-critic'])) {
        require 'db/dbconnect.php';
        $user = $_POST['user'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username='$user' OR email='$user'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['criticloggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['Name'] = $row['displayName'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['critic-score'] = $row['critic_score'];
                $_SESSION['email'] = $row['email'];
                header('location: index.php');
            } else {
                echo "Invalid password";
            }
        } else {
            echo "User not found";
        }
    }
} catch (\Throwable $th) {
    //throw $th;
    // error message to be logged
    $error_message = "Error in login-critic.php - " . $th->getMessage();

    // path of the log file where errors need to be logged
    $log_file = "./my-errors.log";

    // logging error message to given log file
    error_log($error_message, 3, $log_file);
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
                <form action="login-critic.php" method="POST">
                    <div class="mb-3">
                        <label for="user" class="form-label">Email address or username</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login-critic">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>