<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Movies - QuickFlick</title>
  <link rel="stylesheet" href="assets/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      margin: 0;
    }
    header {
      background-color: #343a40;
      padding: 20px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 26px;
      color: white; 
    }

    nav a {
      color: white;
      margin-left: 15px;
      text-decoration: none;
    }
    main {
      padding: 20px;
    }
    .movie-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .movie-card {
      background-color: white;
      border: 1px solid #ccc;
      padding: 15px;
      width: 220px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
      border-radius: 8px;
    }
    .movie-card img {
      width: 100%;
      border-radius: 5px;
    }
    .movie-card h3 {
      margin: 10px 0 5px;
      font-size: 18px;
    }
    .movie-card p {
      margin: 5px 0;
    }
    .sort-form {
      margin-bottom: 20px;
    }
    .sort-form select {
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    .sort-form button {
      padding: 8px 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      margin-left: 10px;
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
  <main>
    <h2>All Movies</h2>

    <form method="GET" class="sort-form">
      <label for="sort">Sort by:</label>
      <select name="sort" id="sort">
        <option value="">-- Select --</option>
        <option value="title" <?= (isset($_GET['sort']) && $_GET['sort'] == 'title') ? 'selected' : '' ?>>Title (A-Z)</option>
        <option value="release_year" <?= (isset($_GET['sort']) && $_GET['sort'] == 'release_year') ? 'selected' : '' ?>>Year (Newest)</option>
        <option value="votes_avg" <?= (isset($_GET['sort']) && $_GET['sort'] == 'votes_avg') ? 'selected' : '' ?>>Rating (Highest)</option>
      </select>
      <button type="submit">Apply</button>
    </form>

    <div class="movie-grid">
      <?php
      $sort = $_GET['sort'] ?? '';
      $orderBy = "m.release_date DESC"; // default

      switch ($sort) {
        case 'title':
          $orderBy = "m.title ASC";
          break;
        case 'release_year':
          $orderBy = "YEAR(m.release_date) DESC";
          break;
        case 'votes_avg':
          $orderBy = "m.votes_avg DESC";
          break;
      }

      $sql = "SELECT m.movie_id, m.title, m.release_date, m.votes_avg, m.votes_count, m.poster
              FROM movie m
              ORDER BY $orderBy";

      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='movie-card'>";
          echo "<a href='movie_detail.php?id=" . $row['movie_id'] . "'>";
          if (!empty($row['poster'])) {
            echo "<img src='" . htmlspecialchars($row['poster']) . "' alt='Poster'>";
          }
          echo "<h3>" . htmlspecialchars($row['title']) . "</h3></a>";
          echo "<p><strong>Year:</strong> " . htmlspecialchars(date('Y', strtotime($row['release_date']))) . "</p>";
          echo "<p><strong>Rating:</strong> " . number_format($row['votes_avg'], 1) . "</p>";
          echo "<p><strong>Votes:</strong> " . number_format($row['votes_count']) . "</p>";
          echo "</div>";
        }
      } else {
        echo "<p>No movies found.</p>";
      }            

      $conn->close();
      ?>
    </div>

  </main>
</body>
</html>
