<?php
session_start();

// Sprawdzenie czy użytkownik jest zalogowany (jak nie to informacja o zalogowaniu)
if (!isset($_SESSION["zalogowany"])) {
    echo "<!DOCTYPE html>
    <html lang='pl'>
        <head>
            <meta charset='UTF-8'>
            <link href='assets/style.css' rel='stylesheet'>
            <title>Brak dostępu</title>
        </head>
        <body>
            <div id='container'>
                <h2>Dostęp zabroniony</h2>
                <p>Aby zarezerwować hotel, musisz się najpierw <a href='login.php'>zalogować</a>.</p>
                <p>Brak dostępu wynika z braku aktywnej sesji użytkownika.</p>
            </div>
        </body>
    </html>";
    exit;
}

// Wczytanie użytkownika z cookies
$user = isset($_COOKIE["user_login"]) ? $_COOKIE["user_login"] : "Użytkowniku";

// Usuwanie cookies przyciskiem
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usun"])) {
    foreach ($_COOKIE as $key => $value) {
        if (in_array($key, ["imie", "nazwisko", "email", "adres", "karta", "data_przyjazdu", "godzina_przyjazdu"])) {
            setcookie($key, "", time() - 3600);
        }
    }
    header("Location: index.php");
    exit;
}

// Zapisywanie danych do cookies po wypełnieniu formularza
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["stage"]) && !isset($_POST["usun"])) {
    $czas = time() + 60 * 60 * 24 * 7; // 7 dni
    setcookie("imie", $_POST["imie"], $czas);
    setcookie("nazwisko", $_POST["nazwisko"], $czas);
    setcookie("email", $_POST["email"], $czas);
    setcookie("adres", $_POST["adres"], $czas);
    setcookie("karta", $_POST["karta"], $czas);
    setcookie("data_przyjazdu", $_POST["data_przyjazdu"], $czas);
    setcookie("godzina_przyjazdu", $_POST["godzina_przyjazdu"], $czas);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formularz podsumowania
    if (isset($_POST["stage"]) && $_POST["stage"] == "persons") {
        $imie = htmlspecialchars($_POST["imie"]);
        $nazwisko = htmlspecialchars($_POST["nazwisko"]);
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? $_POST["email"] : "Niepoprawny email";
        $adres = htmlspecialchars($_POST["adres"]);
        $karta = htmlspecialchars($_POST["karta"]);
        $osoby = intval($_POST["osoby"]);
        $data_przyjazdu = $_POST["data_przyjazdu"];
        $godzina_przyjazdu = $_POST["godzina_przyjazdu"];
        $dostawka = isset($_POST["dostawka"]) ? "Tak" : "Nie";
        $udogodnienia = isset($_POST["udogodnienia"]) ? implode(", ", $_POST["udogodnienia"]) : "Brak";
        $persons = isset($_POST["persons"]) ? $_POST["persons"] : [];
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
            <meta charset="UTF-8">
            <title>Podsumowanie Rezerwacji</title>
            <link href="assets/style.css" rel="stylesheet">
        </head>
        <body>
            <div id="summary">
                <h2>Podsumowanie Rezerwacji</h2>
                <p><strong>Imię:</strong> <?php echo $imie; ?></p>
                <p><strong>Nazwisko:</strong> <?php echo $nazwisko; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Adres:</strong> <?php echo $adres; ?></p>
                <p><strong>Dane karty:</strong> <?php echo str_repeat("*", strlen($karta) - 4) . substr($karta, -4); ?></p>
                <p><strong>Liczba osób:</strong> <?php echo $osoby; ?></p>
                <p><strong>Data przyjazdu:</strong> <?php echo $data_przyjazdu; ?></p>
                <p><strong>Godzina przyjazdu:</strong> <?php echo $godzina_przyjazdu; ?></p>
                <p><strong>Dostawka dla dziecka:</strong> <?php echo $dostawka; ?></p>
                <p><strong>Udogodnienia:</strong> <?php echo $udogodnienia; ?></p>
                <hr>
                <h3>Dane poszczególnych osób:</h3>
                <?php 
                if (!empty($persons)) {
                    foreach ($persons as $index => $person) {
                        $person_imie = htmlspecialchars($person["imie"]);
                        $person_nazwisko = htmlspecialchars($person["nazwisko"]);
                        echo "<p><strong>Osoba " . ($index + 1) . ":</strong> $person_imie $person_nazwisko</p>";
                    }
                } else {
                    echo "<p>Brak danych o osobach.</p>";
                }
                ?>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Formularz wypełniania osób
        $imie = htmlspecialchars($_POST["imie"]);
        $nazwisko = htmlspecialchars($_POST["nazwisko"]);
        $email = htmlspecialchars($_POST["email"]);
        $adres = htmlspecialchars($_POST["adres"]);
        $karta = htmlspecialchars($_POST["karta"]);
        $osoby = intval($_POST["osoby"]);
        $data_przyjazdu = $_POST["data_przyjazdu"];
        $godzina_przyjazdu = $_POST["godzina_przyjazdu"];
        ?>
        <!DOCTYPE html>
        <html lang="pl">
        <head>
            <meta charset="UTF-8">
            <title>Dane Osób</title>
            <link href="assets/style.css" rel="stylesheet">
        </head>
        <body>
            <div id="container">
                <h2>Dane poszczególnych osób</h2>
                <form method="POST">
                    <input type="hidden" name="imie" value="<?php echo $imie; ?>">
                    <input type="hidden" name="nazwisko" value="<?php echo $nazwisko; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="adres" value="<?php echo $adres; ?>">
                    <input type="hidden" name="karta" value="<?php echo $karta; ?>">
                    <input type="hidden" name="osoby" value="<?php echo $osoby; ?>">
                    <input type="hidden" name="data_przyjazdu" value="<?php echo $data_przyjazdu; ?>">
                    <input type="hidden" name="godzina_przyjazdu" value="<?php echo $godzina_przyjazdu; ?>">
                    <?php if(isset($_POST["dostawka"])): ?>
                        <input type="hidden" name="dostawka" value="on">
                    <?php endif; ?>
                    <?php if(isset($_POST["udogodnienia"])): ?>
                        <?php foreach($_POST["udogodnienia"] as $udogodnienie): ?>
                            <input type="hidden" name="udogodnienia[]" value="<?php echo htmlspecialchars($udogodnienie); ?>">
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <input type="hidden" name="stage" value="persons">
                    <?php 
                    for ($i = 1; $i <= $osoby; $i++): 
                    ?>
                        <fieldset style="margin-bottom: 15px;">
                            <legend>Osoba <?php echo $i; ?></legend>
                            <label>Imię:
                                <input type="text" name="persons[<?php echo $i-1; ?>][imie]" required>
                            </label>
                            <label>Nazwisko:
                                <input type="text" name="persons[<?php echo $i-1; ?>][nazwisko]" required>
                            </label>
                        </fieldset>
                    <?php endfor; ?>
                    <button type="submit">Zatwierdź dane osób</button>
                </form>
            </div>
        </body>
        </html>
<?php
    }
} else {
    //Formularz poczatkowy
?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Rezerwacja Hotelu</title>
        <link href="assets/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            <h2>Witaj <?php echo $user; ?>!</h2>
            <form method="POST">
                <label>Imię:
                    <input type="text" name="imie" value="<?php echo $_COOKIE["imie"] ?? ''; ?>" required>
                </label>
                <label>Nazwisko:
                    <input type="text" name="nazwisko" value="<?php echo $_COOKIE["nazwisko"] ?? ''; ?>" required>
                </label>
                <label>Email:
                    <input type="email" name="email" value="<?php echo $_COOKIE["email"] ?? ''; ?>" required>
                </label>
                <label>Adres:
                    <input type="text" name="adres" value="<?php echo $_COOKIE["adres"] ?? ''; ?>" required>
                </label>
                <label>Dane karty:
                    <input type="text" name="karta" value="<?php echo $_COOKIE["karta"] ?? ''; ?>" required>
                </label>
                <label>Liczba osób:
                    <select name="osoby">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
                <label>Data przyjazdu:
                    <input type="date" name="data_przyjazdu" value="<?php echo $_COOKIE["data_przyjazdu"] ?? ''; ?>" required>
                </label>
                <label>Godzina przyjazdu:
                    <input type="time" name="godzina_przyjazdu" value="<?php echo $_COOKIE["godzina_przyjazdu"] ?? ''; ?>" required>
                </label>
                <label>
                    <input type="checkbox" name="dostawka"> Potrzebna dostawka dla dziecka
                </label>
                <label>Udogodnienia:
                    <select name="udogodnienia[]" multiple>
                        <option value="Klimatyzacja">Klimatyzacja</option>
                        <option value="Popielniczka">Popielniczka</option>
                        <option value="Lodowka">Lodowka</option>
                        <option value="Sejf">Sejf</option>
                    </select>
                </label>
                <button type="submit" style="background-color: green;">Przejdź do uzupełnienia danych osób</button>
            </form>

            <form method="POST" style="margin-top: 5px;">
                <input type="hidden" name="usun" value="1">
                <button type="submit">Wyczyść formularz</button>
            </form>

            <form method="POST" action="logout.php" style="margin-top: 5px;">
                <button type="submit" style="background-color: red;">Wyloguj</button>
            </form>
        </div>
    </body>
    </html>
<?php
}
?>
