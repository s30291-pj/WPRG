<?php
session_start();

$login = "s30291";
$haslo = "pjwstk";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["login"] == $login && $_POST["haslo"] == $haslo) {
        $_SESSION["zalogowany"] = true;
        setcookie("user_login", $_POST["login"], time() + 3600);
        header("Location: index.php");
        exit;
    } else {
        $blad = "Nieprawidłowy login lub hasło!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <h2>Logowanie</h2>
        <?php if (isset($blad)) echo "<p style='color:red;'>$blad</p>"; ?>
        <form method="POST">
            <label>Login:
                <input type="text" name="login" required>
            </label>
            <label>Hasło:
                <input type="password" name="haslo" required>
            </label>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>
