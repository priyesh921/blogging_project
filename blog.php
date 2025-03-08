<?php
session_start();
include 'includes/db.php'; // Database connection

// Fetch all blog posts
$query = "SELECT blogs.*, users.username FROM blogs JOIN users ON blogs.user_id = users.id ORDER BY blogs.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h2>Latest Blogs</h2>

    <?php while ($post = $result->fetch_assoc()): ?>
        <div class="blog-post">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><i>By <?php echo htmlspecialchars($post['username']); ?></i></p>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

            <hr>

            <!-- Fetch comments for this post -->
            <?php
            $post_id = $post['id'];
            $comments_query = $conn->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.user_id = ? ORDER BY comments.created_at DESC");
            $comments_query->bind_param("i", $post_id);
            $comments_query->execute();
            $comments = $comments_query->get_result();
            ?>

            <h4>Comments</h4>
            <?php if (isset($_SESSION['user_id'])): ?>
                <form action="add_comment.php" method="POST">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
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
    <?php endwhile; ?>
</div>

</body>
</html>