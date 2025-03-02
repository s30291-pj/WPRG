<?php
	$poczatek = 0;
	$koniec = 100;
	
	$pierwsze = array();
	
	function pierwsza($liczba) {
		if($liczba == 0) return false;
		
		for($d = 2; $d < $liczba; $d++) {
			if($liczba % $d == 0) return false;
		}
		
		return true;
	}
	
	for($i = $poczatek; $i < $koniec + 1; $i++) {
		if(!pierwsza($i)) continue;
		
		array_push($pierwsze, "" . $i);
	}
	
	echo("<b>Liczby pierwsze:</b> " . implode(", ", $pierwsze));
?>
