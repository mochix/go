<?php
// 19x19
$fumen_ar = array();
echo "It was placed in the center of the black!\n";
echo "10 to 10\n\n";
$zahyou = 19;
$fumen_ar = array_fill ( 0, $zahyou * $zahyou, "");
$i = 0;// Turn

// var_dump($fumen_ar);

while (1) {
	echo "Turn black X : ";
	$black_x = trim(fgets(STDIN)); // Enter wait
	echo "Turn black Y : ";
	$black_y = trim(fgets(STDIN)); // Enter wait

	$black = $black_x * $zahyou + $black_y;
	if($fumen_ar[$black] == ""){
		$fumen_ar[$black] = "black";
	}else{
		echo "だぶってる";
		break;
	}
	// echo $black."\n\n";
	// NG check

	echo "Turn white X : ";
	$white_x = trim(fgets(STDIN)); // Enter wait
	echo "Turn white Y : ";
	$white_y = trim(fgets(STDIN)); // Enter wait

	$white = $white_x * $zahyou + $white_y;
	if($fumen_ar[$white] == ""){
		$fumen_ar[$white] = "white";
	}else{
		echo "だぶってる";
		break;
	}
	// echo $white."\n\n";
	// NG check

$i++;
}

// print_r($fumen_ar);
