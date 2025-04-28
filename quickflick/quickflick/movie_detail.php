<?php
include 'db.php';

if (isset($_GET['id'])) {
    $movie_id = intval($_GET['id']); 

    $sql = "SELECT title, release_date, budget, revenue, runtime, status, votes_avg, votes_count
            FROM movie
            WHERE movie_id = $movie_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found!";
        exit();
    }

    // Fetch genres
    $genre_sql = "SELECT genre.genre_name
                  FROM genre
                  INNER JOIN movie_genre ON genre.genre_id = movie_genre.genre_id
                  WHERE movie_genre.movie_id = $movie_id";

    $genre_result = $conn->query($genre_sql);

    $genres = [];
    if ($genre_result->num_rows > 0) {
        while ($row = $genre_result->fetch_assoc()) {
            $genres[] = $row['genre_name'];
        }
    }
} else {
    echo "No movie selected!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie Details - <?php echo htmlspecialchars($movie['title']); ?> - QuickFlick</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #f0f2f5;
      color: #333;
    }
    header {
      background-color: #212529;
      padding: 20px 40px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    header h1 {
      margin: 0;
      font-size: 26px;
      color: white;
    }
    nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }
    nav a:hover {
      color: #00bfff;
    }
    main {
      padding: 40px;
      max-width: 800px;
      margin: auto;
    }
    .movie-details {
      background-color: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .movie-details h2 {
      margin-top: 0;
      font-size: 28px;
      color: #007bff;
    }
    .movie-details p {
      font-size: 16px;
      margin: 10px 0;
      line-height: 1.6;
    }
    .movie-details p strong {
      color: #333;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎬 QuickFlick</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="add.php">Add Movie</a>
      <a href="movies.php">View Movies</a>
    </nav>
  </header>

  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
      Thank you for submitting your rating! 🎉
    </div>
  <?php endif; ?>

  <main>
    <section class="movie-details">
      <h2><?php echo htmlspecialchars($movie['title']); ?></h2>
      <?php if (!empty($genres)): ?>
          <p><strong>Genres:</strong> <?php echo htmlspecialchars(implode(', ', $genres)); ?></p>
      <?php endif; ?>
      <p><strong>Release Date:</strong> <?php echo htmlspecialchars($movie['release_date']); ?></p>
      <p><strong>Budget:</strong> $<?php echo number_format($movie['budget']); ?></p>
      <p><strong>Revenue:</strong> $<?php echo number_format($movie['revenue']); ?></p>
      <p><strong>Runtime:</strong> <?php echo htmlspecialchars($movie['runtime']); ?> minutes</p>
      <p><strong>Status:</strong> <?php echo htmlspecialchars($movie['status']); ?></p>
      <p><strong>Average Rating:</strong> <?php echo htmlspecialchars($movie['votes_avg']); ?> / 10</p>
      <p><strong>Total Votes:</strong> <?php echo number_format($movie['votes_count']); ?></p>

      <br><br>
      <a href="movies.php" style="
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
      ">Back to Movies</a>
    </section>

    <hr style="margin: 40px 0;">

    <section class="review-form">
      <h3>Submit Your Rating ⭐</h3>
      <form action="submit_review.php" method="POST">
        <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
    
        <label for="rating">Your Rating (1–10):</label><br>
        <input type="number" id="rating" name="rating" min="1" max="10" step="0.1" required style="margin-top: 8px; padding: 8px; width: 100px;"><br><br>
    
        <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit</button>
      </form>
    </section>

  </main>
</body>
</html>
