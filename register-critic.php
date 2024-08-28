<?php
if (isset($_POST['register-critic'])) {
    try {
        require "db/dbconnect.php";
        $username = $_POST['username'];
        $displayName = $_POST['displayName'];
        $aadhar = $_POST['aadhar'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $role = "critic";
        $critic_score = 0;
        if ($password == $confirm_password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, displayName, role, aadharCard, email, password, critic_score, createdAt) VALUES ('$username', '$displayName', '$role', '$aadhar', '$email', '$hashedPassword', '$critic_score', current_time)";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION['username'] = $username;
                $_SESSION['Name'] = $displayName;
                $_SESSION['role'] = $role;
                $_SESSION['critic-score'] = $critic_score;
                $_SESSION['email'] = $email;
                header('location: index.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Passwords do not match";
        }
    } catch (\Throwable $th) {
        // error message to be logged
        $error_message = "Error in register-critic.php - " . $th->getMessage();

        // path of the log file where errors need to be logged
        $log_file = "./my-errors.log";

        // logging error message to given log file
        error_log($error_message, 3, $log_file);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="text-center my-4">Register as Critic</h1>
    <form action="" class="col-8 mx-auto" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Create username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="displayName" name="displayName" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Your Aadhar</label>
            <input type="text" class="form-control" id="aadhar" name="aadhar" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary" name="register-critic">Register</button>
    </form>
    <h5>Already registered? <a href="login-critic.php">Login Now</a></h5>
</body>

</html>