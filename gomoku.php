<?php
// 19x19
$point_array = array();
echo "It was placed in the center of the black!\n";
echo "10 to 10\n\n";
$max_point = 19;
$point_array = array_fill(0, $max_point * $max_point, "");
$i = 0;// Turn;

// var_dump($point_array);


while (1) {
    if ($i%2) {
        $turn = "white";
        $stone = 1;
    } else {
        $turn = "black";
        $stone = 0;
    }
    echo $turn."X:";
    $point_x = trim(fgets(STDIN));
    echo $turn."Y:";
    $point_y = trim(fgets(STDIN));

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
