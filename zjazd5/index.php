<?php 
    include 'db.php'; 
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Strona główna</title>
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <div id="container">
            <h2>Strona główna</h2>
            <nav>
                <a class="btn" href="index.php">Strona główna</a>
                <a class="btn" href="wszystkie.php">Wszystkie samochody</a>
                <a class="btn" href="dodaj.php">Dodaj samochód</a>
            </nav>
            <?php
            $res = mysqli_query($conn, "SELECT id, marka, model, cena, rok FROM samochody ORDER BY cena ASC LIMIT 5");
            echo'<table><tr><th>ID</th><th>Marka</th><th>Model</th><th>Cena</th><th>Rok</th><th>Szczegóły</th></tr>';
            while($r = mysqli_fetch_assoc($res)){
                echo'<tr>';
                echo'<td>'.$r['id'].'</td><td>'
                        .$r['marka'].'</td><td>'
                        .$r['model'].'</td><td>'
                        .$r['cena'].'</td><td>'
                        .$r['rok'].'</td>';
                echo'<td><a class="btn" href="szczegoly.php?id='.$r['id'].'">Szczegóły</a></td></tr>';
            }
            echo'</table>';
            mysqli_close($conn);
            ?>
        </div>
    </body>
</html>
