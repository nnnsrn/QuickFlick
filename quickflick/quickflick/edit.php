<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM movie WHERE movie_id = $id";
$movie = $conn->query($sql)->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Edit Movie</title></head>
<body>
<h2>Edit Movie</h2>
<form method="post">
    Title: <input type="text" name="title" value="<?= $movie['title'] ?>"><br>
    Release Date: <input type="date" name="release_date" value="<?= $movie['release_date'] ?>"><br>
    Average Vote: <input type="number" step="0.1" name="votes_avg" value="<?= $movie['votes_avg'] ?>"><br>
    <input type="submit" name="submit" value="Update">
</form>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $release = $_POST['release_date'];
    $votes = $_POST['votes_avg'];
    $sql = "UPDATE movie SET title='$title', release_date='$release', votes_avg='$votes' WHERE movie_id=$id";
    if ($conn->query($sql)) echo "Movie updated!";
    else echo "Error: " . $conn->error;
}
?>
<a href="index.php">⬅ Back to list</a>
</body>
</html>