<?php
session_start();
include 'includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$blog_id = $_GET['id'];

// Fetch blog details
$sql = "SELECT * FROM blogs WHERE id = $blog_id AND user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Unauthorized access!";
    exit();
}

$blog = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE blogs SET title='$title', content='$content', image='$image' WHERE id=$blog_id AND user_id=$user_id";
    } else {
        $sql = "UPDATE blogs SET title='$title', content='$content' WHERE id=$blog_id AND user_id=$user_id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: pages/dashboard.php");
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }
}
?>
<link rel="stylesheet" href="css/style.css">
<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" value="<?php echo $blog['title']; ?>" required>
    <textarea name="content" required><?php echo $blog['content']; ?></textarea>
    <input type="file" name="image">
    <button type="submit">Update Blog</button>
</form>
<a href="pages/dashboard.php">Back to Dashboard</a>