<?php

require_once 'utils.php';

$point_array = [];

echo "It was placed in the center of the black!" . PHP_EOL;
echo "10 to 10" . PHP_EOL;
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

    $range = array('min_range' => 0, 'max_range' => $max_point-1);
    foreach(['x','y'] as $index) {
        $point = 'point_' . $index;
        echo $turn . strtoupper($index) . ':';
        $$point = trim(fgets(STDIN));
        if (filter_var($$point, FILTER_VALIDATE_INT, ['options' => $range]) === false) {
            echo "once again" . PHP_EOL;
            continue;
        }
    }
    
    if ($point_array[point_calc($point_x, $max_point, $point_y)] === 0) {
        $point_array[point_calc($point_x, $max_point, $point_y)] = $stone;
        $point_search = point_search($point_x, $point_y, $max_point, $stone, $point_array);
    } else {
        echo "NG".PHP_EOL;
        continue;
    }
    $i++;
}
