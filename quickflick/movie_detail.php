<?php
include 'db.php';

if (!isset($_GET['id'])) {
    echo "No movie selected.";
    exit();
}

$movie_id = intval($_GET['id']);

$query = "
    SELECT 
        movie.*, 
        studio.studio_name, 
        studio.studio_location
    FROM 
        movie
    LEFT JOIN 
        studio ON movie.studio_id = studio.studio_id
    WHERE 
        movie.movie_id = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();

if (!$movie) {
    echo "Movie not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Movie Detail - QuickFlick</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #343a40;
      color: white;
      padding: 20px;
      text-align: center;
    }
    main {
      padding: 30px;
    }
    .movie-detail {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .movie-poster {
      text-align: center;
      margin-bottom: 20px;
    }
    .movie-poster img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .info {
      line-height: 1.8;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 30px;
      color: #007bff;
      text-decoration: none;
    }
    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header>
  <h1>🎬 QuickFlick</h1>
</header>

<main>
  <?php
  if (isset($_GET['success']) && $_GET['success'] == 1) 
  {
      echo '<div style="background-color: #d4edda; color: #155724; padding: 10px; margin: 20px auto; max-width: 800px; border: 1px solid #c3e6cb; border-radius: 5px; text-align: center;">
            Thank you for voting!
            </div>';
  }
  ?>

  <div class="movie-detail">
    <div class="movie-poster">
      <?php if (!empty($movie['poster'])): ?>
        <img src="<?php echo htmlspecialchars($movie['poster']); ?>" alt="Movie Poster">
      <?php else: ?>
        <p>No poster available.</p>
      <?php endif; ?>
    </div>

    <h2><?php echo htmlspecialchars($movie['title']); ?></h2>

    <div class="info">
      <p><strong>Release Date:</strong> <?php echo htmlspecialchars($movie['release_date']); ?></p>
      <p><strong>Budget:</strong> $<?php echo number_format($movie['budget']); ?></p>
      <p><strong>Revenue:</strong> $<?php echo number_format($movie['revenue']); ?></p>
      <p><strong>Runtime:</strong> <?php echo htmlspecialchars($movie['runtime']); ?> minutes</p>
      <p><strong>Status:</strong> <?php echo htmlspecialchars($movie['status']); ?></p>
      <p><strong>Average Votes:</strong> <?php echo htmlspecialchars($movie['votes_avg']); ?></p>
      <p><strong>Votes Count:</strong> <?php echo htmlspecialchars($movie['votes_count']); ?></p>
      <?php if (!empty($movie['studio_name'])): ?>
        <p><strong>Studio:</strong> <?php echo htmlspecialchars($movie['studio_name']); ?> (<?php echo htmlspecialchars($movie['studio_location']); ?>)</p>
      <?php endif; ?>
    </div>

    <hr style="margin: 30px 0;">

    <div style="text-align: center; margin-top: 20px;">
      <h3>Rate this Movie</h3>
      <form action="submit_review.php" method="POST" style="margin-top: 10px;">
        <input type="hidden" name="movie_id" value="<?php echo $movie_id; ?>">
        <select name="rating" required style="padding: 8px 12px; border-radius: 5px; border: 1px solid #ccc;">
        <option value="">Select rating</option>
        <?php for ($i = 1; $i <= 10; $i++): ?>
          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php endfor; ?>
        </select>
        <button type="submit" style="padding: 8px 15px; margin-left: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit
        </button>
      </form>
    </div>


    <a href="movies.php" class="back-link">← Back to Movies</a>
  </div>
</main>

</body>
</html>
