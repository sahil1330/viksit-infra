<?php
require 'dbconnect.php'; // Include your database connection

// Retrieve form data
$criteria = $_POST['criteria'];
$blog_title = $_POST['blog_title'];
$blog_desc = $_POST['blog_desc'];
$blog_location = $_POST['blog_location'];
$owner = "admin";
$isPublished = 1;

// Handle file upload
$blog_image = '';
if (isset($_FILES['blog-img']) && $_FILES['blog-img']['error'] == 0) {
    $upload_dir = 'assets/images/blog-images/';
    $upload_file = $upload_dir . basename($_FILES['blog-img']['name']);
    
    if (move_uploaded_file($_FILES['blog-img']['tmp_name'], $upload_file)) {
        $blog_image = $_FILES['blog-img']['name'];
    } else {
        echo "File upload failed.";
        exit;
    }
}

// Insert blog into database
$sql = "INSERT INTO blogs (criteria, blog_title, blog_desc, blog_image, isPublished, blog_location, owner) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssiss", $criteria, $blog_title, $blog_desc, $blog_image, $isPublished, $blog_location, $owner);

if ($stmt->execute()) {
    echo "Blog added successfully!";
    header("location: index.html");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
