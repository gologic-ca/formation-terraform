-- Create database
CREATE DATABASE IF NOT EXISTS webapp;
USE webapp;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Movies table
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    release_year INT,
    genre VARCHAR(100),
    director VARCHAR(100),
    duration_minutes INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_id INT NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_movie (user_id, movie_id)
);

-- Sample data
INSERT INTO users (username, email, password_hash) VALUES
('john_doe', 'john@example.com', 'hashed_password_1'),
('jane_smith', 'jane@example.com', 'hashed_password_2'),
('movie_buff', 'buff@example.com', 'hashed_password_3');

INSERT INTO movies (title, description, release_year, genre, director, duration_minutes) VALUES
('The Matrix', 'A computer programmer discovers reality is a simulation', 1999, 'Sci-Fi', 'The Wachowskis', 136),
('Inception', 'A thief enters peoples dreams to steal secrets', 2010, 'Sci-Fi', 'Christopher Nolan', 148),
('The Godfather', 'The story of a powerful crime family', 1972, 'Crime', 'Francis Ford Coppola', 175);

INSERT INTO reviews (user_id, movie_id, rating, comment) VALUES
(1, 1, 5, 'Amazing movie! Mind-bending and revolutionary.'),
(2, 1, 4, 'Great special effects and story.'),
(1, 2, 5, 'Nolan at his finest. Complex but rewarding.'),
(3, 3, 5, 'A masterpiece of cinema. Timeless classic.');
