<?php
function point_calc($point_x, $max_point, $point_y)
{
    $point = $point_x * $max_point + $point_y;
    return $point;
}
function win_conditions($point_x, $point_y, $max_point, $stone, $point_array)
{
    // 右の判定
    for ($i=0; $i < 5; $i++) {
        if ($point_y+$i>$max_point-1) {
            break;
        }
        if ($point_array[point_calc($point_x, $max_point, $point_y+$i)]!=$stone) {
            break;
        }
    }
    if ($i==5) {
        return true;
    }else{
        return false;
    }
    // 下の判定
    for ($j=0; $j < 5; $j++) {
        if ($point_x+$j>$max_point-1) {
            break;
        }
        if ($point_array[point_calc($point_x+$j, $max_point, $point_y)]!=$stone) {
            break;
        }
    }
    if ($j==5) {
        return true;
    }else{
        return false;
    }
}
