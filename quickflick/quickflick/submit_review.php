<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $movie_id = intval($_POST['movie_id']);
    $rating = floatval($_POST['rating']);

    if ($movie_id > 0 && $rating >= 1 && $rating <= 10) {
        $sql = "SELECT votes_avg, votes_count FROM movie WHERE movie_id = $movie_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $movie = $result->fetch_assoc();

            $current_avg = $movie['votes_avg'];
            $current_count = $movie['votes_count'];
            $new_count = $current_count + 1;
            $new_avg = (($current_avg * $current_count) + $rating) / $new_count;

            $update_sql = "UPDATE movie 
                           SET votes_avg = $new_avg, votes_count = $new_count 
                           WHERE movie_id = $movie_id";
            if ($conn->query($update_sql) === TRUE) {
                header("Location: movie_detail.php?id=$movie_id&success=1");
                exit();
            } else {
                echo "Error updating rating: " . $conn->error;
            }
        } else {
            echo "Movie not found!";
        }
    } else {
        echo "Invalid input!";
    }
} else {
    echo "Invalid request!";
}
?>
