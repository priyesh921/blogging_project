<?php
session_start();
include 'includes/db.php'; // Database connection

// Get blog ID from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid blog post.");
}
$blog_id = intval($_GET['id']);

// Fetch blog post
$stmt = $conn->prepare("SELECT blogs.*, users.username FROM blogs JOIN users ON blogs.user_id = users.id WHERE blogs.id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Blog post not found.");
}
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p><i>By <?php echo htmlspecialchars($post['username']); ?></i></p>
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

    <hr>

    <!-- Fetch comments for this post -->
    <?php
    $comments_query = $conn->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.user_id = ? ORDER BY comments.created_at DESC");
    $comments_query->bind_param("i", $blog_id);
    $comments_query->execute();
    $comments = $comments_query->get_result();
    ?>

    <h4>Comments</h4>
    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="add_comment.php" method="POST">
            <input type="hidden" name="post_id" value="<?php echo $blog_id; ?>">
            <textarea name="comment" required placeholder="Write a comment..."></textarea>
            <button type="submit">Post Comment</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Log in</a> to comment.</p>
    <?php endif; ?>

    <ul>
        <?php while ($comment = $comments->fetch_assoc()): ?>
            <li>
                <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                <small><?php echo $comment['created_at']; ?></small>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

</body>
</html>
