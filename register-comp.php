<?php
// try {
$showAlert = false;
$showError = false;
if (isset($_POST['register-comp'])) {
    require 'db/dbconnect.php';
    $company_name = $_POST['company_name'];
    $company_username = $_POST['company_username'];
    $company_email = $_POST['email'];
    $company_pan = $_POST['b_pan'];
    if (isset($_FILES['fin_record']) && isset($_FILES['tech_record'])) {
        $fin_record = isset($_FILES['fin_record']) ? $_FILES['fin_record'] : null;
        $tech_record = $_FILES['tech_record'] ?? null;
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = "company";
        $company_marks = 0;
        $fin_record = $_FILES['fin_record']['name'];
        $fin_record_temp = $_FILES['fin_record']['tmp_name'];
        $fin_record_size = $_FILES['fin_record']['size'];
        $fin_record_error = $_FILES['fin_record']['error'];
        $fin_record_type = $_FILES['fin_record']['type'];
        $fin_record_ext = explode('.', $fin_record);
        $fin_record_actual_ext = strtolower(end($fin_record_ext));
        $tech_record = $_FILES['tech_record']['name'];
        $tech_record_temp = $_FILES['tech_record']['tmp_name'];
        $tech_record_size = $_FILES['tech_record']['size'];
        $tech_record_error = $_FILES['tech_record']['error'];
        $tech_record_type = $_FILES['tech_record']['type'];
        $tech_record_ext = explode('.', $tech_record);
        $tech_record_actual_ext = strtolower(end($tech_record_ext));
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf');
        if (in_array($fin_record_actual_ext, $allowed_extensions) && in_array($tech_record_actual_ext, $allowed_extensions)) {
            if ($fin_record_error === 0 && $tech_record_error === 0) {
                if ($fin_record_size < 10000000 && $tech_record_size < 10000000) {
                    $fin_record_name_new = $company_username . "-financial-records." . $fin_record_actual_ext;
                    $fin_record_destination = 'assets/documents/project-documents/' . $fin_record_name_new;
                    move_uploaded_file($fin_record_temp, $fin_record_destination);
                    $tech_record_name_new = $company_username . "-technical-records." . $tech_record_actual_ext;
                    $tech_record_destination = 'assets/documents/project-documents/' . $tech_record_name_new;
                    move_uploaded_file($tech_record_temp, $tech_record_destination);
                    $sql = "INSERT INTO users (username, displayName, role, email, password, pancard, fin_record, tech_record, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
                    $documentsSql = "INSERT INTO documents(owner, pastProjectsDocuments, verificationStatus, createdAt) VALUES (?, ?, 'pending', current_timestamp())";
                    $stmt = $conn->prepare($sql);
                    $documentsStmt = $conn->prepare($documentsSql);
                    if ($stmt && $documentsStmt) {
                        $stmt->bind_param("ssssssss", $company_username, $company_name, $role, $company_email, $hashedPassword, $company_pan, $fin_record_name_new, $tech_record_name_new);
                        $documentsStmt->bind_param("ss", $company_username, json_encode([$fin_record_name_new, $tech_record_name_new]));
                        if ($stmt->execute() && $documentsStmt->execute()) {
                            $showAlert = "New record created successfully";
                            session_start();
                            $_SESSION["companyloggedin"] = true;
                            $_SESSION['username'] = $company_username;
                            $_SESSION['Name'] = $company_name;
                            $_SESSION['role'] = $role;
                            $_SESSION['email'] = $company_email;
                            $_SESSION['company_marks'] = $company_marks;
                            header('location: index.php');
                        } else {
                            $showError = "Error: " . $stmt->error;
                        }
                        $stmt->close();
                        $documentsStmt->close();
                    } else {
                        $showError = "Error preparing statement: " . $conn->error;
                    }
                } else {
                    $showError = "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                $showError = "File size too large";
            }
        } else {
            $showError = "Error uploading file";
        }
    }
}


// } catch (\Throwable $th) {
//     // error message to be logged
//     $error_message = "Error in login-critic.php - " . $th->getMessage();

//     // path of the log file where errors need to be logged
//     $log_file = "./my-errors.log";

//     // logging error message to given log file
//     error_log($error_message, 3, $log_file);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php include 'components/navbar.php'; ?>
    <?php
    if ($showAlert) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $showAlert; ?>
        </div><?php
    }
    if ($showError) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $showError; ?>
        </div> <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center">Register as a Company</h1>
                <form action="" method="POST" enctype="multipart/form-data">
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