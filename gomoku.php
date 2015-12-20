<?php
require_once 'vendor/autoload.php';
require_once 'utils.php';

use Mochix\Go\Disk;
use Mochix\Go\Board;

echo "It was placed in the center of the black!" . PHP_EOL;
echo "10 to 10" . PHP_EOL;

$board = new Board(19);
$turn = Disk::DISK_BLACK; // Turn;


while(!$board->isFull()) {
    foreach(['x','y'] as $index) {
        $point = 'point_' . $index;
        while(true){
            $message = ($turn === Disk::DISK_BLACK) ? "black" : "white";

            echo $message . strtoupper($index) . ':';
            $$point = trim(fgets(STDIN));
            if (!$board->isInclude($$point)) {
                echo "once again" . PHP_EOL;
                continue;
            }
            break;
        }
    }
    
    if ($board->getDisk($point_x, $point_y) === 0) {
        $board->setDisk($point_x, $point_y, $stone);
        $point_search = point_search($point_x, $point_y, $board->getRow(), $stone, $board->getBoard());
    } else {
        echo "NG" . PHP_EOL;
        continue;
    }
    $turn = ($turn === Disk::DISK_BLACK) ? Disk::DISK_WHITE : Disk::DISK_BLACK;
}
