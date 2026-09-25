<?php

$file = 'products.json';

if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

$cruds = json_decode(file_get_contents($file), true);

if (isset($_POST['add'])) {
    $crud = [
        'id' => time(),
        'name' => $_POST['name'],
        'price' => $_POST['price']
    ];

    $cruds[] = $crud;

    file_put_contents($file, json_encode($cruds, JSON_PRETTY_PRINT));

    header('Location: crud.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $cruds = array_filter($cruds, function ($crud) use ($id) {
        return $crud['id'] != $id;
    });

    file_put_contents($file, json_encode(array_values($cruds), JSON_PRETTY_PRINT));

    header('Location: crud.php');
    exit;
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];

    foreach ($cruds as &$product) {
        if ($product['id'] == $id) {
            $product['name'] = $_POST['name'];
            $product['price'] = $_POST['price'];
        }
    }

    file_put_contents($file, json_encode($cruds, JSON_PRETTY_PRINT));

    header('Location: crud.php');
    exit;
}

$editCrud = null;

if (isset($_GET['edit'])) {
    foreach ($cruds as $crud) {
        if ($crud['id'] == $_GET['edit']) {
            $editCrud = $crud;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <title>Mahsulotlar CRUD</title>
</head>
<body>

<h2>Mahsulot qoshish</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Mahsulot nomi" required>
    <input type="number" name="price" placeholder="Narxi" required>
    <button type="submit" name="add">Qoshish</button>
</form>

<?php if ($editCrud): ?>

<h2>Mahsulotni tahrirlash</h2>
    `
<form method="POST">
    <input type="hidden" name="id" value="<?= $editCrud['id'] ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($editCrud['name']) ?>" required>
    <input type="number" name="price" value="<?= $editCrud['price'] ?>" required>
    <button type="submit" name="update">Saqlash</button>
</form>

<?php endif; ?>

<h2>Mahsulotlar</h2>

<?php if (empty($cruds)): ?>

<p>Hozircha mahsulotlar yoq.</p>

<?php else: ?>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nomi</th>
        <th>Narxi</th>
        <th>Amallar</th>
    </tr>

    <?php foreach ($cruds as $crud): ?>
        <tr>
            <td><?= $crud['id'] ?></td>
            <td><?= htmlspecialchars($crud['name']) ?></td>
            <td><?= $crud['price'] ?></td>
            <td>
                <a href="?edit=<?= $crud['id'] ?>">Tahrirlash</a>
                <a href="?delete=<?= $crud['id'] ?>" onclick="return confirm('Ochirishni xohlaysizmi?')">O‘chirish</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>

</body>
</html>