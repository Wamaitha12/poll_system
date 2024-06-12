<?php
$conn = new mysqli('localhost', 'root', '', 'poll_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM polls ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Poll System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Online Poll System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="create_poll.php">Create Poll</a>
        </nav>
    </header>
    <div class="container">
        <h2>Available Polls</h2>
        <ul>
            <?php while($row = $result->fetch_assoc()): ?>
                <li>
                    <a href="vote.php?poll=<?= $row['id'] ?>">
                        <?= htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
    <footer>
        &copy; 2024 Online Poll System
    </footer>
    <?php $conn->close(); ?>
</body>
</html>
