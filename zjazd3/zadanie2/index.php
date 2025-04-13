<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz Studenta PJATK</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <h2>Formularz Studenta PJATK</h2>
        <form method="POST">
            <label>Imię:
                <input type="text" name="imie" required>
            </label>
            <label>Nazwisko:
                <input type="text" name="nazwisko" required>
            </label>
            <label>Nr albumu:
                <input type="text" name="album" required>
            </label>
            <label>Email uczelniany:
                <input type="email" name="email" required>
            </label>
            <label>Kierunek:
                <input type="text" name="kierunek" required>
            </label>
            <button type="submit">Zapisz dane</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imie = htmlspecialchars($_POST["imie"]);
            $nazwisko = htmlspecialchars($_POST["nazwisko"]);
            $album = htmlspecialchars($_POST["album"]);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? $_POST["email"] : "Niepoprawny email";
            $kierunek = htmlspecialchars($_POST["kierunek"]);

            $linia = "$imie,$nazwisko,$album,$email,$kierunek" . PHP_EOL;
            file_put_contents("dane_studentow.txt", $linia, FILE_APPEND);
            echo "<p><strong>Dane zostały zapisane.</strong></p>";
        }
        ?>
    </div>
</body>
</html>
