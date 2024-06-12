write this in mysql I used xampp to create the database
CREATE DATABASE poll_system;
USE poll_system;

CREATE TABLE polls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    option_text VARCHAR(255) NOT NULL,
    votes INT DEFAULT 0,
    FOREIGN KEY (poll_id) REFERENCES polls(id)
);

