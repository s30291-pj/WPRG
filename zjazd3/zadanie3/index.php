<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rezerwacja Hotelu CMS</title>
    <link href="assets/style.css" rel="stylesheet">
</head>
<body>
    <div id="container">
        <h2>Formularz Rezerwacji Hotelu</h2>

        <?php
        $plik = "rezerwacje.csv";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $dane = [
                htmlspecialchars($_POST["imie"]),
                htmlspecialchars($_POST["nazwisko"]),
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) ? $_POST["email"] : "Niepoprawny email",
                htmlspecialchars($_POST["adres"]),
                htmlspecialchars($_POST["karta"]),
                $_POST["osoby"],
                $_POST["data_przyjazdu"],
                $_POST["godzina_przyjazdu"],
                isset($_POST["dostawka"]) ? "Tak" : "Nie",
                isset($_POST["udogodnienia"]) ? implode(",", $_POST["udogodnienia"]) : "Brak"
            ];

            if (!file_exists($plik)) {
                $naglowki = [
                    "Imię", "Nazwisko", "Email", "Adres", "Karta", "Liczba osób",
                    "Data przyjazdu", "Godzina przyjazdu", "Dostawka", "Udogodnienia"
                ];
                file_put_contents($plik, implode(";", $naglowki) . "\n", FILE_APPEND);
            }

            file_put_contents($plik, implode(";", $dane) . "\n", FILE_APPEND);
            echo "<p class='success'>Dane zostały zapisane.</p>";
        }

        if (isset($_GET["show"])) {
            echo "<h3>Dane zapisane w pliku:</h3><div class='data-box'>";
            if (file_exists($plik)) {
                $rows = file($plik);
                echo "<table><tbody>";
                foreach ($rows as $i => $row) {
                    $fields = explode(";", trim($row));
                    echo "<tr>";
                    foreach ($fields as $field) {
                        echo $i === 0 ? "<th>$field</th>" : "<td>$field</td>";
                    }
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Brak danych.</p>";
            }
            echo "</div>";
        }
        ?>

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
            <button type="submit" name="submit">Zapisz rezerwację</button>
        </form>

        <form method="GET">
            <button type="submit" name="show" style="margin-top: 8px; background-color: green;">Wczytaj zapisane dane</button>
        </form>
    </div>
</body>
</html>
