<?php
$conn = new mysqli('localhost', 'root', '', 'poll_system');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

    $result = $conn->query("SELECT * FROM polls");
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>