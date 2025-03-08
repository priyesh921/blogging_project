<?php
session_start();
include 'includes/db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$blog_id = $_GET['id'];

// Ensure the logged-in user owns the blog before deleting
$sql = "DELETE FROM blogs WHERE id = $blog_id AND user_id = $user_id";
if ($conn->query($sql) === TRUE) {
    header("Location: pages/dashboard.php");
    exit();
} else {
    echo "Error deleting blog: " . $conn->error;
}
?>