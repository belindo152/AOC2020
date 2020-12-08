<?php
	error_reporting(E_ALL);

	$input_raw = file_get_contents('input.txt');
	$input = explode("\n", $input_raw);
	$input_count = count($input);

	//BOF Part 1
	$loops_required = array();
	$contains_gold = array();

	//Loop through lines
	for ($i = 0; $i < $input_count; $i++) {
		//Count number of comma's
		$loops_required[] = substr_count($input[$i],",");

		//Split string in Outer and Inner bags
		$outer_inner = explode(" bags contain ", $input[$i]);

		//If Inner bag is 'shiny gold', add outer bag to array
		if (strpos($outer_inner[1], "shiny gold") !== false) {
			$contains_gold[] = $outer_inner[0];
		}
	}
	//Remove duplicates from array and reinstate order
	$contains_gold = array_values(array_unique($contains_gold));
	
	//Determine loops required (+2 is to add one loop for the Outer bag and one for the last Inner bag)
	$loops_required = max(array_values(array_unique($loops_required)))+2;
	
	//Loop through lines as much as is needed as per $loops_required
	for ($y = 0; $y <= $loops_required; $y++) {
		$contains_gold_count = count($contains_gold);	
		
		//Loop through lines
		for ($i = 0; $i < $input_count; $i++) {
			
			//Split string in Outer and Inner bafs
			$outer_inner = explode(" bags contain ", $input[$i]);			
			
			//If Inner bag is Outer Bag that contains shiny gold, add outer bag to array
			for ($j = 0; $j < $contains_gold_count; $j++) {
				if (strpos($outer_inner[1], $contains_gold[$j]) !== false) {
					$contains_gold[] = $outer_inner[0];
				}
			}
		}	
		//Remove duplicates from array and reinstate order
		$contains_gold = array_values(array_unique($contains_gold));
	}
	$part_1 = 'Part 1: '.count($contains_gold);
	
	echo $part_1;

?>
