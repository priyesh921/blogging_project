<?php
include 'includes/db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM blogs WHERE id=$id");
$blog = $result->fetch_assoc();
?>

<h2><?php echo $blog['title']; ?></h2>
<img src="uploads/<?php echo $blog['image']; ?>" width="300">
<p><?php echo $blog['content']; ?></p>
