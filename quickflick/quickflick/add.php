<?php
include 'db.php';

// Fetch all studios for dropdown
$studioQuery = "SELECT studio_id, studio_name FROM studio";
$studioResult = $conn->query($studioQuery);

$posterPath = null;

if (isset($_FILES['poster']) && $_FILES['poster']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['poster']['tmp_name'];
    $fileName = basename($_FILES['poster']['name']);
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    if (in_array($fileExtension, $allowedExtensions)) {
        $newFileName = uniqid('poster_', true) . '.' . $fileExtension;
        $uploadDir = 'uploads/';
        $destPath = $uploadDir . $newFileName;

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        move_uploaded_file($fileTmpPath, $destPath);
        $posterPath = $destPath;
    } else {
        echo "Invalid file type. Only JPG and PNG are allowed.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $release_date = $_POST['release_date'];
    $votes_avg = floatval($_POST['votes_avg']);
    $votes_count = intval($_POST['votes_count']);
    $budget = intval($_POST['budget']);
    $revenue = intval($_POST['revenue']);
    $runtime = intval($_POST['runtime']);
    $status = $conn->real_escape_string($_POST['status']);
    $studio_id = intval($_POST['studio_id']);

    $sql = "INSERT INTO movie (title, budget, release_date, revenue, runtime, status, votes_avg, votes_count, poster, studio_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisiiidsis", $title, $budget, $release_date, $revenue, $runtime, $status, $votes_avg, $votes_count, $posterPath, $studio_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Movie - QuickFlick</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: #343a40;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        header h1 {
            margin: 0;
            font-size: 26px;
        }
        nav a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        main {
            padding: 40px 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        form h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #343a40;
        }
        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            margin-top: 25px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
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
    <form action="add.php" method="post" enctype="multipart/form-data">
        <h2>Add a New Movie</h2>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="release_date">Release Date</label>
        <input type="date" name="release_date" id="release_date" required>

        <label for="votes_avg">Average Rating</label>
        <input type="number" step="0.1" name="votes_avg" id="votes_avg" required>

        <label for="votes_count">Vote Count</label>
        <input type="number" name="votes_count" id="votes_count" required>

        <label for="poster">Movie Poster (JPG or PNG)</label>
        <input type="file" name="poster" id="poster" accept=".jpg,.jpeg,.png" required>

        <label for="budget">Budget</label>
        <input type="number" name="budget" id="budget" required>

        <label for="revenue">Revenue</label>
        <input type="number" name="revenue" id="revenue" required>

        <label for="runtime">Runtime (in minutes)</label>
        <input type="number" name="runtime" id="runtime" required>

        <label for="status">Status</label>
        <input type="text" name="status" id="status" required>

        <label for="studio">Studio</label>
        <select name="studio_id" id="studio" required>
            <option value="">-- Select Studio --</option>
            <?php while ($studio = $studioResult->fetch_assoc()): ?>
                <option value="<?php echo $studio['studio_id']; ?>">
                    <?php echo htmlspecialchars($studio['studio_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Genres:</label><br>
        <input type="checkbox" name="genres[]" value="1"> Action<br>
        <input type="checkbox" name="genres[]" value="2"> Comedy<br>
        <input type="checkbox" name="genres[]" value="3"> Drama<br>
        <input type="checkbox" name="genres[]" value="4"> Adventure<br>
        <input type="checkbox" name="genres[]" value="5"> Sci-Fi<br>
        <input type="checkbox" name="genres[]" value="6"> Horror<br>
        <input type="checkbox" name="genres[]" value="7"> Romance<br>

        <button type="submit">Add Movie</button>
    </form>
</main>
</body>
</html>
