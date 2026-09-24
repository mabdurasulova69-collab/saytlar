<!DOCTYPE html>
<html>
<head>
    <title>Mini Guestbook</title>
</head>
<body>

<h2>Mini Guestbook</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Ismingiz" required>
    <br><br>

    <textarea name="message" placeholder="Xabaringiz" required></textarea>
    <br><br>

    <button type="submit">Yuborish</button>
</form>

<?php

$file = "guestbook.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if ($name !== '' && $message !== '') {

        $data = $name . "|" . $message . PHP_EOL;

        file_put_contents($file, $data, FILE_APPEND);

        echo "<p>Xabaringiz saqlandi!</p>";
    }
}

echo "<h2>Xabarlar</h2>";

if (file_exists($file)) {

    $messages = file($file, FILE_IGNORE_NEW_LINES);

    foreach ($messages as $message) {

        $parts = explode("|", $message, 2);

        $name = htmlspecialchars($parts[0]);
        $text = htmlspecialchars($parts[1]);

        echo "<p><strong>$name</strong>: $text</p>";
    }
}

?>

</body>
</html>