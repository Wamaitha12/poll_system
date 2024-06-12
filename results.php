<?php
$conn = new mysqli('localhost', 'root', '', 'poll_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$poll_id = $_GET['poll'];
$poll = $conn->query("SELECT * FROM polls WHERE id = $poll_id")->fetch_assoc();
$options = $conn->query("SELECT * FROM options WHERE poll_id = $poll_id");
$total_votes = $conn->query("SELECT SUM(votes) AS total FROM options WHERE poll_id = $poll_id")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Poll Results</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .result-bar {
            background: #50b3a2;
            height: 30px;
            color: #fff;
            line-height: 30px;
            padding-left: 10px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Poll Results</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>
    <div class="container">
        <h2><?= htmlspecialchars($poll['question'], ENT_QUOTES, 'UTF-8') ?></h2>
        <ul>
            <?php while($option = $options->fetch_assoc()): ?>
                <?php
                $percentage = $total_votes > 0 ? ($option['votes'] / $total_votes) * 100 : 0;
                ?>
                <li>
                    <?= htmlspecialchars($option['option_text'], ENT_QUOTES, 'UTF-8') ?>
                    <div class="result-bar" style="width: <?= $percentage ?>%">
                        <?= number_format($percentage, 2) ?>% (<?= $option['votes'] ?> votes)
                    </div>
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
