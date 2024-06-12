<?php
$conn = new mysqli('localhost', 'root', '', 'poll_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $conn->real_escape_string($_POST['question']);
    $options = $_POST['options'];

    if (!empty($question) && count($options) >= 2) {
        $conn->query("INSERT INTO polls (question) VALUES ('$question')");
        $poll_id = $conn->insert_id;

        foreach ($options as $option) {
            $option = $conn->real_escape_string($option);
            if (!empty($option)) {
                $conn->query("INSERT INTO options (poll_id, option_text) VALUES ($poll_id, '$option')");
            }
        }

        header("Location: index.php");
        exit();
    } else {
        $error = "Please provide a question and at least two options.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Poll</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Create a New Poll</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header>
    <div class="container">
        <form method="post">
            <label for="question">Question:</label>
            <input type="text" name="question" id="question" required><br>
            <label for="options[]">Options:</label><br>
            <input type="text" name="options[]" required><br>
            <input type="text" name="options[]" required><br>
            <button type="button" onclick="addOption()">Add Option</button><br>
            <button type="submit">Create Poll</button>
            <?php if (!empty($error)): ?>
                <p style="color:red;"><?= $error ?></p>
            <?php endif; ?>
        </form>
        <script>
            function addOption() {
                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'options[]';
                input.required = true;
                document.querySelector('form').insertBefore(input, document.querySelector('button[type="button"]'));
            }
        </script>
    </div>
    <footer>
        &copy; 2024 Online Poll System
    </footer>
    <?php $conn->close(); ?>
</body>
</html>
