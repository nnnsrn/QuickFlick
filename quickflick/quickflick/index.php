<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QuickFlick</title>
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
    }
    section {
      margin-bottom: 50px;
    }
    h2 {
      font-size: 24px;
      margin-bottom: 10px;
      color: #212529;
    }
    .movie-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 24px;
    }
    .movie-card {
      background-color: #fff;
      border: none;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .movie-card:hover {
      transform: scale(1.02);
    }
    .movie-card img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .movie-card h3 {
      margin: 0;
      font-size: 18px;
      color: #007bff;
    }
    .movie-card p {
      margin: 5px 0;
      font-size: 14px;
      color: #555;
    }
    .movie-card a {
      text-decoration: none;
    }
    form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 30px;
    }
    form input[type="text"] {
      flex: 1;
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    form button {
      padding: 10px 18px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    form button:hover {
      background-color: #0056b3;
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
    <section>
      <h2>Welcome to QuickFlick!</h2>
      <p>This is a simple PHP-based movie database app. Use the navigation above to get started.</p>
    </section>

    <section>
      <h2>Movie List</h2>

      <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search movies..." 
          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit">Search</button>
      </form>

      <div class="movie-grid">
        <?php
        $search = $_GET['search'] ?? '';
        $searchSafe = $conn->real_escape_string($search);
        $sql = "SELECT movie_id, title, release_date, votes_avg, votes_count, poster 
                FROM movie 
                WHERE title LIKE '%$searchSafe%' 
                ORDER BY release_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<div class='movie-card'>";
        
            // 🔽 Poster logic: use fallback if NULL or empty
            $posterSrc = isset($row['poster']) && !empty($row['poster']) 
              ? htmlspecialchars($row['poster']) 
              : 'https://via.placeholder.com/300x450?text=No+Image';
            
            echo "<a href='movie_detail.php?id=" . $row['movie_id'] . "'>";
            echo "<img src='" . $posterSrc . "' alt='Poster' style='width:100%; height:auto; border-radius:8px; margin-bottom:10px;'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "</a>";
        
            echo "<p><strong>Release:</strong> " . htmlspecialchars($row['release_date']) . "</p>";
            echo "<p><strong>Rating:</strong> " . number_format($row['votes_avg'], 1) . "</p>";
            echo "<p><strong>Votes:</strong> " . number_format($row['votes_count']) . "</p>";
        
            
            echo "<input type='hidden' name='id' value='" . $row['movie_id'] . "'>";
            
            echo "</form>";
        
            echo "</div>";
          }
        } else {
          echo "<p>No movies found.</p>";        
        }
        ?>
      </div>
    </section>  
  </main>
</body>
</html>
