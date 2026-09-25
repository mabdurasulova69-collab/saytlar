<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];

    $stmt = $pdo->prepare(
        "INSERT INTO students (name, age) VALUES (?, ?)"
    );

    $stmt->execute([$name, $age]);
}

$students = $pdo->query("SELECT * FROM students")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Students</title>
</head>
<body>

<h2>Student qo'shish</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Ism" required>
    <input type="number" name="age" placeholder="Yosh" required>
    <button type="submit" name="add">Qo'shish</button>
</form>

<h2>Studentlar</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Ism</th>
        <th>Yosh</th>
    </tr>

    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= $student['age'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>