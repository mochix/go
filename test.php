<?php
require_once 'utils.php';
if (point_calc(0, 19, 0) != 0) {
    trigger_error('NG');
}
if (point_calc(18, 19, 18) != 360) {
    trigger_error('NG');
}
if (point_calc(14, 19, 8) != 274) {
    trigger_error('NG');
}

$point_array = array_fill(0, 360, 1);
$point_search = point_search(9, 9, 18, 1, $point_array);
if ($point_search['right'] != 4){
    trigger_error('NG');
}
if ($point_search['left_bottom'] != 4){
    trigger_error('NG');
}
