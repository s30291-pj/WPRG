<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first = isset($_POST["first-number"]) ? $_POST["first-number"] : 0;
        $second = isset($_POST["second-number"]) ? $_POST["second-number"] : 0;
        $option = isset($_POST["operation"]) ? $_POST["operation"] : "+";

        $first = floatval($first);
        $second = floatval($second);

        switch ($option) {
            case '+':
                $result = $first + $second;
                break;
            case '-':
                $result = $first - $second;
                break;
            case '*':
                $result = $first * $second;
                break;
            case '/':
                $result = ($second != 0) ? $first / $second : "<small>Dzielenie przez 0!</small>";
                break;
            default:
                $result = "Nieprawidłowa operacja";
                break;
        }
    } else {
        $first = 0;
        $second = 0;
        $result = 0;
    }
?>

<html>
    <head>
        <title>Kalkulator</title>
        <script src="./assets/script.js"></script>
        <link href="./assets/style.css" rel="stylesheet">
    </head>
    <body>
        <form method="POST">
            <div id="calculator">
                <div id="screen">
                    <p id="result"><?php echo $result; ?></p>
                </div>
                <div id="interaction">
                    <div>
                        <label for="first-number">Pierwsza liczba</label>
                        <input id="first-number" name="first-number" type="number" value=<?php echo($first); ?>>
                    </div>
                    <div>
                        <label for="second-number">Druga liczba</label>
                        <input id="second-number" name="second-number" type="number" value=<?php echo($second); ?>>
                    </div>
                    <div>
                        <label for="operation">Operacja</label>
                        <select id="operation" name="operation">
                            <option value="+" <?php if($option == "+") echo("selected");?>>+</option>
                            <option value="-" <?php if($option == "-") echo("selected");?>>-</option>
                            <option value="*" <?php if($option == "*") echo("selected");?>>*</option>
                            <option value="/" <?php if($option == "/") echo("selected");?>>/</option>
                        </select>
                    </div>
                    <button type="submit">Oblicz</button>
                </div>
            </div>
        </form>
    </body>
</html>
