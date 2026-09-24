<!DOCTYPE html>
<html>
<head>
    <title>Kontakt forma</title>
</head>
<body>

<h2>Kontakt</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Ismingiz" required>
    <br><br>

    <input type="text" name="phone" placeholder="Telefon" required>
    <br><br>

    <textarea name="message" placeholder="Xabaringiz" required></textarea>
    <br><br>

    <button type="submit">Yuborish</button>
</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $data = "Ism: $name\nTelefon: $phone\nXabar: $message\n\n";

    $file = fopen("contacts.txt", "a");

    fwrite($file, $data);

    fclose($file);

    echo "<p>Ma'lumot muvaffaqiyatli saqlandi!</p>";
}

?>

</body>
</html>