<?php 
    include 'db.php'; 
    $id = intval($_GET['id']); 
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Szczegóły samochodu</title>
        <link rel="stylesheet" href="./assets/style.css">
    </head>
    <body>
        <div id="container">
            <h2>Szczegóły samochodu</h2>
            <nav>
                <a class="btn" href="index.php">Strona główna</a>
                <a class="btn" href="wszystkie.php">Wszystkie samochody</a>
                <a class="btn" href="dodaj.php">Dodaj samochód</a>
            </nav>
            <?php
            $res = mysqli_query($conn,"SELECT * FROM samochody WHERE id=$id");
            if($r = mysqli_fetch_assoc($res)){
                echo'<table>';
                foreach($r as $k=>$v){
                    echo'<tr><th>'.htmlspecialchars($k).'</th><td>'.htmlspecialchars($v).'</td></tr>';
                }
                echo'</table>';
            }
            mysqli_close($conn);
            ?>
            <a class="btn" style="margin-top: 10px;" href="index.php">Powrót</a>
        </div>
    </body>
</html>
