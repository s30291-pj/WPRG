<?php

function dodaj($a, $b) {
    return $a + $b;
}

function odejmij($a, $b) {
    return $a - $b;
}

function mnoz($a, $b) {
    return $a * $b;
}

function dziel($a, $b) {
    if ($b == 0) {
        return "<small>Dzielenie przez 0!</small>";
    }
    return $a / $b;
}

?>