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
	
	echo("<b>Ciag Fibonacciego:</b> " . implode(", ", fib(10)));

?>