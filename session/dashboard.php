<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<p>Salom, <?= htmlspecialchars($_SESSION['user']) ?>!</p>

<a href="logout.php">Chiqish</a>

</body>
</html>