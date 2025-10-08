<?php
require_once 'config.php';

$error = '';
$success = '';
$movie_id = $_GET['movie_id'] ?? 0;

// Get all movies for dropdown
$result = $mysqli->query("SELECT id, title FROM movies ORDER BY title");
$movies = $result->fetch_all(MYSQLI_ASSOC);

// Get all users for dropdown
$result = $mysqli->query("SELECT id, username FROM users ORDER BY username");
$users = $result->fetch_all(MYSQLI_ASSOC);

if ($_POST) {
    $user_id = $_POST['user_id'];
    $movie_id = $_POST['movie_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    if ($user_id && $movie_id && $rating) {
        try {
            $stmt = $mysqli->prepare("INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $user_id, $movie_id, $rating, $comment);
            $stmt->execute();
            $success = "Review added successfully!";
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $error = "You have already reviewed this movie.";
            } else {
                $error = "Error adding review: " . $e->getMessage();
            }
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
    <title>Add Review</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Add Movie Review</h1>
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

            <form method="POST" class="review-form">
                <div class="form-group">
                    <label for="user_id">User:</label>
                    <select name="user_id" id="user_id" required>
                        <option value="">Select a user</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['username']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="movie_id">Movie:</label>
                    <select name="movie_id" id="movie_id" required>
                        <option value="">Select a movie</option>
                        <?php foreach ($movies as $movie): ?>
                            <option value="<?= $movie['id'] ?>" <?= $movie['id'] == $movie_id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($movie['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating" required>
                        <option value="">Select rating</option>
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="comment">Review Comment:</label>
                    <textarea name="comment" id="comment" rows="5" placeholder="Write your review here..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </main>
    </div>
</body>
</html>
