<?php 

$input_raw = ""; //raw input, with line breaks

	//remove newline from string to get each passport in 1 array entry
	$input_array  = preg_split("#\n\s*\n#Uis", $input_raw);
	$input_array_length = count($input_array);
	
	//what words do we need to look for
	$find_words_array = array('byr','iyr','eyr','hgt','hcl','ecl','pid');	
	$find_words_array_length = count($find_words_array);	
	
	$valid = 0;
	
	//loop through array with passwords
	for ($i = 0; $i <= $input_array_length; $i++) {
		$found = 0;
		//loop through array with words and increment $found
		for ($y = 0; $y <= $find_words_array_length; $y++) {
			if (strpos($input_array[$i],$find_words_array[$y]) !== false) {
				$found++;
			}			
		}
		//if $found equals the number of words we're looking for, increment $valid
		if ($found == $find_words_array_length) {
			$valid++;
		}
	}

	echo 'Part 1 has '.$valid.' valid passports!<br /><br />';
	
	//BOF Part 2
	$valid = 0;
	
	//loop through array with passwords
	for ($i = 0; $i <= $input_array_length; $i++) {
		$test_valid = 0;
		
		//crete new array with each passport element seperated
		$new_array = explode("%%%",preg_replace("/\r\n|\r|\n| | /","%%%",$input_array[$i]));
		$new_array_count = count($new_array);
		//create array with passport element name as key and value as value
		for ($y = 0; $y <= $new_array_count; $y++) {
			$explode_key_value = explode(":",$new_array[$y]);
			$output_array[$i][$explode_key_value[0]] = $explode_key_value[1];
		}
		
		//run checks, if check passes, $test_valid will be incremented
		
		//check byr
		if (strlen($output_array[$i]['byr']) == 4 && $output_array[$i]['byr'] >=1920 && $output_array[$i]['byr'] <=2002) {
			$test_valid++;
		}		
		
		//check iyr
		if (strlen($output_array[$i]['iyr']) == 4 && $output_array[$i]['iyr'] >=2010 && $output_array[$i]['iyr'] <=2020) {
			$test_valid++;
		}		
		
		//check eyr
		if (strlen($output_array[$i]['eyr']) == 4 && $output_array[$i]['eyr'] >=2020 && $output_array[$i]['eyr'] <=2030) {
			$test_valid++;
		}		
		
		//check hgt
		if (strpos($output_array[$i]['hgt'],'cm') !== false) {
			$string = str_replace("cm","",$output_array[$i]['hgt']);
			if ($string >= 150 && $string <= 193) {
				$test_valid++;
			}
		} elseif (strpos($output_array[$i]['hgt'],'in') !== false) {
			$string = str_replace("in","",$output_array[$i]['hgt']);
			if ($string >= 59 && $string <= 76) {
				$test_valid++;
			}
		}			
		
		//check hcl
		if (strpos($output_array[$i]['hcl'],'#') !== false) {
			$string = str_replace("#","",$output_array[$i]['hcl']);
			if (strlen($string) == 6 && !preg_match('/[^A-Za-z0-9]/', $string)) {
				$test_valid++;
			}
		}
		
		//check ecl
		if ($output_array[$i]['ecl'] == 'amb' || $output_array[$i]['ecl'] == 'blu' || $output_array[$i]['ecl'] == 'brn' || $output_array[$i]['ecl'] == 'gry' || $output_array[$i]['ecl'] == 'grn' || $output_array[$i]['ecl'] == 'hzl' || $output_array[$i]['ecl'] == 'oth') {
			$test_valid++;
		}		
		
		//check pid
		if (strlen($output_array[$i]['pid']) == 9) {
			$test_valid++;
		}
		
		//if $test_valid is 7 (number of tests) then increment $valid
		if ($test_valid == 7) {
			$valid++;
		}		
	}

	echo 'Part 2 has '.$valid.' valid passports!';
?>
