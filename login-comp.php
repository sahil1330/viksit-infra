<?php
try {
    if (isset($_POST['login-comp'])) {
        require 'db/dbconnect.php';
        $user = $_POST['user'];
        $password = $_POST['password'];

        // Query to fetch the user details
        $sql = "SELECT * FROM users WHERE username='$user' OR email='$user' OR pancard='$user'";
        $result = $conn->query($sql);

        // Check if exactly one user found
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                session_start();

                // Set session variables using the data from the database
                $_SESSION["companyloggedin"] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['Name'] = $row['Name']; // Assuming 'Name' is a column in your table
                $_SESSION['role'] = $row['role']; // Assuming 'role' is a column in your table
                $_SESSION['email'] = $row['email'];
                $_SESSION['company_marks'] = $row['company_marks']; // Assuming 'company_marks' is a column in your table

                // Redirect to the index page
                header('location: index.php');
                exit();
            } else {
                echo "Invalid credentials";
            }
        } else {
            echo "Invalid credentials";
        }
    }
} catch (\Throwable $th) {
    // Log error message to file
    $error_message = "Error in login-critic.php - " . $th->getMessage();
    $log_file = "./my-errors.log";
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
                <form action="login-comp.php" method="POST">
                    <div class="mb-3">
                        <label for="user" class="form-label">Email address or username or Pan</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login-comp">Login</button>
                </form>
            </div>
        </div>
    </div>
    <div class="register-critic">
        <h4 class="text-center">New Company? <a href="register-comp.php">Signup Now</a></h4>
    </div>
</body>

</html>