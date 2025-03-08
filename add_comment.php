<?php
session_start();
include 'db.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to comment.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];
    $comment = trim($_POST['comment']);

    if (empty($comment)) {
        die("Comment cannot be empty.");
    }

    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $user_id, $comment);
    
    if ($stmt->execute()) {
        header("Location: blog.php");
    } else {
        die("Error posting comment.");
    }
}
?>