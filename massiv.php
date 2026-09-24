<?php

$students = [
    "Odina",
    "Madina",
    "Aziza",
    "Malika",
    "Zarina"
];

echo "<h2>Talabalar royxati</h2>";

foreach ($students as $student) {
    echo $student . "<br>";
}

?>

<h2>Talaba qidirish</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Ism kiriting">
    <button type="submit">Qidirish</button>
</form>

<?php

if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

    if (in_array($search, $students)) {
        echo "<p>$search royxatda bor!</p>";
    } else {
        echo "<p>$search royxatda yoq!</p>";
    }
}

sort($students);

echo "<h2>Saralangan ro‘yxat</h2>";

foreach ($students as $student) {
    echo $student . "<br>";
}

?>