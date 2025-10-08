<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_POST) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $duration_minutes = $_POST['duration_minutes'];

    if ($title && $director && $release_year) {
        try {
            $stmt = $mysqli->prepare("INSERT INTO movies (title, description, release_year, genre, director, duration_minutes) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissi", $title, $description, $release_year, $genre, $director, $duration_minutes);
            $stmt->execute();
            $success = "Movie added successfully!";
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $error = "Error adding movie: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Add New Movie</h1>
            <nav>
                <a href="index.php" class="btn">Back to Movies</a>
            </nav>
        </header>

        <main>
            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST" class="movie-form">
                <div class="form-group">
                    <label for="title">Title *:</label>
                    <input type="text" name="title" id="title" required>
                </div>

                <div class="form-group">
                    <label for="director">Director *:</label>
                    <input type="text" name="director" id="director" required>
                </div>

                <div class="form-group">
                    <label for="release_year">Release Year *:</label>
                    <input type="number" name="release_year" id="release_year" min="1900" max="2030" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre:</label>
                    <input type="text" name="genre" id="genre" placeholder="e.g., Sci-Fi, Drama, Comedy">
                </div>

                <div class="form-group">
                    <label for="duration_minutes">Duration (minutes):</label>
                    <input type="number" name="duration_minutes" id="duration_minutes" min="1">
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" rows="4" placeholder="Movie description..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Movie</button>
            </form>
        </main>
    </div>
</body>
</html>
