<?php
$point_array = array();
echo "It was placed in the center of the black!\n";
echo "10 to 10\n\n";
$max_point = 19;
$point_array = array_fill(0, $max_point * $max_point, 0);
$i = 0; // Turn;

for ($j=0; $j <= count($point_array); $j++) {
    if ($i%2) {
        $turn = "white";
        $stone = 2;
    } else {
        $turn = "black";
        $stone = 1;
    }

    $range = array('min_range' => 0, 'max_range' => $max_point);
    echo $turn."X:";
    $point_x = trim(fgets(STDIN)); // Enter
    if (filter_var($point_x, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again\n";
        continue;
    }

    echo $turn."Y:";
    $point_y = trim(fgets(STDIN)); // Enter
    if (filter_var($point_y, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again\n";
        continue;
    }

    require_once 'utils.php';
    if ($point_array[point_calc($point_x, $max_point, $point_y)] === 0) {
        // echo "OK\n";
        $point_array[point_calc($point_x, $max_point, $point_y)] = $stone;
    } else {
        echo "once again\n";
        continue;
    }

    $i++;
}


// print_r($point_array);
