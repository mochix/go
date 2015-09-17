<?php
// 19x19
$point_array = array();
echo "It was placed in the center of the black!\n";
echo "10 to 10\n\n";
$max_point = 19;
$point_array = array_fill(0, $max_point * $max_point, "");
$i = 0;// Turn;

// var_dump($point_array);

for ($j=0; $j <= count($point_array); $j++) {
    if ($i%2) {
        $turn = "white";
        $stone = 1;
    } else {
        $turn = "black";
        $stone = 0;
    }
    $range = array('min' => 0, 'max' => $max_point);
    echo $turn."X:";
    $point_x = trim(fgets(STDIN));
    if (filter_var($point_x, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again\n";
        continue;
    }

    echo $turn."Y:";
    $point_y = trim(fgets(STDIN));
    if (filter_var($point_y, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again\n";
        continue;
    }

    $point = $point_x * $max_point + $point_y;

    if ($point_array[$point] === '') {
        // echo "OK\n";
        $point_array[$point] = $stone;
    } else {
        echo "once again\n";
        continue;
    }

    $i++;
}

// print_r($point_array);
