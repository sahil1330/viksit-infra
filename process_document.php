<?php
require 'db/dbconnect.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $projectName = $_POST['projectName'];
    $deadline = $_POST['deadline'];
    $bid = $_POST['bid'];
    $bidValidFrom = $_POST['bidValidFrom'];
    $bidExpireAt = $_POST['bidExpireAt'];

    
    $projectDetails = $_FILES["projectDetails"]["name"];
    $projectDetailsTmp = $_FILES["projectDetails"]["tmp_name"];
    $projectDetailsSize = $_FILES["projectDetails"]["size"];
    $projectDetailsError = $_FILES["projectDetails"]["error"];
    $projectDetailsType = $_FILES["projectDetails"]["type"];
    $projectDetails_ext = explode('.', $projectDetails);
    $projectDetails_actual_ext = strtolower(end($projectDetails_ext));
    if ($projectDetails_actual_ext == "pdf") {
        if ($projectDetailsError === 0) {
            if ($projectDetailsSize < 10000000) {
                $projectDetails_name_new = $projectName . "-project-file" . $projectDetails_actual_ext;
                $projectDetails_destination = 'assets/documents/project-documents/' . $projectDetails_name_new;
                move_uploaded_file($projectDetailsTmp, $projectDetails_destination);
                $sql = "INSERT INTO projects (projectName, projectDetails, deadline, bid, bidValidFrom, bidExpireAt) 
                VALUES ('$projectName', '$targetFilePath', '$deadline', '$bid', '$bidValidFrom', '$bidExpireAt')";
                if ($conn->query($sql) === TRUE) {
                    echo "BID launched successfully and notifications sent.";
                    header("location: comp_dash.php");
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "File size too large.";
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "Sorry, Only pdf files are allowed";
    }
}

function notifyUsers($bid)
{
    global $conn;

    // Fetch user emails from the database
    $sql = "SELECT email FROM users"; // Assuming a table 'users' with an 'email' field
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $email = $row['email'];
            $subject = "New BID Launched";
            $message = "A new BID has been launched. BID Details: $bid";
            $headers = "From: sahilmane025@gmail.com";

            // Send email notification
            mail($email, $subject, $message, $headers);
        }
    }
}
?>