<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    die("Please login first");
}

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        echo "All fields required";
    } else {
        $sql = "INSERT INTO posts (title, content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            header("Location: posts.php");
            exit();
        } else {
            echo "Post not added";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>
</head>
<body>

<h2>Add New Post</h2>

<form method="post">
    <input type="text" name="title" placeholder="Post title"><br><br>
    <textarea name="content" placeholder="Post content"></textarea><br><br>
    <button type="submit" name="submit">Add Post</button>
</form>

</body>
</html>