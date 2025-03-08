<?php
include 'includes/db.php';
$keyword = $_GET['keyword'];
$result = $conn->query("SELECT * FROM blogs WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'");

while ($row = $result->fetch_assoc()) {
    echo "<h2><a href='blog.php?id=" . $row['id'] . "'>" . $row['title'] . "</a></h2>";
}
?>
<link rel="stylesheet" href="css/style.css">
<form method="get">
    <input type="text" name="keyword" placeholder="Search blogs...">
    <button type="submit">Search</button>
</form>
