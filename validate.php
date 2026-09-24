<!DOCTYPE html>
<html>
<head>
    <title>Royxatdan otish</title>
</head>
<body>

<h2>Royxatdan otish</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Ism">
    <br><br>

    <input type="text" name="email" placeholder="Email">
    <br><br>

    <input type="password" name="password" placeholder="Parol">
    <br><br>

    <input type="number" name="age" placeholder="Yosh">
    <br><br>

    <button type="submit">Royxatdan otish</button>

</form>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $age = $_POST['age'];

    $errors = [];

    if (empty($name)) {
        $errors[] = "Ism kiritilishi kerak!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email notogri!";
    }

    if (strlen($password) < 6) {
        $errors[] = "Parol kamida 6 ta belgidan iborat bolishi kerak!";
    }

    if ($age < 7 || $age > 100) {
        $errors[] = "Yosh 7 dan 100 gacha bolishi kerak!";
    }

    if (empty($errors)) {
        echo "<p>Royxatdan otish muvaffaqiyatli!</p>";

    } else {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

?>

</body>
</html>