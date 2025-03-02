<?php
	$tablica = array ("jablko", "banan", "pomarancza");
	
	foreach($tablica as $index => $owoc) {
		$length = strlen($owoc);
		
		for($i = $length - 1; $i >= 0; $i--) {
			echo($owoc[$i]);
		}
		
		if($owoc[0] == "p") {
			echo(" Zaczyna sie na litere 'P'");
		}
		
		echo "<br>";
		
	}
?>
