<!DOCTYPE html>
<html>
<head>
    <title>Kalkulyator</title>
</head>
<body>

<form method="POST">
    <input type="number" name="num1" placeholder="1-son" required>

    <select name="operator">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>

    <input type="number" name="num2" placeholder="2-son" required>

    <button type="submit">Hisoblash</button>
</form>

<?php

if (isset($_POST['num1']) && isset($_POST['num2'])) {

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];

    switch ($operator) {
        case '+':
            $result = $num1 + $num2;
            break;

        case '-':
            $result = $num1 - $num2;
            break;

        case '*':
            $result = $num1 * $num2;
            break;

        case '/':
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = "0 ga bolish mumkin emas!";
            }
            break;
    }

    echo "Natija: $result";
}

?>

</body>
</html>