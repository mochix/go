<?php
$direction = array(
    'right' => [0,1],
    'left' => [0,-1],
    'top' => [1,0],
    'bottom' => [-1,0],
    'right_top' => [1,1],
    'right_bottom' => [-1,1],
    'left_top' => [1,-1],
    'left_bottom' => [-1,-1],
);
function point_calc($point_x, $max_point, $point_y)
{
    $point = $point_x * $max_point + $point_y;
    return $point;
}
function point_search($point_x, $point_y, $max_point, $stone, $point_array)
{
    global $direction;
    $point_search = [];
    foreach ($direction as $direction_key => $direction_val) {
        $point_search[$direction_key] = 0;
        for ($i=1; $i < 5; $i++) {
            $x = $point_x + ($i * $direction_val[0]);
            $y = $point_y + ($i * $direction_val[1]);
            if (($x < 0 || $x > $max_point-1) || ($y < 0 || $y > $max_point-1)) {
                break;
            }
            if ($point_array[point_calc($x, $max_point, $y)]!=$stone) {
                break;
            }
            $point_search[$direction_key] = $i;
        }
    }
    return $point_search;
}
function win_conditions($point_search)
{
    $judge = false;
    foreach ($point_search as $key => $value) {
        if ($value == 4) {
            $judge = true;
        }
    }
    return $judge;
}
