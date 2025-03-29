<?php

function isPrime($n, &$iterations) {
    $iterations = 0;
    if ($n < 2) {
        return false;
    }
    if ($n == 2) {
        $iterations++;
        return true;
    }

    if ($n % 2 == 0) {
        $iterations++; 
        return false;
    }
    $sqrt = sqrt($n);
    for ($i = 3; $i <= $sqrt; $i += 2) {
        $iterations++;
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

$error = '';
$resultMessage = '';
$iterations = 0;
$number = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["number"])) {
        $number = trim($_POST["number"]);

        if (!ctype_digit($number) || $number <= 0) {
            $error = "Proszę wprowadzić dodatnią liczbę całkowitą.";
        } else {
            $number = (int)$number;
            $isPrime = isPrime($number, $iterations);
            if ($isPrime) {
                $resultMessage = "Liczba $number jest liczbą pierwszą.";
            } else {
                $resultMessage = "Liczba $number nie jest liczbą pierwszą.";
            }
        }
    } else {
        $error = "Nie przesłano liczby.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Sprawdzanie liczby pierwszej</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div id="container">
        <h2>Sprawdź, czy liczba jest pierwsza</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="number">Wprowadź liczbę:</label>
            <input type="number" id="number" name="number" min="1" value="<?php echo htmlspecialchars($number); ?>" required>
            <button type="submit">Sprawdź</button>
        </form>

        <?php if ($resultMessage): ?>
            <div id="summary">
                <h3>Wynik:</h3>
                <p><?php echo $resultMessage; ?></p>
                <p>Liczba iteracji: <?php echo $iterations; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
