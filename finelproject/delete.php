<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

$id = (int) ($_GET["id"] ?? 0);

if ($id > 0) {

    $stmt = $pdo->prepare(
        "DELETE FROM students WHERE id = ?"
    );

    $stmt->execute([$id]);
}

header("Location: index.php");
exit;