<?php
$point_array = array();
echo "It was placed in the center of the black!".PHP_EOL;
echo "10 to 10".PHP_EOL;
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
    echo $turn."X:";
    $point_x = trim(fgets(STDIN)); // Enter
    if (filter_var($point_x, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again".PHP_EOL;
        continue;// 要見直し
    }

    echo $turn."Y:";
    $point_y = trim(fgets(STDIN)); // Enter
    if (filter_var($point_y, FILTER_VALIDATE_INT, array('options'=>$range)) === false) {
        echo "once again".PHP_EOL;
        continue;
    }

    require_once 'utils.php';
    if ($point_array[point_calc($point_x, $max_point, $point_y)] === 0) {
        // echo "OK\n";
        $point_array[point_calc($point_x, $max_point, $point_y)] = $stone;
        $point_search = point_search($point_x, $point_y, $max_point, $stone, $point_array);
        // if (win_conditions($point_search)===true) {
        //     echo "Win".$turn.PHP_EOL;
        //     break;
        // }
    } else {
        echo "NG".PHP_EOL;
        continue;
    }
    $i++;
}


// print_r($point_array);
