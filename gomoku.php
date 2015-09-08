<?php

echo "It was placed in the center of the black!\n";
echo "10の十\n\n";
$i = 0;// Turn

while (1) {
	echo "Turn black : ";
	$black[$i] = trim(fgets(STDIN)); // Enter wait
// NG check
	echo "Turn white : ";
	$white[$i] = trim(fgets(STDIN)); // Enter wait
// NG check
$i++;
}