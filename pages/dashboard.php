<?php
session_start();
include '../includes/db.php';

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user blogs
$sql = "SELECT * FROM blogs WHERE user_id = $user_id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Welcome to Your Dashboard</h2>
    <a href="../create_blog.php">➕ Create New Blog</a>
    <a href="../logout.php" style="color: red;">🚪 Logout</a>
    
    <h3>Your Blog Posts</h3>
    
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <h4><?php echo $row['title']; ?></h4>
                    <p><?php echo substr($row['content'], 0, 100) . '...'; ?></p>
                    <a href="../blog.php?id=<?php echo $row['id']; ?>">🔍 View</a>
                    <a href="../edit_blog.php?id=<?php echo $row['id']; ?>">✏ Edit</a>
                    <a href="../delete_blog.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>You have no blog posts yet.</p>
    <?php endif; ?>

</body>
</html>