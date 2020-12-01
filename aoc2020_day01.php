<?php

	$input = array(your,input,goes,here);

	$count = count($input);

	$target = 2020;

	echo '<strong>Part 1:</strong><br/>';
    for ($i = 0; $i < $count; $i++) {
		for ($j = $i + 1; $j < $count; $j++) {
			if ($input[$i] + $input[$j] == $target) {
				echo 'The two numbers adding up to 2020 are: '.$input[$i].' and '.$input[$j];
				echo '<br />Multiplying '.$input[$i].'*'.$input[$j].'='.$input[$i]*$input[$j];
				goto partTwo;
			}
		}
    }

partTwo:
	echo '<br /><br /><strong>Part 2:</strong><br/>';
    for ($i = 0; $i < $count; $i++) {
		for ($j = $i + 1; $j < $count; $j++) {
			for ($k = $j + 1; $k < $count; $k++) {
				if ($input[$i] + $input[$j] +  $input[$k] == $target) {
					echo 'The three numbers adding up to 2020 are: '.$input[$i].', '.$input[$j].' and ',$input[$k];
					echo '<br />Multiplying '.$input[$i].'*'.$input[$j].'*'.$input[$k].'='.$input[$i]*$input[$j]*$input[$k];
					goto theEnd;
				}
			}
		}
    }

theEnd:
	exit();

?>
