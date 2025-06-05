<?php
    $conn = mysqli_connect('localhost','root','','samochody');
    if (!$conn) {
        die('Błąd połączenia: ' . mysqli_connect_error());
    }
?>