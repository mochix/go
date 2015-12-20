<?php
require_once 'vendor/autoload.php';
require_once 'utils.php';

use Mochix\Go\Disk;
use Mochix\Go\Board;


$point_array = [];

echo "It was placed in the center of the black!" . PHP_EOL;
echo "10 to 10" . PHP_EOL;


$board = new Board(19);
$point_array = array_fill(0, $board->getRow() * $board->getRow(), 0);
$i = 0; // Turn;

for ($j=0; $j <= count($point_array); $j++) {
    if ($i%2) {
        $turn = "white";
        $stone = Disk::DISK_WHITE;
    } else {
        $turn = "black";
        $stone = Disk::DISK_BLACK;
    }

    foreach(['x','y'] as $index) {
        $point = 'point_' . $index;
        while(true){
            echo $turn . strtoupper($index) . ':';
            $$point = trim(fgets(STDIN));
            if (!$board->isInclude($$point)) {
                echo "once again" . PHP_EOL;
                continue;
            }
            break;
        }
    }
    
    if ($point_array[point_calc($point_x, $board->getRow(), $point_y)] === 0) {
        $point_array[point_calc($point_x, $board->getRow(), $point_y)] = $stone;
        $point_search = point_search($point_x, $point_y, $board->getRow(), $stone, $point_array);
    } else {
        echo "NG".PHP_EOL;
        continue;
    }
    $i++;
}
