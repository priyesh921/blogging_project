<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO blogs (user_id, title, content, image) VALUES ('$user_id', '$title', '$content', '$image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: pages/dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<link rel="stylesheet" href="css/style.css">
<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" placeholder="Content" required></textarea>
    <input type="file" name="image" required>
    <button type="submit">Post</button>
</form>
