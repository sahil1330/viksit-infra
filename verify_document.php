<?php
require 'db/dbconnect.php'; // Include your database connection

// Check if the request method is POST and document_id is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['marks_submit'])) {
    $document_id = $_POST['document_id'];
    $action = $_POST['action'];
    $comment = $_POST['comment'];
    $marks = $_POST['marks'];
    $verificationStatus = false;
    $ownerSql = "Select owner from documents where id='$document_id'";
    $owner = mysqli_query($conn, $ownerSql);
    if ($owner) {
        $row = mysqli_fetch_assoc($owner);
        $owner = $row['owner'];
        $updatesql = "UPDATE users SET marks = '$marks' WHERE username = '$owner'";
        if (mysqli_query($conn, $updatesql)) {
            echo "Update successful";
        } else {
            // Display error message if update fails
            echo "Error updating marks: " . mysqli_error($conn);
        }
    } else {
        // Display error message if owner not found
        echo "Owner not found.";
    }
    $sql = "";
    if ($action == "verify") {
        // Prepare SQL statement to update verification status
        $sql = "UPDATE documents SET verificationStatus = 'verified', acceptanceMessage = '$comment' WHERE id = ?";
    } else {
        // Prepare SQL statement to update verification status
        $sql = "UPDATE documents SET verificationStatus = 'rejected', rejectionMessage = '$comment' WHERE id = ?";
    }
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $document_id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the verification page on success
            header('Location: gov-dash.php');
            exit();
        } else {
            // Display error message if the statement execution fails
            echo "Error updating record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display error message if preparing the statement fails
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Display error message for invalid request
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>