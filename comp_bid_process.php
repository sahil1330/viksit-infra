<?php
// Include your database connection script
include 'db/dbconnect.php'; // Adjust this path if your connection file is in a different directory

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $project_id = $_POST['project_id'];
    $bidderName = $_POST['bidderName'];
    $bidAmount = $_POST['bidamt'];
    $bidderNextAudit = $_POST['bidderNextAudit'];

    // Handle file uploads
    $uploadDir = 'assets/documents/project-documents/'; // Directory where files will be uploaded
    $bidderBudget = $uploadDir . basename($_FILES['bidderBudget']['name']);
    $bidderTechnicalData = $uploadDir . basename($_FILES['bidderTechnicalData']['name']);

    // Move uploaded files to the designated directory
    if (move_uploaded_file($_FILES['bidderBudget']['tmp_name'], $bidderBudget) && move_uploaded_file($_FILES['bidderTechnicalData']['tmp_name'], $bidderTechnicalData)) {
        // Files uploaded successfully, proceed to database insertion

        // Prepare SQL statement
        $sql = "INSERT INTO bids (project_id, bidderName, bidAmount, bidderBudget, bidderTechnicalData, bidderNextAudit, bidderVerifyingStatus, bidderVerifyingComments)
                VALUES (?, ?, ?, ?, ?, ?, 'Pending', 'Pending')";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("isisss", $project_id, $bidderName, $bidAmount, $bidderBudget, $bidderTechnicalData, $bidderNextAudit);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Bid submitted successfully!";
                header("location: comp_dash.php");
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading files.";
    }
}

// Close the database connection
$conn->close();
?>
