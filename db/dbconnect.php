<?php
require '../.private/config.php';
$servername = DB_SERVERNAME;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("" . $conn->connect_error);
} else {
    echo "Connected";
}
?>