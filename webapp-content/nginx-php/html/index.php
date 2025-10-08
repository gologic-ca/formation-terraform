<?php
require_once 'config.php';

// Get all movies with their reviews
$result = $mysqli->query("
    SELECT m.*, 
           AVG(r.rating) as avg_rating,
           COUNT(r.id) as review_count
    FROM movies m 
    LEFT JOIN reviews r ON m.id = r.movie_id 
    GROUP BY m.id 
    ORDER BY m.title
");
$movies = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Review App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Movie Review App</h1>
            <nav>
                <a href="add_movie.php" class="btn">Add Movie</a>
                <a href="add_review.php" class="btn">Add Review</a>
            </nav>
        </header>

        <main>
            <?php foreach ($movies as $movie): ?>
                <div class="movie-card">
                    <h2><?= htmlspecialchars($movie['title']) ?></h2>
                    <div class="movie-info">
                        <p><strong>Director:</strong> <?= htmlspecialchars($movie['director']) ?></p>
                        <p><strong>Year:</strong> <?= $movie['release_year'] ?></p>
                        <p><strong>Genre:</strong> <?= htmlspecialchars($movie['genre']) ?></p>
                        <p><strong>Duration:</strong> <?= $movie['duration_minutes'] ?> minutes</p>
                        <?php if ($movie['avg_rating']): ?>
                            <p><strong>Rating:</strong> <?= number_format($movie['avg_rating'], 1) ?>/5 (<?= $movie['review_count'] ?> reviews)</p>
                        <?php endif; ?>
                    </div>
                    <p class="description"><?= htmlspecialchars($movie['description']) ?></p>
                    
                    <div class="actions">
                        <a href="movie_reviews.php?id=<?= $movie['id'] ?>" class="btn btn-small">View Reviews</a>
                        <a href="add_review.php?movie_id=<?= $movie['id'] ?>" class="btn btn-small">Add Review</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </main>
    </div>
</body>
</html>
