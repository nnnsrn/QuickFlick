<?php
include 'db.php';

// Check if 'id' exists in POST data
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    // Get the movie ID from the form
    $movie_id = $_POST['id'];

    // Escape the movie ID to prevent SQL injection
    $movie_id_safe = $conn->real_escape_string($movie_id);

    // Prepare SQL query to delete the movie from the database
    $sql = "DELETE FROM movie WHERE movie_id = $movie_id_safe";

    // Execute the query
    if ($conn->query($sql)) {
        echo "Movie deleted successfully!";
        // Redirect to the movies page after deletion
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
} else {
    echo "Invalid movie ID!";
}
?>
