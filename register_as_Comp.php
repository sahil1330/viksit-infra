<?php
if(isset($_POST['register-comp'])){
    require 'db/dbconnect.php';
    $company_name = $_POST['company_name'];
    $company_username = $_POST['company_username'];
    $company_email = $_POST['email'];
    $company_pan = $_POST['b_pan'];
    $fin_record = $_FILES['fin_record'];
    $tech_record = $_FILES['tech_record'];
    $password = $_POST['password'];
    $role = "company";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php include 'components/navbar.php'; ?>
    <div class="decide">
        
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Register as a Company</h1>
                <form action="login.php" method="POST">
                <div class="mb-3">
                        <label for="company_name" class="form-label">Company's Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_username" class="form-label">Company's username</label>
                        <input type="text" class="form-control" id="company_username" name="company_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="b_pan" class="form-label">Business PAN No </label>
                        <input type="text" class="form-control" id="b_pan" name="b_pan" required>
                    </div>
                    <div class="mb-3">
                        <label for="fin_record" class="form-label">Financial Records of the Company</label>
                        <input type="file" class="form-control" id="fin_record" name="fin_record" required>
                    </div>
                    <div class="mb-3">
                        <label for="tech_record" class="form-label">Technical Records of the Company</label>
                        <input type="file" class="form-control" id="tech_record" name="tech_record" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register-comp">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>