<?php
require 'db/dbconnect.php'; // Include your database connection

// Check if the request method is POST and document_id is set
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['document_id'])) {
    $document_id = $_POST['document_id'];
    
    // Prepare SQL statement to update verification status
    $sql = "UPDATE documents SET verificationStatus = 'verified', acceptanceMessage = 'Your document has been verified.' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $document_id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect back to the verification page on success
            header('Location: verify_documents.php');
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
