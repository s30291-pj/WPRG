<?php

	function fib($n) {
		$first = 0;
		$second = 1;
		
		$numbers = array();
		
		for($i = 0; $i < $n; $i++) {
			$tmp = $first;
			$first = $second;
			$second = $first + $tmp;
		
			$numbers[] = $first;
		}
		
		return $numbers;
	}
	
	
	$N = 10;
	
	echo("<b>Ciag Fibonacciego (nieparzyste elementy):</b><br> ");
	
	foreach(fib($N) as $index => $value) {
		if($value % 2 == 0) continue;
	
		echo($index . " => " . $value . "<br>");
	}

?>