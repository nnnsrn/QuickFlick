<?php
include 'db.php';

if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $movie_id = $_POST['id'];
    $movie_id_safe = $conn->real_escape_string($movie_id);

    $sql = "DELETE FROM movie WHERE movie_id = $movie_id_safe";

    if ($conn->query($sql)) {
        echo "Movie deleted successfully!";
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
} else {
    echo "Invalid movie ID!";
}
?>
