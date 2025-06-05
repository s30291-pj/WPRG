<?php 
    include 'db.php'; 
    if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        $stmt = mysqli_prepare($conn, "INSERT INTO samochody(marka, model, cena, rok, opis) VALUES (?, ?, ?, ?, ?)"); 
        mysqli_stmt_bind_param($stmt, "ssdis", $_POST['marka'], $_POST['model'], $_POST['cena'], $_POST['rok'], $_POST['opis']); 
        mysqli_stmt_execute($stmt); 
        mysqli_close($conn); 
        header('Location: wszystkie.php'); 
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodaj samochód</title>
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <div id="container">
            <h2>Dodaj samochód</h2>
            <nav>
                <a class="btn" href="index.php">Strona główna</a>
                <a class="btn" href="wszystkie.php">Wszystkie samochody</a>
                <a class="btn" href="dodaj.php">Dodaj samochód</a>
            </nav>
            <form method="post">
                <label>Marka<input type="text" name="marka" required></label>
                <label>Model<input type="text" name="model" required></label>
                <label>Cena<input type="number" step="0.01" name="cena" required></label>
                <label>Rok<input type="number" name="rok" required></label>
                <label>Opis<textarea name="opis"></textarea></label>
                <button type="submit">Dodaj</button>
            </form>
        </div>
    </body>
</html>
