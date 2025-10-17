<?php
require_once 'config.php';

$movie_id = $_GET['id'] ?? 0;

// Get movie details
$stmt = $mysqli->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$movie = $result->fetch_assoc();
$stmt->close();

if (!$movie) {
    header('Location: index.php');
    exit;
}

// Get reviews for this movie
$stmt = $mysqli->prepare("
    SELECT r.*, u.username 
    FROM reviews r 
    JOIN users u ON r.user_id = u.id 
    WHERE r.movie_id = ? 
    ORDER BY r.created_at DESC
");
$stmt->bind_param("i", $movie_id);
$stmt->execute();
$result = $stmt->get_result();
$reviews = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews for <?= htmlspecialchars($movie['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Reviews for "<?= htmlspecialchars($movie['title']) ?>"</h1>
            <nav>
                <a href="index.php" class="btn">Back to Movies</a>
                <a href="add_review.php?movie_id=<?= $movie['id'] ?>" class="btn">Add Review</a>
            </nav>
        </header>

        <main>
            <div class="movie-details">
                <h2><?= htmlspecialchars($movie['title']) ?></h2>
                <p><?= htmlspecialchars($movie['description']) ?></p>
                <p><strong>Director:</strong> <?= htmlspecialchars($movie['director']) ?> | 
                   <strong>Year:</strong> <?= $movie['release_year'] ?> | 
                   <strong>Genre:</strong> <?= htmlspecialchars($movie['genre']) ?></p>
            </div>

            <div class="reviews-section">
                <h3>Reviews (<?= count($reviews) ?>)</h3>
                <?php if (empty($reviews)): ?>
                    <p>No reviews yet. Be the first to review this movie!</p>
                <?php else: ?>
                    <?php foreach ($reviews as $review): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <strong><?= htmlspecialchars($review['username']) ?></strong>
                                <span class="rating">Rating: <?= $review['rating'] ?>/5</span>
                                <span class="date"><?= date('M j, Y', strtotime($review['created_at'])) ?></span>
                            </div>
                            <p class="review-comment"><?= htmlspecialchars($review['comment']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
