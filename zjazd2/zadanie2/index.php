<!DOCTYPE html>
<html lang="pl">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # Podsumowanie rezerwacji
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
        <?php

    # Wyświetlanie formularza z danymi poszczególnych osób
    } else {
        $imie = htmlspecialchars($_POST["imie"]);
        $nazwisko = htmlspecialchars($_POST["nazwisko"]);
        $email = htmlspecialchars($_POST["email"]);
        $adres = htmlspecialchars($_POST["adres"]);
        $karta = htmlspecialchars($_POST["karta"]);
        $osoby = intval($_POST["osoby"]);
        $data_przyjazdu = $_POST["data_przyjazdu"];
        $godzina_przyjazdu = $_POST["godzina_przyjazdu"];
        $dostawka = isset($_POST["dostawka"]) ? "Tak" : "Nie";
        $udogodnienia = isset($_POST["udogodnienia"]) ? implode(", ", $_POST["udogodnienia"]) : "Brak";
        ?>
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
        <?php
    }
} else {
    # Wyświetlanie początkowego formularza rezerwacji
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Rezerwacja Hotelu</title>
        <link href="assets/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            <h2>Formularz Rezerwacji Hotelu</h2>
            <form method="POST">
                <label>Imię:
                    <input type="text" name="imie" required>
                </label>
                <label>Nazwisko:
                    <input type="text" name="nazwisko" required>
                </label>
                <label>Email:
                    <input type="email" name="email" required>
                </label>
                <label>Adres:
                    <input type="text" name="adres" required>
                </label>
                <label>Dane karty:
                    <input type="text" name="karta" required>
                </label>
                <label>Liczba osób:
                    <select name="osoby">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </label>
                <label>Data przyjazdu:
                    <input type="date" name="data_przyjazdu" required>
                </label>
                <label>Godzina przyjazdu:
                    <input type="time" name="godzina_przyjazdu" required>
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
                <button type="submit">Przejdź do uzupełnienia danych osób</button>
            </form>
        </div>
    </body>
    <?php
}
?>
</html>
