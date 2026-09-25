<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

$id = (int) ($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("O‘quvchi topilmadi!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $age = (int) $_POST["age"];
    $phone = trim($_POST["phone"]);
    $course = trim($_POST["course"]);
    $status = $_POST["status"];

    if (
        $name === "" ||
        $age < 7 ||
        $age > 100 ||
        $phone === "" ||
        $course === ""
    ) {
        die("Ma'lumotlarni to‘g‘ri kiriting!");
    }

    $stmt = $pdo->prepare(
        "UPDATE students
         SET name = ?, age = ?, phone = ?, course = ?, status = ?
         WHERE id = ?"
    );

    $stmt->execute([
        $name,
        $age,
        $phone,
        $course,
        $status,
        $id
    ]);

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <title>O‘quvchini tahrirlash</title>
</head>

<body>

<h1>O‘quvchini tahrirlash</h1>

<form method="POST">

    <input
        type="text"
        name="name"
        value="<?= htmlspecialchars($student["name"]) ?>"
        placeholder="Ism"
        required
    >

    <input
        type="number"
        name="age"
        value="<?= $student["age"] ?>"
        placeholder="Yosh"
        required
    >

    <input
        type="text"
        name="phone"
        value="<?= htmlspecialchars($student["phone"]) ?>"
        placeholder="Telefon"
        required
    >

    <input
        type="text"
        name="course"
        value="<?= htmlspecialchars($student["course"]) ?>"
        placeholder="Kurs"
        required
    >

    <select name="status">

        <option value="active"
            <?= $student["status"] === "active" ? "selected" : "" ?>>
            Faol
        </option>

        <option value="completed"
            <?= $student["status"] === "completed" ? "selected" : "" ?>>
            Tugatgan
        </option>

    </select>

    <button type="submit">
        Saqlash
    </button>

</form>

<br>

<a href="index.php">Orqaga</a>

</body>

</html>