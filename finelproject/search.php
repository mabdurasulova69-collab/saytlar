<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

$search = trim($_GET["search"] ?? "");

$stmt = $pdo->prepare(
    "SELECT * FROM students
     WHERE name LIKE ?
     OR phone LIKE ?
     OR course LIKE ?
     ORDER BY id DESC"
);

$value = "%$search%";

$stmt->execute([
    $value,
    $value,
    $value
]);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <title>Qidiruv</title>
</head>

<body>

<h1>Oquvchilarni qidirish</h1>

<form method="GET">

    <input
        type="text"
        name="search"
        placeholder="Ism, telefon yoki kurs"
        value="<?= htmlspecialchars($search) ?>"
        required
    >

    <button type="submit">
        Qidirish
    </button>

</form>

<br>

<a href="index.php">Bosh sahifa</a>

<h2>Natijalar</h2>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Ism</th>
        <th>Yosh</th>
        <th>Telefon</th>
        <th>Kurs</th>
        <th>Status</th>
    </tr>

    <?php foreach ($students as $student): ?>

    <tr>

        <td><?= $student["id"] ?></td>

        <td><?= htmlspecialchars($student["name"]) ?></td>

        <td><?= $student["age"] ?></td>

        <td><?= htmlspecialchars($student["phone"]) ?></td>

        <td><?= htmlspecialchars($student["course"]) ?></td>

        <td><?= htmlspecialchars($student["status"]) ?></td>

    </tr>

    <?php endforeach; ?>

</table>

</body>

</html>