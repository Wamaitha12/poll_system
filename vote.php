<?php
$conn = new mysqli('localhost', 'root', '', 'poll_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = $_POST['poll_id'];
    $option_id = $_POST['option'];

    $conn->query("UPDATE options SET votes = votes + 1 WHERE id = $option_id");
    header("Location: results.php?poll=$poll_id");
    exit();
} else {
    $poll_id = $_GET['poll'];
    $poll = $conn->query("SELECT * FROM polls WHERE id = $poll_id")->fetch_assoc();
    $options = $conn->query("SELECT * FROM options WHERE poll_id = $poll_id");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Vote in Poll</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Vote in Poll</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>
    <div class="container">
        <h2><?= htmlspecialchars($poll['question'], ENT_QUOTES, 'UTF-8') ?></h2>
        <form method="post">
            <?php while($option = $options->fetch_assoc()): ?>
                <label>
                    <input type="radio" name="option" value="<?= $option['id'] ?>" required>
                    <?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?>
                </label><br>
            <?php endwhile; ?>
            <input type="hidden" name="poll_id" value="<?= $poll_id ?>">
            <button type="submit">Vote</button>
        </form>
    </div>
    <footer>
        &copy; 2024 Online Poll System
    </footer>
    <?php $conn->close(); ?>
</body>
</html>
