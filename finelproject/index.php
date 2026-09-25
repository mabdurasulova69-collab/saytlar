<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['add'])) {
    $name = trim($_POST['name']);
    $age = (int) $_POST['age'];
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);
    $status = $_POST['status'];

    if ($name !== '' && $age >= 7 && $age <= 100 && $phone !== '' && $course !== '') {
        $stmt = $pdo->prepare(
            "INSERT INTO students (name, age, phone, course, status)
             VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->execute([$name, $age, $phone, $course, $status]);
    }

    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}

$search = trim($_GET['search'] ?? '');

if ($search !== '') {
    $stmt = $pdo->prepare(
        "SELECT * FROM students
         WHERE name LIKE ? OR phone LIKE ? OR course LIKE ?
         ORDER BY id DESC"
    );

    $value = "%$search%";
    $stmt->execute([$value, $value, $value]);

    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $students = $pdo->query(
        "SELECT * FROM students ORDER BY id DESC"
    )->fetchAll(PDO::FETCH_ASSOC);
}

$total = $pdo->query(
    "SELECT COUNT(*) FROM students"
)->fetchColumn();

$active = $pdo->query(
    "SELECT COUNT(*) FROM students WHERE status = 'active'"
)->fetchColumn();

$completed = $pdo->query(
    "SELECT COUNT(*) FROM students WHERE status = 'completed'"
)->fetchColumn();

?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oquv Markazi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Oquv Markaz CRM</h1>

    <div class="stats">
        <div>
            <h3>Jami oquvchilar</h3>
            <p><?= $total ?></p>
        </div>

        <div>
            <h3>Faol oquvchilar</h3>
            <p><?= $active ?></p>
        </div>

        <div>
            <h3>Tugatganlar</h3>
            <p><?= $completed ?></p>
        </div>
    </div>

    <h2>Oquvchi qoshish</h2>

    <form method="POST">

        <input
            type="text"
            name="name"
            placeholder="Ism"
            required
        >

        <input
            type="number"
            name="age"
            placeholder="Yosh"
            min="7"
            max="100"
            required
        >

        <input
            type="text"
            name="phone"
            placeholder="Telefon"
            required
        >

        <input
            type="text"
            name="course"
            placeholder="Kurs"
            required
        >

        <select name="status">
            <option value="active">Faol</option>
            <option value="completed">Tugatgan</option>
        </select>

        <button type="submit" name="add">
            Oquvchi qoshish
        </button>

    </form>

    <h2>Qidirish</h2>

    <form method="GET">

        <input
            type="text"
            name="search"
            placeholder="Ism, telefon yoki kurs..."
            value="<?= htmlspecialchars($search) ?>"
        >

        <button type="submit">
            Qidirish
        </button>

        <a href="index.php">Tozalash</a>

    </form>

    <h2>Oquvchilar royxati</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Ism</th>
            <th>Yosh</th>
            <th>Telefon</th>
            <th>Kurs</th>
            <th>Status</th>
            <th>Amallar</th>
        </tr>

        <?php foreach ($students as $student): ?>

            <tr>

                <td><?= $student['id'] ?></td>

                <td>
                    <?= htmlspecialchars($student['name']) ?>
                </td>

                <td><?= $student['age'] ?></td>

                <td>
                    <?= htmlspecialchars($student['phone']) ?>
                </td>

                <td>
                    <?= htmlspecialchars($student['course']) ?>
                </td>

                <td>
                    <?= $student['status'] === 'active'
                        ? 'Faol'
                        : 'Tugatgan'
                    ?>
                </td>

                <td>
                    <a href="edit.php?id=<?= $student['id'] ?>">
                        Tahrirlash
                    </a>

                    <a
                        href="index.php?delete=<?= $student['id'] ?>"
                        onclick="return confirm('Oquvchini ochirmoqchimisiz?')"
                    >
                        Ochirish
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</div>

<script src="script.js"></script>

</body>
</html>