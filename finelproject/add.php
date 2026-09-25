<?php

$pdo = new PDO(
    "mysql:host=127.0.0.1;dbname=school;charset=utf8mb4",
    "root",
    "5555"
);

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
        die("Ma'lumotlarni to'g'ri kiriting!");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO students (name, age, phone, course, status)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        $name,
        $age,
        $phone,
        $course,
        $status
    ]);

    header("Location: index.php");
    exit;
}

header("Location: index.php");
exit;