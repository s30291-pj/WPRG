<?php
	$text = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
			been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
			galley of type and scrambled it to make a type specimen book. It has survived not only five
			centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was
			popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
			and more recently with desktop publishing software like Aldus PageMaker including versions of
			Lorem Ipsum.";
	
	
	$array = str_split($text); 
	$inter = str_split(".,!?");
	
	for ($i = 0; $i < count($array); $i++) {
        if (in_array($array[$i], $inter)) {
            echo $array[$i] . " at " . $i . "<br>";

            array_splice($array, $i, 1);

            $i--;
        }
    }

	$array = array_values($array);
    
    $assoc = [];
    $counter = 0;
    $tempKey = null;
    
    foreach ($array as $element) {
        if ($counter % 2 == 0) {
            $tempKey = $element;
        } else {
            $assoc[$tempKey] = $element;
        }
        $counter++;
    }
    
    echo "<br>Tablica asocjacyjna:<br>";
    foreach ($assoc as $key => $value) {
        echo $key . " => " . $value . "<br>";
    }

?>