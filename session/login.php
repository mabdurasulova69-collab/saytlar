<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if ($login === 'admin' && $password === '12345') {

        $_SESSION['user'] = $login;

        header('Location: dashboard.php');
        exit;

    } else {
        $error = "Login yoki parol noto‘g‘ri!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php if (isset($error)): ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="POST">

    <input type="text" name="login" placeholder="Login" required>
    <br><br>

    <input type="password" name="password" placeholder="Parol" required>
    <br><br>

    <button type="submit">Kirish</button>

</form>

</body>
</html>