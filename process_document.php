<?php
require 'db/dbconnect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $projectName = $_POST['projectName'];
    $deadline = $_POST['deadline'];
    $bid = $_POST['bid'];
    $bidValidFrom = $_POST['bidValidFrom'];
    $bidExpireAt = $_POST['bidExpireAt'];

    // Handle file upload
    $targetDir = "uploads/";
    $fileName = basename($_FILES["projectDetails"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if file is a PDF
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["projectDetails"]["tmp_name"], $targetFilePath)) {
        // Insert new project into the database
        $sql = "INSERT INTO projects (projectName, projectDetails, deadline, bid, bidValidFrom, bidExpireAt) 
                VALUES ('$projectName', '$targetFilePath', '$deadline', '$bid', '$bidValidFrom', '$bidExpireAt')";

        if ($conn->query($sql) === TRUE) {
            // Notify all users
            notifyUsers($bid);

            echo "BID launched successfully and notifications sent.";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

function notifyUsers($bid) {
    global $conn;
    
    // Fetch user emails from the database
    $sql = "SELECT email FROM users"; // Assuming a table 'users' with an 'email' field
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row['email'];
            $subject = "New BID Launched";
            $message = "A new BID has been launched. BID Details: $bid";
            $headers = "From: no-reply@yourdomain.com";

            // Send email notification
            mail($email, $subject, $message, $headers);
        }
    }
}
?>
