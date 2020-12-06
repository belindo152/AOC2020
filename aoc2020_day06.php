<?php 

$input_raw = "";

	//remove newline from string to get each group in 1 array entry
	$input_array  = preg_split("#\n\s*\n#Uis", $input_raw);
	$input_array_length = count($input_array);

	//BOF Part 1
	$result_part1 = 0;

	//loop through all groups
	for ($i = 0; $i < $input_array_length; $i++) {

		//remove newlines and spaces to get each groups answers in one clean string
		$answers_clean = preg_replace("/\r\n|\r|\n| | /","",$input_array[$i]);

		//keep only the unique answers
		$unique_answers = count_chars($answers_clean,3);

		//count unique answers
		$unique_answers_count = strlen($unique_answers);

		//add count of unique characters to the total
		$result_part1 = $result_part1 + $unique_answers_count;

	}
	echo "Part 1: ".$result_part1;
	
	//BOF Part 2
	$result_part2 = 0;
	
	//loop through all groups
	for ($i = 0; $i < $input_array_length; $i++) { 
		
		//find group size (counting \n, adding 1)
		$group_size = substr_count($input_array[$i],"\n")+1;
		
		//remove newlines and spaces to get each groups answers in one clean string
		$answers_clean = preg_replace("/\r\n|\r|\n| | /","",$input_array[$i]);
		
		//loop through alphabet and check if count of letter in $answers_clean matches the $group_size
		$answered_by_everyone = 0;
		foreach(range('a','z') as $v){
			if (substr_count($answers_clean,$v) == $group_size) {
				$answered_by_everyone++;
			}
		}
		$result_part2 = $result_part2 + $answered_by_everyone;
	}
	echo "<br /><br />Part 2: ".$result_part2;
?>
